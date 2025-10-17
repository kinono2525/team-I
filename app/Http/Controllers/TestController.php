<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Student $student)
    {
        //
        $tests = $student->tests;
        $test_types = ['S1', 'S2', 'S3'];
        $columns = [
            'S1' => 27,
            'S2' => 34,
            'S3' => 24,
        ];

        return view('tests.index', compact('student', 'tests', 'test_types', 'columns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Student $student, Request $request)
    {
        //クエリパラメータからtest_typeを取得
        $testType = $request->query('type');
        $index = Test::where('student_id', $student->id)
            ->where('test_name', $testType)
            ->count() + 1;

        return view('tests.create', compact('student', 'testType', 'index'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Student $student, Request $request)
    {
        //バリデーション
        $validated = $request->validate([
            'test_name' => 'required|string|max:255',
            'score' => 'required|integer|min:0|max:100',
        ]);

        //データの挿入
        $student->tests()->create($validated);

        return redirect()
            ->route('tests.index', ['student' => $student->id])
            ->with('success', 'テスト記録を追加しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        //
    }
}
