<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Role::query()->count() == 0) {
            app()[PermissionRegistrar::class]->forgetCachedPermissions();

            $roles = [
                [
                    'name' => 'team',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'petugas',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'admin',
                    'guard_name' => 'web'
                ]
            ];

            $time = now();
            $roles = array_map(function ($role) use ($time) {
                return array_merge($role, [
                    'created_at' => $time,
                    'updated_at' => $time
                ]);
            }, $roles);

            Role::insert($roles);
        }
    }
}
