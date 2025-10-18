<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WrongQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'word',
        'translation'
    ];
}