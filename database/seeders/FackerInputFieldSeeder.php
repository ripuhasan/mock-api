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
        DB::table('faker_input_fields')->delete();

        $fields = [
            ['name' => 'First Name', 'key' => 'firstName', 'is_active' => '1'],
        ];

        DB::table('faker_input_fields')->insert($fields);
    }
}
