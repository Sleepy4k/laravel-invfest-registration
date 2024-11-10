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
        if (config('app.debug') || config('app.env') != 'local') return;

        if (Competition::query()->withoutCache()->count() == 0) {
            $levelId = CompetitionLevel::select('id')->where('level', 'universitas')->first()?->id;
            if (empty($levelId) || $levelId == null) return;

            $competitions = Competition::factory(6)->make()->toArray();

            $time = now();
            $competitions = array_map(function ($competition) use ($time, $levelId) {
                return array_merge($competition, [
                    'id' => Str::uuid(),
                    'slug' => Str::slug($competition['name']),
                    'level_id' => $levelId,
                    'created_at' => $time,
                    'updated_at' => $time
                ]);
            }, $competitions);

            Competition::insert($competitions);
        }
    }
}
