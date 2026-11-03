<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\BukuNonTeks;
use App\Models\Category;
use App\Models\Download;
use App\Models\Extracurricular;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Graduation;
use App\Models\HeroSlide;
use App\Models\Lpj;
use App\Models\Navigation;
use App\Models\Page;
use App\Models\Post;
use App\Models\PpdbRegistration;
use App\Models\Tag;
use App\Models\Teacher;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Roles & Permissions
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $adminWebRole = Role::firstOrCreate(['name' => 'Admin Web', 'guard_name' => 'web']);
        $adminPpdbRole = Role::firstOrCreate(['name' => 'Admin PPDB', 'guard_name' => 'web']);

        // 2. Default Users
        $admin = User::firstOrCreate([
            'email' => 'admin@sekolah.sch.id',
        ], [
            'name' => 'Super Administrator',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole($superAdminRole);

        $adminPpdb = User::firstOrCreate([
            'email' => 'ppdb@sekolah.sch.id',
        ], [
            'name' => 'Panitia PPDB',
            'password' => Hash::make('password'),
        ]);
        $adminPpdb->assignRole($adminPpdbRole);

        $adminWeb = User::firstOrCreate([
            'email' => 'adminweb@sekolah.sch.id',
        ], [
            'name' => 'Admin Pengelola Web',
            'password' => Hash::make('password'),
        ]);
        $adminWeb->assignRole($adminWebRole);

        // 3. Dynamic Navigations (Header & Footer)
        // Root menus
        $navProfil = Navigation::create([
            'title' => 'Profil Sekolah',
            'type' => 'header',
            'order' => 1,
            'is_active' => true,
        ]);

        Navigation::create([
            'parent_id' => $navProfil->id,
            'title' => 'Sejarah Sekolah',
            'url' => '/halaman/sejarah-sekolah',
            'type' => 'header',
            'order' => 1,
            'is_active' => true,
        ]);

        Navigation::create([
            'parent_id' => $navProfil->id,
            'title' => 'Visi & Misi',
            'url' => '/halaman/visi-dan-misi',
            'type' => 'header',
            'order' => 2,
            'is_active' => true,
        ]);

        Navigation::create([
            'parent_id' => $navProfil->id,
            'title' => 'Fasilitas Kampus',
            'url' => '/halaman/fasilitas-kampus',
            'type' => 'header',
            'order' => 3,
            'is_active' => true,
        ]);

        Navigation::create([
            'parent_id' => $navProfil->id,
            'title' => 'Tata Tertib',
            'url' => '/halaman/tata-tertib-sekolah',
            'type' => 'header',
            'order' => 4,
            'is_active' => true,
        ]);

        Navigation::create([
            'parent_id' => $navProfil->id,
            'title' => 'Guru & Staf',
            'route_name' => 'teachers.index',
            'type' => 'header',
            'order' => 5,
            'is_active' => true,
        ]);

        $navKesiswaan = Navigation::create([
            'title' => 'Kesiswaan',
            'type' => 'header',
            'order' => 2,
            'is_active' => true,
        ]);

        Navigation::create([
            'parent_id' => $navKesiswaan->id,
            'title' => 'Ekstrakurikuler',
            'route_name' => 'extracurriculars.index',
            'type' => 'header',
            'order' => 1,
            'is_active' => true,
        ]);

        Navigation::create([
            'parent_id' => $navKesiswaan->id,
            'title' => 'Agenda & Kegiatan',
            'route_name' => 'agenda.index',
            'type' => 'header',
            'order' => 2,
            'is_active' => true,
        ]);

        Navigation::create([
            'parent_id' => $navKesiswaan->id,
            'title' => 'Galeri Foto & Video',
            'route_name' => 'gallery.index',
            'type' => 'header',
            'order' => 3,
            'is_active' => true,
        ]);

        $navPublikasi = Navigation::create([
            'title' => 'Informasi',
            'type' => 'header',
            'order' => 3,
            'is_active' => true,
        ]);

        Navigation::create([
            'parent_id' => $navPublikasi->id,
            'title' => 'Warta & Berita',
            'route_name' => 'posts.index',
            'type' => 'header',
            'order' => 1,
            'is_active' => true,
        ]);

        Navigation::create([
            'parent_id' => $navPublikasi->id,
            'title' => 'Pusat Unduhan Dokumen',
            'route_name' => 'downloads.index',
            'type' => 'header',
            'order' => 2,
            'is_active' => true,
        ]);

        Navigation::create([
            'parent_id' => $navPublikasi->id,
            'title' => 'Laporan LPJ',
            'route_name' => 'lpj.index',
            'type' => 'header',
            'order' => 3,
            'is_active' => true,
        ]);

        Navigation::create([
            'parent_id' => $navPublikasi->id,
            'title' => 'Buku Nonteks',
            'route_name' => 'buku-non-teks.index',
            'type' => 'header',
            'order' => 4,
            'is_active' => true,
        ]);

        Navigation::create([
            'title' => 'Kontak',
            'route_name' => 'contact',
            'type' => 'header',
            'order' => 4,
            'is_active' => true,
        ]);

        // Footer Navigations
        Navigation::create(['title' => 'Visi & Misi', 'url' => '/halaman/visi-dan-misi', 'type' => 'footer', 'order' => 1]);
        Navigation::create(['title' => 'Fasilitas Kampus', 'url' => '/halaman/fasilitas-kampus', 'type' => 'footer', 'order' => 2]);
        Navigation::create(['title' => 'Tata Tertib Siswa', 'url' => '/halaman/tata-tertib-sekolah', 'type' => 'footer', 'order' => 3]);
        Navigation::create(['title' => 'Kebijakan Privasi', 'url' => '#', 'type' => 'footer', 'order' => 4]);

        // 4. Hero Slides
        HeroSlide::create([
            'title' => 'Mewujudkan Generasi Emas Berkarakter dan Berprestasi Dunia',
            'subtitle' => 'Pendidikan berstandar unggul dengan fasilitas modern, pengajar berkompeten, dan kurikulum adaptif masa depan.',
            'image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1600&auto=format&fit=crop',
            'cta_text' => 'Daftar PPDB Online',
            'cta_url' => '/ppdb',
            'secondary_cta_text' => 'Jelajahi Profil',
            'secondary_cta_url' => '/halaman/visi-dan-misi',
            'order' => 1,
            'is_active' => true,
        ]);

        HeroSlide::create([
            'title' => 'Inovasi Sains, Seni, dan Prestasi Olahraga Tanpa Batas',
            'subtitle' => 'Dukung potensi setiap anak melalui lebih dari 20 cabang ekstrakurikuler dan laboratorium terakreditasi.',
            'image' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=1600&auto=format&fit=crop',
            'cta_text' => 'Lihat Ekstrakurikuler',
            'cta_url' => '/#ekskul',
            'order' => 2,
            'is_active' => true,
        ]);

        // 5. Dynamic Profile Pages
        Page::create([
            'title' => 'Visi dan Misi',
            'slug' => 'visi-dan-misi',
            'content' => '<h2>Visi Sekolah</h2><p>Mewujudkan lembaga pendidikan yang berprestasi tinggi, berwawasan global, unggul dalam teknologi dan riset, serta berpijak pada nilai-nilai luhur kepribadian bangsa.</p><h2>Misi Sekolah</h2><ol><li>Menyelenggarakan proses pembelajaran yang inovatif, kreatif, dan berpusat pada peserta didik.</li><li>Mengembangkan potensi bakat akademik dan non-akademik peserta didik secara optimal.</li><li>Membina karakter jujur, disiplin, toleran, serta cinta lingkungan hidup.</li><li>Memperkuat pemanfaatan teknologi digital dalam ekosistem pembelajaran modern.</li></ol>',
            'is_active' => true,
        ]);

        Page::create([
            'title' => 'Sejarah Sekolah',
            'slug' => 'sejarah-sekolah',
            'content' => '<p>Didirikan pada tahun 1985, sekolah kami bermula dari komitmen para tokoh pendidikan untuk menghadirkan institusi pendidikan bermutu tinggi bagi masyarakat. Seiring berjalannya waktu, sekolah kami terus berkembang menjadi salah satu sekolah rujukan nasional dengan ratusan medali olimpiade sains dan ribuan alumni yang tersebar di perguruan tinggi ternama serta dunia industri terkemuka.</p>',
            'is_active' => true,
        ]);

        Page::create([
            'title' => 'Fasilitas Kampus',
            'slug' => 'fasilitas-kampus',
            'content' => '<p>Sekolah kami menyediakan sarana dan prasarana penunjang belajar berstandar tinggi:</p><ul><li>Laboratorium Komputer & AI berspesifikasi tinggi</li><li>Laboratorium Kimia, Fisika, dan Biologi modern</li><li>Perpustakaan Digital dengan ribuan e-book dan jurnal</li><li>Lapangan Olahraga Terbuka (Futsal, Basket, Voli)</li><li>Aula Serbaguna berkapasitas 1.000 orang</li><li>Studio Musik dan Ruang Kesenian</li><li>Kantin Sehat dan Masjid Sekolah</li></ul>',
            'is_active' => true,
        ]);

        Page::create([
            'title' => 'Tata Tertib Sekolah',
            'slug' => 'tata-tertib-sekolah',
            'content' => '<p>Tata tertib peserta didik dirancang untuk membentuk kebiasaan disiplin, tanggung jawab, dan saling menghargai sesama warga sekolah. Seluruh siswa diharapkan hadir tepat waktu pukul 06.45 WIB, mengenakan seragam rapi sesuai jadwal, serta menjaga kebersihan lingkungan kampus.</p>',
            'is_active' => true,
        ]);

        // 6. Categories & Tags & Posts
        $catPrestasi = Category::create(['name' => 'Prestasi Siswa', 'slug' => 'prestasi-siswa']);
        $catAkademik = Category::create(['name' => 'Akademik & Kurikulum', 'slug' => 'akademik']);
        $catPengumuman = Category::create(['name' => 'Pengumuman Resmi', 'slug' => 'pengumuman']);

        $tagOlimpiade = Tag::create(['name' => 'Olimpiade Sains', 'slug' => 'olimpiade-sains']);
        $tagPpdb = Tag::create(['name' => 'PPDB', 'slug' => 'ppdb']);
        $tagKegiatan = Tag::create(['name' => 'Kegiatan Siswa', 'slug' => 'kegiatan-siswa']);

        $post1 = Post::create([
            'user_id' => $admin->id,
            'category_id' => $catPrestasi->id,
            'title' => 'Siswa SMA Negeri 1 Raih Medali Emas Olimpiade Sains Nasional (OSN) 2026',
            'slug' => 'siswa-raih-medali-emas-osn-2026',
            'excerpt' => 'Kabar membanggakan datang dari ananda Muhammad Farhan yang sukses mempersembahkan medali emas bidang Fisika pada ajang OSN tingkat Nasional.',
            'content' => '<p>Prestasi gemilang kembali ditorehkan oleh siswa kami dalam ajang Olimpiade Sains Nasional (OSN) tahun 2026. Muhammad Farhan, siswa kelas XI MIPA 1, berhasil menyabet medali emas dalam kompetisi bergengsi bidang Fisika setelah melalui seleksi ketat dari tingkat kota hingga nasional.</p><p>Kepala Sekolah menyampaikan apresiasi setinggi-tingginya kepada ananda Farhan serta guru pembina olimpiade sains yang telah gigih mendampingi selama masa karantina dan pelatihan intensif.</p>',
            'featured_image' => null,
            'view_count' => 142,
            'is_published' => true,
            'published_at' => now()->subDays(2),
        ]);
        $post1->tags()->attach([$tagOlimpiade->id, $tagKegiatan->id]);

        $post2 = Post::create([
            'user_id' => $admin->id,
            'category_id' => $catPengumuman->id,
            'title' => 'Sosialisasi Pendaftaran Peserta Didik Baru (PPDB) Tahun Ajaran 2026/2027',
            'slug' => 'sosialisasi-pendaftaran-ppdb-2026',
            'excerpt' => 'Pendaftaran PPDB resmi dibuka daring. Simak syarat administrasi, alur pendaftaran, dan jadwal penting berikut.',
            'content' => '<p>Panitia Penerimaan Peserta Didik Baru (PPDB) mengumumkan bahwa pendaftaran untuk tahun ajaran baru telah resmi dibuka secara online melalui portal website sekolah.</p><p>Calon siswa dapat mengisi formulir multi-step dan mengunggah berkas persyaratan tanpa perlu mengantre fisik di sekolah pada tahap pendaftaran awal.</p>',
            'view_count' => 389,
            'is_published' => true,
            'published_at' => now()->subDays(5),
        ]);
        $post2->tags()->attach([$tagPpdb->id]);

        $post3 = Post::create([
            'user_id' => $admin->id,
            'category_id' => $catAkademik->id,
            'title' => 'Workshop Pembelajaran Berbasis AI dan Penguatan Literasi Digital Siswa',
            'slug' => 'workshop-ai-dan-literasi-digital',
            'excerpt' => 'Pelatihan literasi kecerdasan buatan etis diselenggarakan untuk membekali siswa dengan keterampilan teknologi abad 21.',
            'content' => '<p>Dalam rangka menyiapkan generasi masa depan yang melek teknologi, sekolah mengadakan lokakarya komprehensif mengenai pemanfaatan AI secara bertanggung jawab untuk riset dan kreativitas belajar siswa.</p>',
            'view_count' => 88,
            'is_published' => true,
            'published_at' => now()->subDays(8),
        ]);

        // 7. Teachers & Staff
        Teacher::create([
            'name' => 'Drs. H. Mulyadi, M.Pd.',
            'nip' => '19740512 199903 1 002',
            'position' => 'Kepala Sekolah',
            'type' => 'guru',
            'order' => 1,
            'is_active' => true,
        ]);

        Teacher::create([
            'name' => 'Dra. Hj. Nurjanah, M.Si.',
            'nip' => '19780210 200301 2 004',
            'position' => 'Wakil Kepala Sekolah (Kurikulum)',
            'subject' => 'Fisika',
            'type' => 'guru',
            'order' => 2,
            'is_active' => true,
        ]);

        Teacher::create([
            'name' => 'Ahmad Fauzi, S.Pd., Gr.',
            'nip' => '19890415 201502 1 003',
            'position' => 'Waka Kesiswaan & Pembina OSIS',
            'subject' => 'Matematika Peminatan',
            'type' => 'guru',
            'order' => 3,
            'is_active' => true,
        ]);

        Teacher::create([
            'name' => 'Rina Kartika, S.Kom.',
            'nip' => '19921104 201801 2 005',
            'position' => 'Guru Informatika & Laboran AI',
            'subject' => 'Informatika & Pemrograman',
            'type' => 'guru',
            'order' => 4,
            'is_active' => true,
        ]);

        Teacher::create([
            'name' => 'Bambang Sudrajat, S.Sos.',
            'nip' => '19840819 200903 1 005',
            'position' => 'Kepala Tata Usaha (TU)',
            'type' => 'tendik',
            'order' => 5,
            'is_active' => true,
        ]);

        // 8. Extracurriculars
        Extracurricular::create([
            'name' => 'Robotik & Kecerdasan Buatan',
            'coach' => 'Rina Kartika, S.Kom.',
            'schedule' => 'Jumat, 15.00 - 17.00 WIB',
            'description' => 'Mempelajari mikroprosesor Arduino, IoT, dan pemrograman robot untuk kompetisi nasional.',
            'image' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?q=80&w=800&auto=format&fit=crop',
            'order' => 1,
            'is_active' => true,
        ]);

        Extracurricular::create([
            'name' => 'Paskibraka Satya Wira',
            'coach' => 'Bambang Pamungkas',
            'schedule' => 'Sabtu, 08.00 - 11.00 WIB',
            'description' => 'Melatih kedisiplinan baris-berbaris, kepemimpinan, dan etika kebangsaan.',
            'image' => 'https://images.unsplash.com/photo-1541829070764-84a7d30dd3f3?q=80&w=800&auto=format&fit=crop',
            'order' => 2,
            'is_active' => true,
        ]);

        Extracurricular::create([
            'name' => 'Klub Basket & Futsal',
            'coach' => 'Coach Hendra Wijaya',
            'schedule' => 'Selasa & Kamis, 16.00 WIB',
            'description' => 'Pembinaan atlet cabang olahraga tim dengan pelatih berlisensi nasional.',
            'image' => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?q=80&w=800&auto=format&fit=crop',
            'order' => 3,
            'is_active' => true,
        ]);

        Extracurricular::create([
            'name' => 'Paduan Suara & Musik Etnik',
            'coach' => 'Dewi Lestari, S.Sn.',
            'schedule' => 'Rabu, 15.30 - 17.30 WIB',
            'description' => 'Pengembangan bakat seni tarik suara dan instrumen musik tradisional.',
            'image' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=800&auto=format&fit=crop',
            'order' => 4,
            'is_active' => true,
        ]);

        // 9. Galleries
        Gallery::create([
            'title' => 'Upacara Peringatan Hari Pendidikan Nasional',
            'type' => 'photo',
            'album' => 'Kegiatan Resmi',
            'description' => 'Khidmat upacara pengibaran bendera merah putih dengan pakaian adat nusantara.',
            'is_featured' => true,
            'order' => 1,
        ]);

        Gallery::create([
            'title' => 'Pameran Karya Inovasi Sains & Teknologi Siswa',
            'type' => 'photo',
            'album' => 'Karya Siswa',
            'description' => 'Demonstrasi proyek teknologi ramah lingkungan dan robot otomatisasi.',
            'is_featured' => true,
            'order' => 2,
        ]);

        Gallery::create([
            'title' => 'Profil Singkat & Tur Virtual Kampus Sekolah',
            'type' => 'video',
            'album' => 'Video Profil',
            'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'description' => 'Jelajahi setiap sudut fasilitas belajar dan aktivitas siswa melalui video tur.',
            'is_featured' => true,
            'order' => 3,
        ]);

        // 10. Downloads
        Download::create([
            'title' => 'Kalender Pendidikan Tahun Ajaran 2026/2027',
            'category' => 'Panduan Akademik',
            'file_path' => 'downloads/kalender-pendidikan-2026.pdf',
            'file_size' => 1024 * 750, // 750 KB
            'download_count' => 245,
            'description' => 'Jadwal masuk sekolah, libur semester, dan agenda ujian sekolah.',
            'is_active' => true,
        ]);

        Download::create([
            'title' => 'Buku Panduan Teknis PPDB Jalur Zonasi & Prestasi',
            'category' => 'Formulir',
            'file_path' => 'downloads/panduan-ppdb-2026.pdf',
            'file_size' => 1024 * 1250, // 1.2 MB
            'download_count' => 612,
            'description' => 'Petunjuk lengkap pengisian berkas persyaratan dan tata cara verifikasi fisik.',
            'is_active' => true,
        ]);

        // 11. Agendas
        Agenda::create([
            'title' => 'Penilaian Akhir Semester (PAS) Genap',
            'start_date' => now()->addDays(14)->toDateString(),
            'end_date' => now()->addDays(21)->toDateString(),
            'time' => '07.30 - 12.00 WIB',
            'location' => 'Seluruh Ruang Kelas X, XI, dan XII',
            'organizer' => 'Tim Kurikulum',
            'description' => 'Peserta didik wajib membawa kartu peserta ujian dan alat tulis lengkap.',
            'is_active' => true,
        ]);

        Agenda::create([
            'title' => 'Wisuda Purnawiyata & Pelepasan Alumni Angkatan 2026',
            'start_date' => now()->addDays(35)->toDateString(),
            'time' => '08.00 - Selesai WIB',
            'location' => 'Grand Ballroom Gedung Serbaguna',
            'organizer' => 'Panitia Wisuda',
            'description' => 'Acara serah terima kelulusan siswa kepada orang tua wali murid.',
            'is_active' => true,
        ]);

        // 12. Testimonials
        Testimonial::create([
            'name' => 'dr. Andika Pratama, Sp.A.',
            'role' => 'Alumni Angkatan 2012 - Dokter Spesialis Anak RSCM',
            'content' => 'Dasar disiplin, integritas, dan rasa ingin tahu yang saya dapatkan selama menimba ilmu di sekolah ini menjadi modal utama keberhasilan saya menempuh pendidikan kedokteran.',
            'rating' => 5,
            'order' => 1,
            'is_active' => true,
        ]);

        Testimonial::create([
            'name' => 'Ir. Maya Safitri, M.T.',
            'role' => 'Alumni Angkatan 2016 - Software Engineer di Tech Unicorn',
            'content' => 'Fasilitas laboratorium komputer yang sangat memadai dan bimbingan guru yang suportif membuka jalan bagi karir saya di industri teknologi informasi modern.',
            'rating' => 5,
            'order' => 2,
            'is_active' => true,
        ]);

        // 13. FAQs
        Faq::create([
            'question' => 'Kapan pendaftaran PPDB tahun ajaran baru dibuka?',
            'answer' => 'Pendaftaran dibuka secara daring sesuai jadwal yang telah ditentukan. Anda dapat memantau jadwal hitung mundur dan pengumuman resmi di halaman PPDB pada menu navigasi.',
            'category' => 'PPDB',
            'order' => 1,
            'is_active' => true,
        ]);

        Faq::create([
            'question' => 'Dokumen apa saja yang wajib disiapkan untuk pendaftaran online?',
            'answer' => 'Dokumen yang perlu disiapkan antara lain: Pas Foto formal 3x4, Scan/Foto Kartu Keluarga (KK), Scan Akta Kelahiran, dan Ijazah atau Surat Keterangan Lulus (SKL) sementara.',
            'category' => 'PPDB',
            'order' => 2,
            'is_active' => true,
        ]);

        Faq::create([
            'question' => 'Apakah sekolah menyediakan program beasiswa untuk siswa berprestasi?',
            'answer' => 'Ya, kami menyediakan beasiswa prestasi akademik maupun non-akademik, serta program beasiswa afirmasi bagi peserta didik yang memenuhi kriteria kelayakan panitia.',
            'category' => 'Akademik',
            'order' => 3,
            'is_active' => true,
        ]);

        // 14. Sample PPDB Registration
        PpdbRegistration::create([
            'registration_number' => 'PPDB-' . date('Y') . '-0001',
            'academic_year' => '2026/2027',
            'full_name' => 'Dimas Arya Saputra',
            'nisn' => '0081234567',
            'nik' => '3171012345670001',
            'gender' => 'L',
            'birth_place' => 'Jakarta',
            'birth_date' => '2010-08-17',
            'religion' => 'Islam',
            'address' => 'Jl. Kebayoran Lama No. 12, Jakarta Selatan',
            'phone_number' => '081298765432',
            'father_name' => 'Budi Saputra',
            'mother_name' => 'Dewi Anggraini',
            'parent_phone' => '081211223344',
            'previous_school_name' => 'SMP Negeri 19 Jakarta',
            'average_score' => 88.75,
            'chosen_major' => 'MIPA (Matematika & IPA)',
            'status' => 'verified',
            'admin_notes' => 'Berkas lengkap dan telah diverifikasi oleh tim panitia.',
        ]);

        // 15. Sample Graduation Record for Cek NISN testing
        Graduation::create([
            'academic_year' => '2025/2026',
            'nisn' => '0059876543',
            'exam_number' => '01-001-042-9',
            'name' => 'Sarah Putri Anindya',
            'class_name' => 'XII MIPA 1',
            'status' => 'lulus',
            'average_score' => 92.40,
            'note' => 'Selamat ananda Sarah Putri Anindya! Anda lulus dengan predikat Sangat Memuaskan. Surat Keterangan Lulus (SKL) dapat diambil di ruang TU mulai Senin pukul 08.00 WIB.',
        ]);

        Graduation::create([
            'academic_year' => '2025/2026',
            'nisn' => '0051122334',
            'exam_number' => '01-001-088-3',
            'name' => 'Reza Pratama',
            'class_name' => 'XII IPS 2',
            'status' => 'lulus',
            'average_score' => 86.10,
            'note' => 'Selamat, Anda dinyatakan LULUS. Harap menyelesaikan pengembalian buku perpustakaan sebelum cap tiga jari.',
        ]);

        // 16. Sample LPJ (Laporan Pertanggungjawaban)
        Lpj::create([
            'title' => 'Laporan Pertanggungjawaban Realisasi Dana BOS Reguler Tahap I & II Tahun Anggaran 2025/2026',
            'slug' => 'lpj-bos-reguler-tahap-1-2-ta-2025-2026',
            'category' => 'Dana BOS',
            'fiscal_year' => '2025/2026',
            'file_path' => 'lpj/lpj-bos-reguler-2025-2026.pdf',
            'file_extension' => 'pdf',
            'file_size' => 2450000,
            'download_count' => 84,
            'description' => 'Laporan rekapitulasi penerimaan dan pembelanjaan dana BOS Reguler untuk sarana prasarana, operasional pembelajaran, dan gaji tenaga kependidikan.',
            'is_active' => true,
        ]);

        Lpj::create([
            'title' => 'Laporan Pertanggungjawaban Dana BOS Kinerja & Sekolah Penggerak Tahun Anggaran 2024/2025',
            'slug' => 'lpj-bos-kinerja-sekolah-penggerak-2024-2025',
            'category' => 'Dana BOS',
            'fiscal_year' => '2024/2025',
            'file_path' => 'lpj/lpj-bos-kinerja-2024-2025.pdf',
            'file_extension' => 'pdf',
            'file_size' => 1820000,
            'download_count' => 142,
            'description' => 'Laporan pertanggungjawaban program sekolah penggerak, digitalisasi kelas, dan apresiasi capaian mutu pendidikan nasional.',
            'is_active' => true,
        ]);

        Lpj::create([
            'title' => 'LPJ Kegiatan Masa Pengenalan Lingkungan Sekolah (MPLS) dan Kemah Pramuka 2025',
            'slug' => 'lpj-kegiatan-mpls-dan-kemah-pramuka-2025',
            'category' => 'Kegiatan Siswa',
            'fiscal_year' => '2025/2026',
            'file_path' => 'lpj/lpj-kegiatan-mpls-kemah-2025.pdf',
            'file_extension' => 'pdf',
            'file_size' => 3200000,
            'download_count' => 53,
            'description' => 'Laporan komprehensif pertanggungjawaban anggaran, dokumentasi, dan evaluasi kegiatan penyambutan siswa baru tahun ajaran 2025/2026.',
            'is_active' => true,
        ]);

        Lpj::create([
            'title' => 'Laporan Keuangan & Akuntabilitas Dana Komite Sekolah Semester Ganjil 2025/2026',
            'slug' => 'lpj-keuangan-dana-komite-ganjil-2025-2026',
            'category' => 'Komite Sekolah',
            'fiscal_year' => '2025/2026',
            'file_path' => 'lpj/lpj-komite-ganjil-2025-2026.pdf',
            'file_extension' => 'pdf',
            'file_size' => 1420000,
            'download_count' => 98,
            'description' => 'Laporan transparansi partisipasi orang tua/wali murid melalui Komite Sekolah untuk pemeliharaan sarana ibadah dan ekstrakurikuler unggulan.',
            'is_active' => true,
        ]);

        // 17. Sample Buku Nonteks Pelajaran
        BukuNonTeks::create([
            'title' => 'Ensiklopedia Sains dan Ekosistem Hayati Indonesia',
            'slug' => 'ensiklopedia-sains-dan-ekosistem-hayati-indonesia',
            'category' => 'Pengayaan Pengetahuan',
            'author' => 'Dr. Hendra Wijaya & Tim Biologi',
            'publisher' => 'Pustaka Cendekia Mandiri',
            'published_year' => '2024',
            'isbn' => '978-602-1234-01-2',
            'cover_image' => 'https://images.unsplash.com/photo-1532012164546-f432f2e3777a?w=600&auto=format&fit=crop&q=80',
            'file_path' => 'buku-non-teks/ensiklopedia-sains.pdf',
            'file_extension' => 'pdf',
            'file_size' => 5600000,
            'download_count' => 128,
            'synopsis' => "Buku pengayaan sains yang mengupas keanekaragaman flora dan fauna kepulauan Nusantara, interaksi ekosistem tropis, serta tantangan konservasi lingkungan modern yang dikemas dengan bahasa populer dan ilustrasi berwarna untuk memperkaya wawasan peserta didik.",
            'is_active' => true,
        ]);

        BukuNonTeks::create([
            'title' => 'Membangun Karakter Pelajar Pancasila: Pemimpin Muda Masa Depan',
            'slug' => 'membangun-karakter-pelajar-pancasila-pemimpin-muda',
            'category' => 'Pengayaan Kepribadian',
            'author' => 'Prof. Anisa Rahmawati, M.Pd.',
            'publisher' => 'Erlangga Literasi Karakter',
            'published_year' => '2025',
            'isbn' => '978-602-5432-88-9',
            'cover_image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=600&auto=format&fit=crop&q=80',
            'file_path' => 'buku-non-teks/karakter-pelajar-pancasila.pdf',
            'file_extension' => 'pdf',
            'file_size' => 3400000,
            'download_count' => 215,
            'synopsis' => "Panduan inspiratif bagi peserta didik untuk menanamkan integritas, empati, resiliensi, dan kepemimpinan inklusif dalam dinamika kehidupan berorganisasi, pergaulan sehat, dan bermasyarakat.",
            'is_active' => true,
        ]);

        BukuNonTeks::create([
            'title' => 'Jejak Langkah Menembus Cakrawala: Antologi Puisi & Cerpen Remaja',
            'slug' => 'jejak-langkah-menembus-cakrawala-antologi-sastra',
            'category' => 'Sastra & Fiksi',
            'author' => 'Komunitas Literasi Siswa SMA',
            'publisher' => 'Balai Bahasa & Sastra Pelajar',
            'published_year' => '2024',
            'isbn' => '978-623-7890-11-4',
            'cover_image' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=600&auto=format&fit=crop&q=80',
            'file_path' => 'buku-non-teks/antologi-puisi-cerpen.pdf',
            'file_extension' => 'pdf',
            'file_size' => 2100000,
            'download_count' => 94,
            'synopsis' => "Kumpulan karya sastra terbaik hasil kreasi siswa berprestasi yang menggambarkan refleksi perjalanan masa remaja, persahabatan, kecintaan pada tanah air, dan tekad menggapai cita-cita setinggi langit.",
            'is_active' => true,
        ]);

        BukuNonTeks::create([
            'title' => 'Panduan Praktis Desain Grafis & Pemrograman Web untuk Pemula',
            'slug' => 'panduan-praktis-desain-grafis-pemrograman-web',
            'category' => 'Keterampilan / Vokasi',
            'author' => 'Bagus Setyawan, S.Kom.',
            'publisher' => 'Informatika Kreatif Edukasi',
            'published_year' => '2025',
            'isbn' => '978-623-4567-33-0',
            'cover_image' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&auto=format&fit=crop&q=80',
            'file_path' => 'buku-non-teks/panduan-desain-web.pdf',
            'file_extension' => 'pdf',
            'file_size' => 4800000,
            'download_count' => 176,
            'synopsis' => "Buku panduan kecakapan abad 21 yang memandu siswa langkah demi langkah memahami logika pemrograman dasar, desain visual modern, dan implementasi proyek kreatif digital secara aplikatif dan mandiri.",
            'is_active' => true,
        ]);
    }
}

