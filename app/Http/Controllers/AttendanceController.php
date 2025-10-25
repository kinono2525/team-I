<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Student $student)
    {
        $now = now();
        //月と前半・後半の選択を取得
        $month = $request->input('month', $now->format('Y-m'));
        $half = $request->input('half');
        if (!$half) {
            //今日の日付に基づいて前半・後半を決定
            $half = ($now->day <= 15) ? 1 : 2;
        }

        //月の開始日と終了日を取得
        $startDate = Carbon::parse("{$month}-01");
        $endDate = (clone $startDate)->endOfMonth();

        //前半・後半に応じて日付範囲を設定
        if ($half == 1) {
            $endDate = $startDate->copy()->addDays(14); // 1日〜15日
        } else {
            $startDate = $startDate->copy()->addDays(15); // 16日〜月末
        }

        //指定された月と範囲の出席データを取得
        $attendances = $student->attendances()
            ->whereBetween('date', [$startDate->toDateString(), $endDate->toDateString()])
            ->get()
            ->keyBy('date');

        return view('attendances.index', compact('student', 'month', 'half', 'attendances', 'startDate', 'endDate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Student $student)
    {
        //
        $date = $request->input('date', now()->toDateString());

        return view('attendances.create', compact('student', 'date'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Student $student)
    {
        //
        $validated = $request->validate([
            'date' => 'required|date',
            'status' => 'required|string|max:50',
            'note' => 'nullable|string|max:255',
            'test_name' => 'nullable|string|in:S1,S2,S3',
        ]);
        
        $attendance = $student->attendances()->create($validated);
        // 出席情報を登録
        $student->attendances()->create([
            'date' => $validated['date'],
            'status' => $validated['status'],
            'note' => $validated['note'],
        ]);

        // テストが選択されている場合、テストタスクを作成
        if (!empty($validated['test_name'])) {
            $student->tests()->create([
                'test_name' => $validated['test_name'],
                'scheduled_date' => $validated['date'],
                'score' => 0, // 初期値
                'is_completed' => false,
            ]);
        }

        if (in_array($attendance->status, ['出席', '遅刻'])) {
            return redirect()
                ->route('students.detail', ['student' => $student->id])
                ->with('success', '出席情報を追加しました。');
        } else { // 欠席の場合
            return redirect()
                ->route('students.search')
                ->with('success', '欠席情報を追加しました。');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student, Attendance $attendance)
    {
        //
        // return view('attendances.show', compact('attendance', 'student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student, Attendance $attendance)
    {
        //
        return view('attendances.edit', compact('attendance', 'student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student, Attendance $attendance)
    {
        //
        $request->validate([
            'date' => 'required|date',
            'status' => 'required|string|max:50',
            'note' => 'nullable|string|max:255',
        ]);

        $attendance->update($request->only('date', 'status', 'note'));

        return redirect()
            ->route('attendances.index', ['student' => $student->id])
            ->with('success', '出席情報を更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}