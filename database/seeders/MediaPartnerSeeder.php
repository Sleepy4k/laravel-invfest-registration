<?php

namespace Database\Seeders;

use App\Models\MediaPartner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MediaPartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (config('app.debug') || config('app.env') != 'local') return;

        if (MediaPartner::query()->withoutCache()->count() == 0) {
            $partners = MediaPartner::factory(6)->make()->toArray();

            $time = now();
            $partners = array_map(function ($partner) use ($time) {
                return array_merge($partner, [
                    'id' => Str::uuid(),
                    'created_at' => $time,
                    'updated_at' => $time
                ]);
            }, $partners);

            MediaPartner::insert($partners);
        }
    }
}
