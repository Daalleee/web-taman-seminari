<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use App\Models\Banner;
use App\Models\News;
use App\Models\Activity;
use App\Models\Gallery;
use App\Models\Faq;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@tamanseminari.com'],
            ['name' => 'Administrator', 'password' => Hash::make('password123')]
        );

        $this->seedSettings();
        $this->seedBanners();
        $this->seedNews();
        $this->seedActivities();
        $this->seedGalleries();
        $this->seedFaqs();
    }

    private function seedSettings(): void
    {
        $settings = [
            ['key' => 'school_name', 'value' => 'Taman Seminari TK'],
            ['key' => 'about_text', 'value' => 'Di Taman Seminari TK, kami menanamkan nilai-nilai Kristiani yang mendalam dengan pendekatan pendidikan anak usia dini yang modern dan penuh kasih. Kami percaya setiap anak adalah permata unik yang perlu dibimbing dengan cinta dan iman.'],
            ['key' => 'vision', 'value' => 'Menjadi lembaga pendidikan Katolik unggulan yang membentuk generasi berkarakter mulia, cerdas, dan mandiri berlandaskan kasih Kristus dalam semangat kegembiraan anak-anak.'],
            ['key' => 'mission', 'value' => 'Menyelenggarakan pendidikan holistik yang mengintegrasikan kecerdasan intelektual, emosional, dan spiritual dalam semangat kasih persaudaraan.'],
            ['key' => 'phone', 'value' => '+62 812 3456 7890'],
            ['key' => 'email', 'value' => 'info@tamanseminari.sch.id'],
            ['key' => 'address', 'value' => 'Jl. Pendidikan No. 1, Penajam Paser Utara, Kalimantan Timur'],
        ];
        foreach ($settings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], ['value' => $s['value']]);
        }
    }

    private function seedBanners(): void
    {
        Banner::firstOrCreate(
            ['id' => 1],
            [
                'title' => 'Membentuk Hati yang Beriman & Pikiran yang Cemerlang',
                'subtitle' => 'Penerimaan Siswa Baru Tahun Ajaran 2025/2026',
                'image_path' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=1200',
                'is_active' => true,
            ]
        );
    }

    private function seedNews(): void
    {
        $news = [
            [
                'title' => 'Penerimaan Peserta Didik Baru (PPDB) Tahun Ajaran 2025/2026 Telah Dibuka',
                'content' => 'Mari bergabung dalam keluarga besar Taman Seminari TK. Kami menyediakan lingkungan yang aman, penuh kasih, dan berlandaskan nilai-nilai Kristiani untuk tumbuh kembang optimal putra-putri Anda. Pendaftaran dimulai dari bulan Januari hingga Juni 2025. Kuota terbatas, segera daftarkan buah hati Anda! Untuk informasi lebih lanjut, silakan hubungi kami di nomor telepon atau email yang tercantum.',
                'published_at' => '2025-02-12',
            ],
            [
                'title' => 'Lomba Mewarnai Tema Kasih Sesama di Hari Valentine',
                'content' => 'Anak-anak mengekspresikan kreativitas mereka melalui warna-warni ceria dalam rangka merayakan hari kasih sayang. Kegiatan ini diikuti oleh seluruh siswa TK A dan TK B dengan antusiasme yang luar biasa. Karya terbaik akan dipajang di ruang galeri sekolah. Melalui kegiatan ini, anak-anak belajar tentang kasih kepada sesama seperti yang diajarkan oleh Yesus Kristus.',
                'published_at' => '2025-02-10',
            ],
            [
                'title' => 'Ibadat Syukur Bersama Menyambut Masa Pra-Paskah',
                'content' => 'Menanamkan nilai pertobatan dan kesederhanaan sejak dini melalui doa bersama yang diikuti oleh seluruh siswa dan guru. Ibadat dipimpin oleh Romo Paroki setempat dan diisi dengan nyanyian serta cerita Alkitab yang dikemas secara interaktif. Anak-anak juga diajak untuk melakukan aksi pantang sebagai bentuk pengorbanan kecil mereka.',
                'published_at' => '2025-02-08',
            ],
        ];
        foreach ($news as $data) {
            News::firstOrCreate(['title' => $data['title']], $data);
        }
    }

    private function seedActivities(): void
    {
        $activities = [
            [
                'title' => 'Doa Pagi & Lingkaran Kasih',
                'description' => 'Mengawali hari dengan syukur, nyanyian pujian, dan saling menyapa untuk membangun rasa persaudaraan di antara siswa.',
                'activity_date' => '2025-02-03',
            ],
            [
                'title' => 'Eksplorasi Kreatif',
                'description' => 'Waktu bagi anak-anak untuk belajar konsep dasar matematika, bahasa, dan sains melalui metode bermain yang interaktif.',
                'activity_date' => '2025-02-04',
            ],
            [
                'title' => 'Paduan Suara & Musik Malaikat',
                'description' => 'Mengembangkan bakat musikalitas anak melalui lagu-lagu rohani dan tradisional dalam harmoni yang indah.',
                'activity_date' => '2025-02-05',
            ],
            [
                'title' => 'Olahraga & Ketangkasan',
                'description' => 'Melatih motorik kasar dan koordinasi tubuh melalui permainan lapangan yang seru dan mendidik.',
                'activity_date' => '2025-02-06',
            ],
            [
                'title' => 'Melukis Ceria',
                'description' => 'Mengekspresikan imajinasi dan kreativitas anak melalui berbagai media seni lukis yang menyenangkan.',
                'activity_date' => '2025-02-07',
            ],
            [
                'title' => 'Storytelling & Literasi Dasar',
                'description' => 'Membangun kecintaan pada buku dan memperkaya kosa kata melalui sesi bercerita yang interaktif.',
                'activity_date' => '2025-02-10',
            ],
        ];
        foreach ($activities as $data) {
            Activity::firstOrCreate(['title' => $data['title']], $data);
        }
    }

    private function seedGalleries(): void
    {
        $images = [
            'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1523050854058-8df90110c7f1?w=600&h=800&fit=crop',
            'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=600&h=600&fit=crop',
            'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=600&h=600&fit=crop',
            'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=1400&h=600&fit=crop',
        ];
        $titles = [
            'Sesi Bercerita Pagi',
            'Pojok Doa',
            'Kreativitas Blok',
            'Bimbingan Seni',
            'Momen Kebersamaan Keluarga Besar',
        ];
        foreach ($images as $i => $url) {
            Gallery::firstOrCreate(
                ['image_path' => $url],
                ['title' => $titles[$i] ?? 'Dokumentasi']
            );
        }
    }

    private function seedFaqs(): void
    {
        $faqs = [
            [
                'question' => 'Kapan periode pendaftaran siswa baru dimulai?',
                'answer' => 'Pendaftaran siswa baru untuk tahun ajaran mendatang biasanya dimulai pada bulan Januari setiap tahunnya. Kami menyarankan orang tua untuk mendaftar lebih awal karena kuota kelas kami yang terbatas untuk menjaga kualitas bimbingan guru terhadap siswa.',
                'order' => 1,
            ],
            [
                'question' => 'Apa saja syarat usia untuk masuk kelompok bermain (KB) dan TK?',
                'answer' => 'Kelompok Bermain (KB): Minimal 3 tahun per bulan Juli. TK A: Minimal 4 tahun per bulan Juli. TK B: Minimal 5 tahun per bulan Juli.',
                'order' => 2,
            ],
            [
                'question' => 'Apakah ada skema cicilan untuk uang pangkal?',
                'answer' => 'Ya, Taman Seminari TK memahami kebutuhan setiap keluarga. Kami menyediakan opsi cicilan untuk uang pangkal yang dapat dibayarkan hingga maksimal 3 kali cicilan dalam satu semester pertama.',
                'order' => 3,
            ],
            [
                'question' => 'Apa saja yang sudah termasuk dalam biaya sekolah bulanan (SPP)?',
                'answer' => 'SPP bulanan mencakup biaya pendidikan inti, pemeliharaan fasilitas sekolah, dan kegiatan kurikulum harian. Biaya ini tidak termasuk makan siang (catering opsional), buku paket tahunan, dan seragam sekolah.',
                'order' => 4,
            ],
            [
                'question' => 'Bagaimana jadwal sekolah harian untuk siswa TK?',
                'answer' => 'Kegiatan belajar mengajar dimulai pukul 07:30 dan berakhir pukul 11:30 untuk TK A & B. Sedangkan untuk Kelompok Bermain berakhir pukul 10:30. Hari sekolah adalah Senin sampai Jumat.',
                'order' => 5,
            ],
            [
                'question' => 'Apa saja jenis seragam yang wajib dimiliki siswa?',
                'answer' => 'Siswa diwajibkan memiliki 3 jenis seragam: Seragam Identitas Taman Seminari (Senin-Selasa), Seragam Olahraga (Rabu), dan Seragam Batik/Bebas Sopan sesuai tema (Kamis-Jumat).',
                'order' => 6,
            ],
        ];
        foreach ($faqs as $data) {
            Faq::firstOrCreate(['question' => $data['question']], $data);
        }
    }
}
