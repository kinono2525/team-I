<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WrongQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'word',
        'translation',
        'student_id',
    ];
    /**
     * Get the student that owns the wrong question.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}