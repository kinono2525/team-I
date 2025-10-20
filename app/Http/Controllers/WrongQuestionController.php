<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\WrongQuestion;

class WrongQuestionController extends Controller{

    public function index(Student $student)
    {
        $questions = $student->wrong_questions;
        return view('wrong_questions.index', compact('questions', 'student'));
    }

    public function store(Request $request, Student $student)
    {
        //バリデーション
        $request->validate([
            'word.*' => ['nullable', 'string', 'regex:/^[a-zA-Z0-9\-\.\']+$/'],
            'translation.*' => ['nullable', 'string', 'max:255'],
        ]);

        $words = collect($request->word);
        $translations = collect($request->translation);

        //空でないペアを抽出
        $exists = $words->zip($translations)->filter(function ($pair){
            return !empty($pair[0]) && !empty($pair[1]);
        });
        foreach ($exists as [$word, $translation]){
            $checklist = WrongQuestion::where('student_id', $student->id)
            ->where('word', $word)
            ->where('translation', $translation)
            ->exists();
            //重複がなければ保存
            if(!$checklist){
                WrongQuestion::create([
                    'student_id' => $student->id,
                    'word' => $word,
                    'translation' => $translation,
                ]);
            }
        }
        return redirect()->route('wrong_questions.index', ['student' => $student->id])
            ->with('success', '間違えた問題を保存しました。');
    }
}
