<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Test;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name_kanji' => 'required|string|max:255',
            'name_kana' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'grade' => 'required|integer|min:1|max:12',
            'school' => 'required|string|max:255',
        ]);

        Student::create($validated);

        return redirect()->route('students.create')->with('success', '生徒情報を追加しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
        $request->validate([
            'grade' => 'required|integer|min:1|max:12',
            'school' => 'required|string|max:255',
        ]);

        $student->update($request->only(['grade','school']));

        return redirect()
            ->route('students.search')
            ->with('success', '生徒情報を更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }

    /**
     * Search for students based on criteria.
     */
    public function search(Request $request)
    {
        $query = Student::query();

        if ($request->filled('name_kanji')) {
            $query->where('name_kanji', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->filled('name_kana')) {
            $query->where('name_kana', 'like', '%' . $request->input('name_kana') . '%');
        }
        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }
        if ($request->filled('grade')) {
            $query->where('grade', $request->input('grade'));  
        }
        if ($request->filled('school')) {
            $query->where('school', 'like', '%' . $request->input('school') . '%');
        } 

        $students = $query->get();

        return view('students.search', [
            'students' => $students,
        ]);
    }

    /**
     * Show the detail page for a student.
     */
    public function detail(Student $student)
    {
        // 重複タスクをクリーンアップ（既存の重複を削除）
        $this->cleanupAllDuplicateTasks($student);

        // 未完了のテストタスクを取得（scheduled_dateで並び替え）
        $tasks = $student->tests()
            ->where('is_completed', false)
            ->whereNotNull('scheduled_date')
            ->orderBy('scheduled_date')
            ->get()
            ->map(function ($test) use ($student) {
                // このテストタイプの何回目かを計算
                $completedCount = $student->tests()
                    ->where('test_name', $test->test_name)
                    ->whereNull('scheduled_date')
                    ->count();
                
                $index = $completedCount + 1;
                
                return [
                    'id' => $test->id,
                    'name' => $test->test_name . ' 第' . $index . '回',
                    'deadline' => $test->scheduled_date->format('Y-m-d'),
                    'status' => $test->is_completed ? '完了' : '未完了',
                ];
            });

        return view('students.detail', compact('student', 'tasks'));
    }

    /**
     * Mark a test task as completed.
     */
    public function completeTask(Student $student, $task)
    {
        $test = $student->tests()->findOrFail($task);
        $test->update(['is_completed' => true]);

        return redirect()
            ->route('students.detail', ['student' => $student->id])
            ->with('success', 'タスクを完了しました。');
    }

    /**
     * Show the score input form for a task.
     */
    public function inputScore(Student $student, $task)
    {
        $test = $student->tests()
            ->where('id', $task)
            ->whereNotNull('scheduled_date')
            ->firstOrFail();

        // このテストタイプの何回目かを計算
        $index = $student->tests()
            ->where('test_name', $test->test_name)
            ->whereNull('scheduled_date')
            ->count() + 1;

        return view('students.task-input-score', compact('student', 'test', 'index'))
            ->with('task', $test);
    }

    /**
     * Store the score for a task and mark it as completed.
     */
    public function storeScore(Request $request, Student $student, $task)
    {
        $validated = $request->validate([
            'score' => 'required|integer|min:0|max:100',
        ]);

        // タスク用のテストレコードを取得
        $taskTest = $student->tests()
            ->where('id', $task)
            ->whereNotNull('scheduled_date')
            ->firstOrFail();

        // 点数記録用の新しいテストレコードを作成（scheduled_date = NULL）
        $student->tests()->create([
            'test_name' => $taskTest->test_name,
            'score' => $validated['score'],
            'scheduled_date' => null, // 点数記録用はNULL
            'is_completed' => true,
        ]);

        // タスクを完了としてマーク
        $taskTest->update([
            'is_completed' => true,
            'score' => $validated['score'], // タスクにも点数を記録
        ]);

        // 同じテストタイプの重複タスクをクリーンアップ
        $this->removeDuplicateTasks($student, $taskTest->test_name);

        return redirect()
            ->route('students.detail', ['student' => $student->id])
            ->with('success', '点数を登録しました。');
    }

    /**
     * 重複タスクを削除する
     * 同じtest_nameで未完了のタスクが複数ある場合、新しいものを削除して古いものを残す
     */
    private function removeDuplicateTasks(Student $student, $testName)
    {
        // 同じtest_nameで未完了のタスクを取得（古い順）
        $tasks = $student->tests()
            ->where('test_name', $testName)
            ->where('is_completed', false)
            ->whereNotNull('scheduled_date')
            ->orderBy('id', 'asc')
            ->get();

        // 2件以上ある場合、最初の1件を残して残りを削除
        if ($tasks->count() > 1) {
            $tasks->skip(1)->each(function ($task) {
                $task->delete();
            });
        }
    }

    /**
     * すべてのテストタイプで重複タスクをクリーンアップ
     */
    private function cleanupAllDuplicateTasks(Student $student)
    {
        $testTypes = ['S1', 'S2', 'S3'];

        foreach ($testTypes as $testType) {
            $this->removeDuplicateTasks($student, $testType);
        }
    }
}
