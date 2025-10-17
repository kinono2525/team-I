<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Test;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $student = Student::create([
            'name_kanji' => '山田太郎',
            'name_kana' => 'ヤマダタロウ',
            'gender' => 'male',
            'grade' => 2, 
            'school' => '福岡高校']);
        
        Test::factory(3)->create([
            'student_id' => $student->id,
        ]);
    }
}
