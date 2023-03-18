<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminPermissions = Permission::all();
        Role::updateOrCreate([
            'name' => 'Admin',
            'slug' => 'admin',
            'guard_name' => 'web',
            'deletable' => false
        ])->permissions()
        ->sync($adminPermissions->pluck('id'));

        Role::updateOrCreate([
            'name' => 'Author',
            'slug' => 'author',
            'guard_name' => 'web',
            'deletable' => false
        ])->permissions();
    }
}
