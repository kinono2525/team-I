<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function create()
    {
        return view('attendance.create');
    }

    public function store(Request $request)
    {
        // バリデーションとデータ保存のロジックをここに実装
        // 仮の実装として、リダイレクトのみ行う
        return redirect()->route('attendance.create')
            ->with('success', '出席が登録されました。');
    }
}