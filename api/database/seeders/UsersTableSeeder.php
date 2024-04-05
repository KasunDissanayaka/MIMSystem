<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $roles = [
            ['name' => 'Owner'],
            ['name' => 'Manager'],
            ['name' => 'Cashier']
        ];

        DB::table('roles')->insert($roles);

        $users = [
            [
                'name' => 'Kasun Dissanayaka',
                'email' => 'kasund@gmail.com',
                'password' => Hash::make('12345'),
                'role_id' => 1,
            ],
            [
                'name' => 'Rehan Kalhara',
                'email' => 'rehan@gmail.com',
                'password' => Hash::make('12345'),
                'role_id' => 2,
            ],
            [
                'name' => 'Dumal Silva',
                'email' => 'dumal@gmail.com',
                'password' => Hash::make('12345'),
                'role_id' => 3,
            ],
        ];

        DB::table('users')->insert($users);
    }
}
