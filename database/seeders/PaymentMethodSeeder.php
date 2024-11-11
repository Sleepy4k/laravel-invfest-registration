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
        if (!config('app.debug') || config('app.env') != 'local') return;

        if (PaymentMethod::query()->withoutCache()->count() == 0) {
            $methods = PaymentMethod::factory(4)->make()->toArray();

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
