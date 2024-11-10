<?php

namespace Database\Seeders;

use App\Models\CompetitionLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompetitionLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (CompetitionLevel::query()->withoutCache()->count() == 0) {
            $levels = [
                [
                    'level' => 'universitas'
                ]
            ];

            $time = now();
            $levels = array_map(function ($level) use ($time) {
                return array_merge($level, [
                    'id' => Str::uuid(),
                    'created_at' => $time,
                    'updated_at' => $time
                ]);
            }, $levels);

            CompetitionLevel::insert($levels);
        }
    }
}
