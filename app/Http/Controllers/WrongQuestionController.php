<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\WrongQuestion;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function pdf(Student $student)
    {
        // 生徒ごとの問題を取得
        $questions = $student->wrong_questions;

        // 該当生徒に質問がなければ処理を止める
        if ($questions->isEmpty()) {
            return back()->with('error', 'この生徒には問題がありません。');
        }

        // PDFを生成
        $pdf1 = Pdf::loadView('pdf.test', compact('questions', 'student'));
        $pdf2 = Pdf::loadView('pdf.answer', compact('questions', 'student'));

        $zipFileName = "test_{$student->id}.zip";
        $zipPath = storage_path("app/public/{$zipFileName}");

        $zip = new \ZipArchive();
        
        if($zip->open($zipPath,\ZipArchive::CREATE | \ZipArchive::OVERWRITE)){
            $zip->addFromString("test_{$student->id}.pdf", $pdf1->output());
            $zip->addFromString("answer_{$student->id}.pdf", $pdf2->output());
            $zip->close();

            // 出力済みの問題を削除
            WrongQuestion::where('student_id', $student->id)->delete();
            
            return response()->download($zipPath, $zipFileName)->deleteFileAfterSend(true);
        }

        return back()->with('error', 'ZIPの作成に失敗しました。');
    }
}
