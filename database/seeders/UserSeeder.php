<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $users = [
            [
                'name'=> 'Admin',
                'email'=> 'admin@mail.com',
                'password'=> Hash::make('admin1234'),
                'is_admin' => '1',
                'deletable' => '0'
            ],
            [
                'name'=> 'Author',
                'email'=> 'author@mail.com',
                'password'=> Hash::make('author1234'),
                'is_admin' => '0',
                'deletable' => '0'
            ],
        ];

        DB::table('users')->insert($users);

    }
}
