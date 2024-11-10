<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
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

            $roles = Role::factory()->make();

            Role::insert($roles->toArray());
        }
    }
}
