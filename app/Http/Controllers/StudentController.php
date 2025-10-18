<?php

namespace App\Http\Controllers;

use App\Models\Student;
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
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

        if ($request->filled('name')) {
            $query->where('name_kanji', 'like', '%' . $request->input('name') . '%');
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
}
