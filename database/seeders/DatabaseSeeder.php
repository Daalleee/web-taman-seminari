<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::firstOrCreate(
            ['email' => 'admin@tamanseminari.com'],
            ['name' => 'Administrator', 'password' => Hash::make('password123')]
        );

        // Default Settings
        $settings = [
            ['key' => 'school_name', 'value' => 'Taman Seminari'],
            ['key' => 'about_text', 'value' => 'Taman Seminari didirikan dengan komitmen untuk menyediakan lingkungan belajar yang aman, merangsang, dan penuh kasih sayang bagi anak-anak usia dini. Kami percaya bahwa setiap anak adalah individu unik dengan potensi tak terbatas.'],
            ['key' => 'vision', 'value' => 'Menjadi lembaga pendidikan usia dini terdepan yang membentuk karakter unggul dan kecerdasan komprehensif.'],
            ['key' => 'mission', 'value' => 'Menyelenggarakan pendidikan yang interaktif, menanamkan nilai moral, dan mendorong kreativitas anak.'],
            ['key' => 'phone', 'value' => '+62 812 3456 7890'],
            ['key' => 'email', 'value' => 'info@tamanseminari.com'],
            ['key' => 'address', 'value' => 'Jl. Pendidikan No. 1, Desa ITCI, Penajam Paser Utara'],
            ['key' => 'map_embed', 'value' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.1!2d116.8!3d-1.2!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM8KwMTInMDAuMCJTIDExNsKwNDgnMDAuMCJF!5e0!3m2!1sen!2sid!4v1620000000000!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }
    }
}
