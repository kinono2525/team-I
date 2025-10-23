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
        $count = Test::where('student_id', $student->id)
            ->where('test_name', $validated['test_name'])
            ->count();

        $limits = [
            'S1' => 27,
            'S2' => 34,
            'S3' => 24,
        ];
        if (isset($limits[$validated['test_name']]) && $count > $limits[$validated['test_name']]) {
            return redirect()
                ->route('tests.index', ['student' => $student->id])
                ->with('error', 'これ以上同じ種類のテストを追加できません。');
        }

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
    public function edit(Student $student, Test $test)
    {
        //student_idとtest_typeに基づいて連番を取得
        $tests = Test::where('student_id', $student->id)
             ->where('test_name', $test->test_name)
             ->orderBy('id')
             ->get();

        //indexOf()相当の処理
        $index = $tests->search(function ($t) use ($test) {
            return $t->id === $test->id;
        }) + 1;

        $latestTest = $tests->last();

        return view('tests.edit', compact('student', 'test', 'index', 'latestTest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Student $student, Request $request, Test $test)
    {
        //バリデーション
        $request->validate([
            'score' => 'required|integer|min:0|max:100',
        ]);
        //データの更新
        $test->update($request->only('score'));

        return redirect()
            ->route('tests.index', ['student' => $student->id])
            ->with('success', 'テスト記録を更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     * 最新テストのみ削除可能
     */
    public function destroy(Student $student, Test $test)
    {
        //
        $latestTest = Test::where('student_id', $student->id)
            ->where('test_name', $test->test_name)
            ->orderByDesc('id')
            ->first();
        
        if ($test->id !== $latestTest->id) {
            return redirect()
                ->route('tests.index', ['student' => $student->id])
                ->with('error', '最新のテスト記録のみ削除可能です。');
        }

        $test->delete();
        return redirect()
            ->route('tests.index', ['student' => $student->id])
            ->with('success', 'テスト記録を削除しました。');
    }
}
