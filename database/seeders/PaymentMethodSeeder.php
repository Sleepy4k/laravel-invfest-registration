<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (PaymentMethod::query()->withoutCache()->count() == 0) {
            $methods = [
                [
                    'name' => 'BANK NEGARA INDONESIA',
                    'logo' => 'https://i.pinimg.com/originals/36/38/43/36384348ef9d7bfff66da6da9e975d56.png',
                    'number' => '1901714200',
                    'owner' => 'Siti Madina Halim Siregar'
                ],
                [
                    'name' => 'LINK AJA',
                    'logo' => 'https://1.bp.blogspot.com/-7DDxB4TD0Q0/YH5-ZbDvj0I/AAAAAAAACjA/GHvzMNzuy1cKxLQ6oziIlZx9Qn3pWM_mwCNcBGAsYHQ/s2048/Link%2BAja.png',
                    'number' => '082280600238',
                    'owner' => 'Siti Madina Halim Siregar'
                ],
                [
                    'name' => 'SEABANK',
                    'logo' => 'https://play-lh.googleusercontent.com/ZGLrjk0PKIj2L4DaWiKmhAf0f6cBXml6eHgjRpJhQ4XQpGvw4T5d4hjl_EQF5jY9Vked',
                    'number' => '901296635774',
                    'owner' => 'Salsabila Septi Sukmayanti'
                ]
            ];

            $time = now();
            $methods = array_map(function ($method) use ($time) {
                return array_merge($method, [
                    'id' => Str::uuid(),
                    'created_at' => $time,
                    'updated_at' => $time
                ]);
            }, $methods);

            PaymentMethod::insert($methods);
        }
    }
}
