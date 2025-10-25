<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //
    protected $fillable = [
        'student_id',
        'date',
        'status',
        'note',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Get the student that owns the attendance.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
