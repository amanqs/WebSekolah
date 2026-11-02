<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('navigations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('navigations')->nullOnDelete();
            $table->string('title');
            $table->string('url')->nullable();
            $table->string('route_name')->nullable();
            $table->string('target')->default('_self'); // _self, _blank
            $table->enum('type', ['header', 'footer'])->default('header');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('navigations');
    }
};

