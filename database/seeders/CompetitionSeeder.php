<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\CompetitionLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!config('app.debug') || config('app.env') != 'local') return;

        if (Competition::query()->withoutCache()->count() == 0) {
            $levelUnivId = CompetitionLevel::select('id')->where('level', 'Universitas')->first()?->id ?? null;
            $levelUmumId = CompetitionLevel::select('id')->where('level', 'Umum')->first()?->id ?? null;

            $competitions = [
                [
                    'name' => 'Bisnis Plan',
                    'description' => 'yo nda tau',
                    'registration_fee' => rand(1000000, 10000000),
                    'whatsapp_group' => null,
                    'level_id' => $levelUnivId
                ],
                [
                    'name' => 'UI/UX Design',
                    'description' => 'yo nda tau',
                    'registration_fee' => rand(1000000, 10000000),
                    'whatsapp_group' => null,
                    'level_id' => $levelUmumId
                ],
                [
                    'name' => 'Web Programming',
                    'description' => 'yo nda tau',
                    'registration_fee' => rand(1000000, 10000000),
                    'whatsapp_group' => null,
                    'level_id' => $levelUmumId
                ],
            ];

            $time = now();
            $competitions = array_map(function ($competition) use ($time) {
                return array_merge($competition, [
                    'id' => Str::uuid(),
                    'slug' => Str::slug($competition['name']),
                    'poster' => 'https://pengajuan-dosenlb.telkomuniversity.ac.id/assets/images/telu_logo.png',
                    'guidebook' => null,
                    'created_at' => $time,
                    'updated_at' => $time
                ]);
            }, $competitions);

            Competition::insert($competitions);
        }
    }
}
