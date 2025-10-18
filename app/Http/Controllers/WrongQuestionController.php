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

    public function pdf(){
        $questions = WrongQuestion::all();
        $pdf1 = Pdf::loadView('pdf.test', compact('questions'));
        $pdf2 = Pdf::loadView('pdf.answer', compact('questions'));
        $zip = new \ZipArchive();
        $zipPath = storage_path('app/public/test.zip');
        if($zip->open($zipPath, \ZipArchive::OVERWRITE)){
            $zip->addFromString('test.pdf', $pdf1->output());
            $zip->addFromString('answer.pdf', $pdf2->output());
            $zip->close();
            WrongQuestion::truncate(); 
            return response()->download($zipPath, 'test.zip')->deleteFileAfterSend(true);
        }
    }
}
