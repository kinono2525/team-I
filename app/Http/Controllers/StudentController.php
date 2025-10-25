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
        // 未完了のテストタスクを取得（scheduled_dateで並び替え）
        $tasks = $student->tests()
            ->where('is_completed', false)
            ->whereNotNull('scheduled_date')
            ->orderBy('scheduled_date')
            ->get()
            ->map(function ($test) {
                return [
                    'id' => $test->id,
                    'name' => $test->test_name . ' テスト',
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
}
