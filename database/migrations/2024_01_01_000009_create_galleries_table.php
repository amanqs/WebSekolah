<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['photo', 'video'])->default('photo');
            $table->string('album')->default('Umum');
            $table->string('media_path')->nullable(); // For uploaded photos
            $table->string('youtube_url')->nullable(); // For embedded YouTube videos
            $table->text('description')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};

