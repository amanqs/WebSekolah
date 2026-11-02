<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('time')->nullable(); // e.g. 08:00 - Selesai WIB
            $table->string('location')->nullable(); // e.g. Aula Utama SMA Negeri 1
            $table->string('organizer')->nullable(); // e.g. OSIS, Kurikulum
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};

