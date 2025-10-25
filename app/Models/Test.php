<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    /** @use HasFactory<\Database\Factories\TestFactory> */
    use HasFactory;

    protected $fillable = [
        'student_id',
        'test_name',
        'score',
        'scheduled_date',
        'is_completed',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'is_completed' => 'boolean',
    ];
    
    /**
     * Get the student that owns the test.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
