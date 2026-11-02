<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BukuNonTeksController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GraduationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LpjController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

// Public Website Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Profile & Dynamic Static Pages (Sejarah, Visi-Misi, Fasilitas, etc.)
Route::get('/halaman/{slug}', [PageController::class, 'show'])->name('pages.show');

// News, Articles & Announcements
Route::get('/berita', [PostController::class, 'index'])->name('posts.index');
Route::get('/berita/{slug}', [PostController::class, 'show'])->name('posts.show');

// Teachers & Staff Directory
Route::get('/guru-staf', [TeacherController::class, 'index'])->name('teachers.index');
Route::permanentRedirect('/guru-staff', '/guru-staf');

// Extracurriculars
Route::get('/ekstrakurikuler', [ExtracurricularController::class, 'index'])->name('extracurriculars.index');

// School Calendar / Events
Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');

// Photo & Video Gallery
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');

// Digital Downloads Center
Route::get('/unduhan', [DownloadController::class, 'index'])->name('downloads.index');
Route::get('/unduhan/{slug}/download', [DownloadController::class, 'download'])->name('downloads.file');

// LPJ (Laporan Pertanggungjawaban Sekolah: BOS, Komite, dll)
Route::get('/lpj', [LpjController::class, 'index'])->name('lpj.index');
Route::get('/lpj/{slug}/download', [LpjController::class, 'download'])->name('lpj.download');

// Buku Nonteks Pelajaran (Pengayaan & Literasi)
Route::get('/buku-non-teks', [BukuNonTeksController::class, 'index'])->name('buku-non-teks.index');
Route::get('/buku-non-teks/{slug}/download', [BukuNonTeksController::class, 'download'])->name('buku-non-teks.download');

// Contact & Location
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');

// PPDB Online Module
Route::get('/ppdb', [PpdbController::class, 'index'])->name('ppdb.index');
Route::get('/ppdb/{registrationNumber}/cetak-kartu', [PpdbController::class, 'printCard'])->name('ppdb.print-card');

// Graduation / Kelulusan NISN Check Module
Route::get('/kelulusan', [GraduationController::class, 'index'])->name('kelulusan.index');

