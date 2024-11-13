<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            MediaPartnerSeeder::class,
            TimelineSeeder::class,
            CompetitionLevelSeeder::class,
            CompetitionSeeder::class,
            SponsorshipTierSeeder::class,
            SponsorshipSeeder::class,
            PaymentMethodSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
