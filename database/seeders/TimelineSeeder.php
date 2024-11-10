<?php

namespace Database\Seeders;

use App\Models\Timeline;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (config('app.debug') || config('app.env') != 'local') return;

        if (Timeline::query()->withoutCache()->count() == 0) {
            $timelines = Timeline::factory(6)->make()->toArray();

            $time = now();
            $timelines = array_map(function ($timeline) use ($time) {
                return array_merge($timeline, [
                    'id' => Str::uuid(),
                    'created_at' => $time,
                    'updated_at' => $time
                ]);
            }, $timelines);

            Timeline::insert($timelines);
        }
    }
}
