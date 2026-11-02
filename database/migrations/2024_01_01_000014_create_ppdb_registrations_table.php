<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ppdb_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique(); // e.g. PPDB-2026-0001
            $table->string('academic_year'); // e.g. 2026/2027

            // 1. Data Diri Calon Siswa
            $table->string('full_name');
            $table->string('nisn', 10)->index();
            $table->string('nik', 16)->nullable();
            $table->enum('gender', ['L', 'P']);
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('religion');
            $table->text('address');
            $table->string('phone_number'); // WhatsApp aktif

            // 2. Data Orang Tua / Wali
            $table->string('father_name');
            $table->string('father_occupation')->nullable();
            $table->string('mother_name');
            $table->string('mother_occupation')->nullable();
            $table->string('parent_income')->nullable(); // Rentang penghasilan
            $table->string('parent_phone');

            // 3. Sekolah Asal & Pilihan
            $table->string('previous_school_name');
            $table->text('previous_school_address')->nullable();
            $table->decimal('average_score', 5, 2)->nullable();
            $table->string('chosen_major')->nullable(); // MIPA, IPS, atau Kejuruan

            // 4. Berkas Unggahan
            $table->string('file_photo')->nullable(); // Pas foto formal
            $table->string('file_kk')->nullable(); // Kartu Keluarga
            $table->string('file_birth_certificate')->nullable(); // Akta Lahir
            $table->string('file_report_or_diploma')->nullable(); // Ijazah / SKL

            // 5. Status Verifikasi
            $table->enum('status', ['pending', 'verified', 'accepted', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppdb_registrations');
    }
};

