<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::query()->withoutCache()->count() == 0) {
            $users = [
                [
                    'email' => 'admin@invfest.id',
                    'password' => 'Invfest09@TUP2024*!',
                    'role' => 'admin'
                ],
                [
                    'email' => 'petugas@invfest.id',
                    'password' => 'Invfest09@HMIF2024^&',
                    'role' => 'petugas'
                ]
            ];

            array_map(function ($user) {
                $role = $user['role'];
                unset($user['role']);
                $user['email_verified_at'] = now();

                User::create($user)->assignRole($role);
            }, $users);
        }
    }
}
