<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Table for LPJ (Laporan Pertanggungjawaban)
        Schema::create('lpjs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('Dana BOS / BOSP'); // Dana BOS / BOSP, Komite, Kegiatan, Bantuan Pemerintah, etc.
            $table->string('fiscal_year', 10)->nullable(); // e.g. 2026
            $table->string('file_path');
            $table->string('file_extension', 10)->default('pdf');
            $table->unsignedBigInteger('file_size')->default(0);
            $table->unsignedInteger('download_count')->default(0);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Table for Buku Non Teks (Buku Pengayaan, Referensi, Literasi Non-Teks)
        Schema::create('buku_non_teks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('Buku Pengayaan Pengetahuan'); // Pengayaan Pengetahuan, Pengayaan Kepribadian, Cerita Literasi, Referensi
            $table->string('author')->nullable();
            $table->string('publisher')->nullable();
            $table->string('published_year', 10)->nullable();
            $table->string('isbn', 30)->nullable();
            $table->string('cover_image')->nullable();
            $table->string('file_path');
            $table->string('file_extension', 10)->default('pdf');
            $table->unsignedBigInteger('file_size')->default(0);
            $table->unsignedInteger('download_count')->default(0);
            $table->text('synopsis')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku_non_teks');
        Schema::dropIfExists('lpjs');
    }
};

