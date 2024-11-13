<?php

namespace Database\Seeders;

use App\Models\Sponsorship;
use App\Models\SponsorshipTier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!config('app.debug') || config('app.env') != 'local') return;

        if (Sponsorship::query()->withoutCache()->count() == 0) {
            $tiers = SponsorshipTier::select('id')->get();
            if ($tiers->isEmpty()) return;

            $sponsorships = Sponsorship::factory(4)->make()->toArray();

            $time = now();
            $sponsorships = array_map(function ($sponsorship) use ($time, $tiers) {
                return array_merge($sponsorship, [
                    'id' => Str::uuid(),
                    'tier_id' => $tiers->random()->id,
                    'logo' => 'https://pengajuan-dosenlb.telkomuniversity.ac.id/assets/images/telu_logo.png',
                    'created_at' => $time,
                    'updated_at' => $time
                ]);
            }, $sponsorships);

            Sponsorship::insert($sponsorships);
        }
    }
}
