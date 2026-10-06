<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    /**
     * Halaman beranda publik
     */
    public function index()
    {
        return view('landing.dashboard_page.dashboard');
    }

    /**
     * Halaman profil sekolah
     */
    public function profile()
    {
        return view('landing.profile_page.profile');
    }

    /**
     * Halaman sejarah sekolah
     */
    public function history()
    {
        return view('landing.profile_page.history');
    }

    /**
     * Halaman visi & misi
     */
    public function visionMission()
    {
        return view('landing.profile_page.vision-mission');
    }

    /**
     * Halaman ekstrakurikuler
     */
    public function extracurricular()
    {
        return view('landing.extracurricular_page.extracurricular');
    }

    /**
     * Halaman detail ekstrakurikuler
     */
    public function extracurricularShow($index)
    {
        $extracurriculars = [
            [
                'nama'      => 'Karate',
                'pembina'   => 'Letkol Kav. Hendra Wijaya, S.E.',
                'jadwal'    => 'Senin & Kamis, 15.00 - 17.00',
                'deskripsi' => 'Ekstrakurikuler karate untuk melatih bela diri, disiplin, dan kebugaran fisik.',
            ],
            [
                'nama'      => 'Pencak Silat',
                'pembina'   => 'Rudi Hartono, S.Pd.',
                'jadwal'    => 'Selasa & Jumat, 15.00 - 17.00',
                'deskripsi' => 'Seni bela diri tradisional Indonesia yang melatih ketangkasan dan ketangguhan.',
            ],
            [
                'nama'      => 'Taekwondo',
                'pembina'   => 'Kapten Inf. Andi Saputra',
                'jadwal'    => 'Rabu & Sabtu, 15.00 - 17.00',
                'deskripsi' => 'Bela diri asal Korea yang fokus pada teknik tendangan, pukulan, dan disiplin diri.',
            ],
            [
                'nama'      => 'Sepak Bola',
                'pembina'   => 'Rudi Hartono, S.Pd.',
                'jadwal'    => 'Senin & Rabu, 16.00 - 17.30',
                'deskripsi' => 'Ekstrakurikuler sepak bola untuk mengasah bakat, kerja sama tim, dan sportivitas.',
            ],
            [
                'nama'      => 'Bola Basket',
                'pembina'   => 'Ir. Joko Widodo, M.T.',
                'jadwal'    => 'Selasa & Kamis, 16.00 - 17.30',
                'deskripsi' => 'Olahraga bola basket untuk melatih kecepatan, strategi, dan kerja sama tim.',
            ],
            [
                'nama'      => 'Bola Voli',
                'pembina'   => 'Ir. Hendra Gunawan',
                'jadwal'    => 'Rabu & Jumat, 16.00 - 17.30',
                'deskripsi' => 'Ekstrakurikuler bola voli untuk melatih kekompakan, reflek, dan ketangkasan.',
            ],
            [
                'nama'      => 'Renang',
                'pembina'   => 'Rudi Hartono, S.Pd.',
                'jadwal'    => 'Sabtu, 08.00 - 10.00',
                'deskripsi' => 'Latihan renang untuk meningkatkan stamina, teknik, dan keselamatan di air.',
            ],
            [
                'nama'      => 'Bulu Tangkis',
                'pembina'   => 'Drs. H. Ahmad Suryadi, M.Pd.',
                'jadwal'    => 'Senin & Jumat, 15.30 - 17.00',
                'deskripsi' => 'Olahraga bulu tangkis untuk melatih kelincahan, kecepatan, dan strategi.',
            ],
            [
                'nama'      => 'Tenis Meja',
                'pembina'   => 'Rina Kartika Sari, S.Pd.',
                'jadwal'    => 'Selasa & Kamis, 15.30 - 17.00',
                'deskripsi' => 'Ekstrakurikuler tenis meja untuk melatih reflek, fokus, dan ketepatan.',
            ],
            [
                'nama'      => 'Panahan',
                'pembina'   => 'Letkol Inf. Surya Pratama',
                'jadwal'    => 'Rabu & Sabtu, 15.00 - 16.30',
                'deskripsi' => 'Olahraga panahan untuk melatih konsentrasi, ketenangan, dan ketepatan.',
            ],
            [
                'nama'      => 'Drumband',
                'pembina'   => 'Maya Sari, S.Pd.',
                'jadwal'    => 'Selasa & Sabtu, 14.00 - 16.00',
                'deskripsi' => 'Kegiatan drumband untuk melatih kedisiplinan, kekompakan, dan musikalitas.',
            ],
            [
                'nama'      => 'Seni Musik',
                'pembina'   => 'Maya Sari, S.Pd.',
                'jadwal'    => 'Senin & Kamis, 16.00 - 17.30',
                'deskripsi' => 'Ekstrakurikuler seni musik untuk mengembangkan bakat bermusik dan kreativitas.',
            ],
            [
                'nama'      => 'Seni Tari',
                'pembina'   => 'Dra. Siti Nurhaliza, M.Pd.',
                'jadwal'    => 'Rabu & Jumat, 16.00 - 17.30',
                'deskripsi' => 'Seni tari tradisional dan modern untuk melestarikan budaya dan melatih ekspresi.',
            ],
            [
                'nama'      => 'KIR',
                'pembina'   => 'Fitriani, S.Kom.',
                'jadwal'    => 'Selasa, 14.00 - 16.00',
                'deskripsi' => 'Wadah riset dan penelitian ilmiah bagi siswa yang tertarik pada sains dan teknologi.',
            ],
            [
                'nama'      => 'Kepemimpinan & Karakter',
                'pembina'   => 'Kolonel Inf. Bambang Prasetyo',
                'jadwal'    => 'Sabtu, 09.00 - 11.00',
                'deskripsi' => 'Program pengembangan karakter, kepemimpinan, dan wawasan kebangsaan.',
            ],
            [
                'nama'      => 'Wawasan Kebangsaan',
                'pembina'   => 'Letkol Kav. Hendra Wijaya, S.E.',
                'jadwal'    => 'Jumat, 14.00 - 15.30',
                'deskripsi' => 'Kegiatan untuk menumbuhkan cinta tanah air dan wawasan kebangsaan.',
            ],
            [
                'nama'      => 'Keterampilan Lapangan',
                'pembina'   => 'Kapten Inf. Andi Saputra',
                'jadwal'    => 'Minggu, 07.00 - 10.00',
                'deskripsi' => 'Pelatihan keterampilan lapangan seperti survival, navigasi, dan kepramukaan.',
            ],
            [
                'nama'      => 'Paskibra',
                'pembina'   => 'Letkol Inf. Surya Pratama',
                'jadwal'    => 'Senin, Rabu, Jumat, 15.00 - 17.00',
                'deskripsi' => 'Pasukan Pengibar Bendera untuk melatih kedisiplinan, ketegasan, dan nasionalisme.',
            ],
        ];

        if (! isset($extracurriculars[$index])) {
            abort(404);
        }

        $extracurricular = $extracurriculars[$index];

        return view('landing.extracurricular_page.show', compact('extracurricular'));
    }

    /**
     * Halaman daftar guru
     */
    public function teachers()
    {
        return view('landing.teachers_page.teachers');
    }

    /**
     * Halaman detail guru
     */
    public function teacherShow($index)
    {
        $teachers = [
            [
                'nama'  => 'Drs. H. Ahmad Suryadi, M.Pd.',
                'nip'   => '196504121990031',
                'mapel' => 'Matematika',
                'email' => 'ahmad.suryadi@smatn.sch.id',
            ],
            [
                'nama'  => 'Kolonel Inf. Bambang Prasetyo',
                'nip'   => '196807151991031',
                'mapel' => 'PKn',
                'email' => 'bambang.prasetyo@smatn.sch.id',
            ],
            [
                'nama'  => 'Dra. Siti Nurhaliza, M.Pd.',
                'nip'   => '197203201996032',
                'mapel' => 'Bahasa Indonesia',
                'email' => 'siti.nurhaliza@smatn.sch.id',
            ],
            [
                'nama'  => 'Ir. Joko Widodo, M.T.',
                'nip'   => '197508252000031',
                'mapel' => 'Fisika',
                'email' => 'joko.widodo@smatn.sch.id',
            ],
            [
                'nama'  => 'Drs. Muhammad Yusuf, M.Ag.',
                'nip'   => '197809102003121',
                'mapel' => 'Pendidikan Agama Islam',
                'email' => 'muhammad.yusuf@smatn.sch.id',
            ],
            [
                'nama'  => 'Rina Kartika Sari, S.Pd.',
                'nip'   => '198203152006042',
                'mapel' => 'Matematika',
                'email' => 'rina.kartika@smatn.sch.id',
            ],
            [
                'nama'  => 'Andi Prasetyo, S.Kom.',
                'nip'   => '198506202010011',
                'mapel' => 'Informatika',
                'email' => 'andi.prasetyo@smatn.sch.id',
            ],
            [
                'nama'  => 'Dewi Lestari, S.Pd., M.Pd.',
                'nip'   => '198709122011012',
                'mapel' => 'Bahasa Inggris',
                'email' => 'dewi.lestari@smatn.sch.id',
            ],
            [
                'nama'  => 'Letkol Kav. Hendra Wijaya, S.E.',
                'nip'   => '198012252005011',
                'mapel' => 'Sejarah',
                'email' => 'hendra.wijaya@smatn.sch.id',
            ],
            [
                'nama'  => 'Maya Anggraini, S.Pd.',
                'nip'   => '199001152015032',
                'mapel' => 'Biologi',
                'email' => 'maya.anggraini@smatn.sch.id',
            ],
            [
                'nama'  => 'Drs. Bambang Sutejo, M.Pd.',
                'nip'   => '197105122000031',
                'mapel' => 'Kimia',
                'email' => 'bambang.sutejo@smatn.sch.id',
            ],
            [
                'nama'  => 'Sri Wahyuni, S.Pd.',
                'nip'   => '198304172008012',
                'mapel' => 'Matematika',
                'email' => 'sri.wahyuni@smatn.sch.id',
            ],
        ];

        if (! isset($teachers[$index])) {
            abort(404);
        }

        $teacher = $teachers[$index];

        return view('landing.teachers_page.show', compact('teacher'));
    }

    /**
     * Halaman siswa
     */
    public function students()
    {
        return view('landing.students_page.students');
    }

    /**
     * Halaman berita
     */
    public function news()
    {
        return view('landing.news_page.news');
    }

    /**
     * Halaman galeri
     */
    public function gallery()
    {
        return view('landing.gallery_page.gallery');
    }
}