<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('graduations', function (Blueprint $table) {
            $table->id();
            $table->string('academic_year'); // e.g. 2025/2026
            $table->string('nisn', 10)->index();
            $table->string('exam_number')->nullable(); // Nomor Peserta Ujian
            $table->string('name');
            $table->date('birth_date')->nullable();
            $table->string('class_name'); // e.g. XII MIPA 1, XII TKJ A
            $table->enum('status', ['lulus', 'tidak_lulus', 'tertunda'])->default('lulus');
            $table->decimal('average_score', 5, 2)->nullable();
            $table->text('note')->nullable(); // Pesan ucapan atau instruksi pengambilan SKL
            $table->timestamps();

            $table->unique(['academic_year', 'nisn']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('graduations');
    }
};

