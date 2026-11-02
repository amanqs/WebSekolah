<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category'); // Formulir, Silabus/Kurikulum, SK/Surat Edaran, E-Book
            $table->string('file_path');
            $table->string('file_extension', 10)->default('pdf');
            $table->unsignedBigInteger('file_size')->default(0); // in bytes
            $table->unsignedBigInteger('download_count')->default(0);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('downloads');
    }
};

