<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('grades', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_id')->constrained()->onDelete('cascade');
        $table->foreignId('teacher_id')->constrained()->onDelete('cascade');
        $table->string('mapel'); // Atau gunakan relasi jika mapel entitas sendiri
        $table->integer('nilai');
        $table->timestamps();
    });
}

};
