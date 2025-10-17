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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
            'filters' => $request->only(['name', 'grade', 'school']),
        ]);
    }
}
