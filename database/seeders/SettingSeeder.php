<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Setting::query()->withoutCache()->count() == 0) {
            $settings = [
                [
                    'key' => 'title',
                    'value' => 'INVFEST X IST 9.0',
                ],
                [
                    'key' => 'slogan',
                    'value' => 'Spark the Vision, Light the World',
                ],
                [
                    'key' => 'heading',
                    'value' => 'Time to Shine: Spark the Vision, Light the World, panggilan buat kamu yang siap tampil all-out! Saatnya menunjukkan inovasi yang bisa menginspirasi dan membawa perubahan nyata. Ini waktunya kamu bersinar dengan ide segar yang bisa menginspirasi dan mengubah dunia',
                ],
                [
                    'key' => 'description',
                    'value' => 'INVFEST X ISF 9.0 ini merupakan gabungan keren antara Informatics Innovation Festival (INVFEST) dan Informatics Sport Festival (ISF)! Acara tahunan ini adalah kompetisi teknologi nasional yang digelar oleh Himpunan Mahasiswa Teknik Informatika, tempat kamu bisa berkreasi dan bersaing di bidang teknologi, e-sports, dan olahraga. INVFEST X ISF 9.0 memiliki tema Time to Shine: Spark the Vision, Light the World, panggilan buat kamu yang siap tampil all-out! Saatnya menunjukkan inovasi yang bisa menginspirasi dan membawa perubahan nyata. Ini waktunya kamu bersinar dengan ide segar yang bisa menginspirasi dan mengubah dunia',
                ],
                [
                    'key' => 'deadline',
                    'value' => '2024-11-30T14:47',
                ],
                [
                    'key' => 'phone',
                    'value' => '6281234567890',
                ],
                [
                    'key' => 'primary_color',
                    'value' => '#2e2d2d',
                ],
                [
                    'key' => 'primary_color_hover',
                    'value' => '#eeba2b',
                ],
                [
                    'key' => 'secondary_color',
                    'value' => '#eeba2b',
                ],
                [
                    'key' => 'secondary_color_hover',
                    'value' => '#2e2d2d',
                ],
                [
                    'key' => 'twibbon_link',
                    'value' => 'https://bit.ly/TWIBBON_INVFESTXISF',
                ],
                [
                    'key' => 'instagram',
                    'value' => 'https://www.instagram.com/official.invfestxisf',
                ],
                [
                    'key' => 'video_tutorial',
                    'value' => 'https://www.youtube.com/embed/LDT5cLIaRpw?si=_UKktn-lfWoQYhkF',
                ],
            ];

            $files = [
                [
                    'key' => 'nav_logo',
                    'value' => asset('images/logo.png'),
                ],
                [
                    'key' => 'twibbon',
                    'value' => asset('images/logo.png'),
                ],
                [
                    'key' => 'mascot',
                    'value' => asset('images/logo.png'),
                ],
            ];

            $time = now();
            $settings = array_map(function ($role) use ($time) {
                return array_merge($role, [
                    'id' => Str::uuid(),
                    'created_at' => $time,
                    'updated_at' => $time
                ]);
            }, array_merge($settings, $files));

            Setting::insert($settings);
        }
    }
}
