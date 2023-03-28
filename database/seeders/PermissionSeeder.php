<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;
use DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();

        $permissions = [
            //Role
            ['name' => 'role-create', 'group' => 'Role', 'title' => 'Create', 'guard_name' => 'web'],
            ['name' => 'role-view', 'group' => 'Role', 'title' => 'View', 'guard_name' => 'web'],
            ['name' => 'role-edit', 'group' => 'Role', 'title' => 'Edit', 'guard_name' => 'web'],
            ['name' => 'role-delete', 'group' => 'Role', 'title' => 'Delete', 'guard_name' => 'web'],

            //User
            ['name' => 'user-create', 'group' => 'User', 'title' => 'Create', 'guard_name' => 'web'],
            ['name' => 'user-view', 'group' => 'User', 'title' => 'View', 'guard_name' => 'web'],
            ['name' => 'user-edit', 'group' => 'User', 'title' => 'Edit', 'guard_name' => 'web'],
            ['name' => 'user-delete', 'group' => 'User', 'title' => 'Delete', 'guard_name' => 'web'],
            
            //Mock Api
            ['name' => 'mock-api-create', 'group' => 'MockApi', 'title' => 'Create', 'guard_name' => 'web'],
            ['name' => 'mock-api-view', 'group' => 'MockApi', 'title' => 'View', 'guard_name' => 'web'],
            ['name' => 'mock-api-edit', 'group' => 'MockApi', 'title' => 'Edit', 'guard_name' => 'web'],
            ['name' => 'mock-api-delete', 'group' => 'MockApi', 'title' => 'Delete', 'guard_name' => 'web'],

            ['name' => 'custom-mock-api-create', 'group' => 'MockApi', 'title' => 'Create', 'guard_name' => 'web'],
            ['name' => 'custom-mock-api-view', 'group' => 'MockApi', 'title' => 'View', 'guard_name' => 'web'],
            ['name' => 'custom-mock-api-edit', 'group' => 'MockApi', 'title' => 'Edit', 'guard_name' => 'web'],
            ['name' => 'custom-mock-api-delete', 'group' => 'MockApi', 'title' => 'Delete', 'guard_name' => 'web'],
        ];

        DB::table('permissions')->insert($permissions);
    }
}
