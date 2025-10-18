<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WrongQuestion;

class WrongQuestionController extends Controller{

    public function index(){
        $questions = WrongQuestion::all();
        return view('wrong_questions.index', compact('questions'));
    }

    public function store(Request $request){
        $words = collect($request->word);
        $translations = collect($request->translation);

        $exists = $words->zip($translations)->filter(function ($pair){
            return !empty($pair[0]) && !empty($pair[1]);
        });
        foreach ($exists as [$word, $translation]){
            $checklist = WrongQuestion::where('word', $word)->where('translation', $translation)->exists();
            if(!$checklist){
                WrongQuestion::create([
                    'word' => $word,
                    'translation' => $translation,
                ]);
            }
        }
        return redirect()->route('wrong_questions.index');
    }
}
