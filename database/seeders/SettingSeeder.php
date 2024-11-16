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
                    'value' => 'InvFest 9.0',
                ],
                [
                    'key' => 'slogan',
                    'value' => 'Spark the Vision, Light the World',
                ],
                [
                    'key' => 'heading',
                    'value' => 'Dive into the Metaverse, where Creativity and Athletic Thecnology collide for limitless exploration',
                ],
                [
                    'key' => 'description',
                    'value' => 'InvFest (Informatics Innovation Festival) adalah acara kompetisi nasional Dies Natalis dari Program Studi S1 Teknik Informatika Telkom University Purwokerto ke 9, Tema ini mengajak untuk menjelajahi metaverse, dimana kreativitas dan teknologi yang terkait dengan olahraga bersatu untuk menciptakan pengalaman eksplorasi yang tak terbatas',
                ],
                [
                    'key' => 'deadline',
                    'value' => '2024-12-07',
                ],
                [
                    'key' => 'phone',
                    'value' => '081234567890',
                ],
                [
                    'key' => 'primary_color',
                    'value' => '#2e2d2d',
                ],
                [
                    'key' => 'primary_color_hover',
                    'value' => '#fffdfa',
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
                    'value' => 'https://invfest.id',
                ],
                [
                    'key' => 'instagram',
                    'value' => 'https://www.instagram.com/official.invfestxisf',
                ]
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
