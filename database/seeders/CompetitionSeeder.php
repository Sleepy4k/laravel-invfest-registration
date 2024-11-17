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
        if (Competition::query()->withoutCache()->count() == 0) {
            $levelUnivId = CompetitionLevel::select('id')->where('level', 'universitas')->first()?->id ?? null;
            $levelUmumId = CompetitionLevel::select('id')->where('level', 'umum')->first()?->id ?? null;

            $competitions = [
                [
                    'name' => 'Bisnis Plan',
                    'description' => 'yo nda tau',
                    'registration_fee' => rand(1000000, 10000000),
                    'whatsapp_group' => 'https://chat.whatsapp.com/Dgy7hr3kGgA12Viar76MNz',
                    'level_id' => $levelUnivId
                ],
                [
                    'name' => 'UI/UX Design',
                    'description' => 'yo nda tau',
                    'registration_fee' => rand(1000000, 10000000),
                    'whatsapp_group' => 'https://chat.whatsapp.com/Db40YbqbHtI2JXE2yz6lsh',
                    'level_id' => $levelUmumId
                ],
                [
                    'name' => 'Web Programming',
                    'description' => 'yo nda tau',
                    'registration_fee' => rand(1000000, 10000000),
                    'whatsapp_group' => 'https://chat.whatsapp.com/HGgeI625VED8Xg857KNWGS',
                    'level_id' => $levelUmumId
                ],
            ];

            $time = now();
            $competitions = array_map(function ($competition) use ($time) {
                return array_merge($competition, [
                    'id' => Str::uuid(),
                    'slug' => Str::slug($competition['name']),
                    'poster' => asset('images/logo.png'),
                    'guidebook' => null,
                    'created_at' => $time,
                    'updated_at' => $time
                ]);
            }, $competitions);

            Competition::insert($competitions);
        }
    }
}
