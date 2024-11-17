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
        if (MediaPartner::query()->withoutCache()->count() == 0) {
            $partners = [
                [
                    'name' => 'HIMA TUP',
                ],
                [
                    'name' => 'BEM KEMA',
                ],
                [
                    'name' => 'DPM KEMA',
                ],
                [
                    'name' => 'SIRCLE',
                ],
                [
                    'name' => 'HEXACOM',
                ],
                [
                    'name' => 'FUTSAL TUP',
                ],
                [
                    'name' => 'E-SPORT TUP',
                ],
                [
                    'name' => 'HMIF UNSOED',
                ],
                [
                    'name' => 'HMPE UNSOED',
                ],
                [
                    'name' => 'INFOLOMBAIT',
                ],
                [
                    'name' => 'SOEDIRMANTECHNOPHORIA',
                ]
            ];

            $time = now();
            $partners = array_map(function ($partner) use ($time) {
                return array_merge($partner, [
                    'id' => Str::uuid(),
                    'logo' => asset('images/logo.png'),
                    'link' => null,
                    'created_at' => $time,
                    'updated_at' => $time
                ]);
            }, $partners);

            MediaPartner::insert($partners);
        }
    }
}
