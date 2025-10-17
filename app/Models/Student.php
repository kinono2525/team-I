<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $fillable = [
        'gender',
        'grade',
        'school',
        'name_kanji',
        'name_kana',];
    
    /**
     * Get the tests for the student.
     */
    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
