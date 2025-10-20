<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('wrong_questions', function (Blueprint $table) {
            //student_idカラムを追加
            $table->foreignId('student_id')
              ->constrained()
              ->onDelete('cascade')
              ->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wrong_questions', function (Blueprint $table) {
            //
            $table->dropForeign(['student_id']);
            $table->dropColumn('student_id');
        });
    }
};
