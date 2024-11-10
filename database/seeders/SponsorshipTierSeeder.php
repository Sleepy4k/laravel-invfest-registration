<?php

namespace Database\Seeders;

use App\Models\SponsorshipTier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SponsorshipTierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (SponsorshipTier::query()->withoutCache()->count() == 0) {
            $tiers = [
                [
                    'tier' => 'bronze'
                ],
                [
                    'tier' => 'silver'
                ],
                [
                    'tier' => 'gold'
                ],
                [
                    'tier' => 'platinum'
                ]
            ];

            $time = now();
            $tiers = array_map(function ($tier) use ($time) {
                return array_merge($tier, [
                    'id' => Str::uuid(),
                    'created_at' => $time,
                    'updated_at' => $time
                ]);
            }, $tiers);

            SponsorshipTier::insert($tiers);
        }
    }
}
