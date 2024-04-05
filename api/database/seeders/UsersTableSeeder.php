<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Kasun Dissanayaka',
                'email' => 'kasund@gmail.com',
                'password' => Hash::make('12345'),
            ],
            [
                'name' => 'Rehan Kalhara',
                'email' => 'rehan@gmail.com',
                'password' => Hash::make('12345'),
            ],
            [
                'name' => 'Dumal Silva',
                'email' => 'dumal@gmail.com',
                'password' => Hash::make('12345'),
            ],
        ];

        DB::table('users')->insert($users);

        Role::create(['name' => 'Owner']);
        Role::create(['name' => 'Manager']);
        Role::create(['name' => 'Cashier']);

        Permission::create(['name' => 'medication_read', 'description' => 'Read medications']);
        Permission::create(['name' => 'medication_update', 'description' => 'Update medications']);
        Permission::create(['name' => 'customer_read', 'description' => 'Read customers']);
        Permission::create(['name' => 'customer_update', 'description' => 'Update customers']);
        Permission::create(['name' => 'medication_write', 'description' => 'Write medications']);
        Permission::create(['name' => 'customer_write', 'description' => 'Write customers']);
        Permission::create(['name' => 'permanent_delete', 'description' => 'Permanently delete records']);
        Permission::create(['name' => 'soft_delete', 'description' => 'Soft delete records']);

        $roles = Role::all();
        $permissions = Permission::all();

        $ownerPermissions = $permissions->pluck('id')->toArray();
        $roles->firstWhere('name', 'Owner')->syncPermissions($ownerPermissions);

        $managerPermissions = $permissions->whereIn('name', ['soft_delete', 'medication_update','medication_read', 'customer_read', 'customer_update'])->pluck('id')->toArray();
        $roles->firstWhere('name', 'Manager')->syncPermissions($managerPermissions);

        $cashierPermissions = $permissions->whereIn('name', ['medication_read', 'medication_update', 'customer_read', 'customer_update'])->pluck('id')->toArray();
        $roles->firstWhere('name', 'Cashier')->syncPermissions($cashierPermissions);

        $user1 = User::find(1);
        $user1->assignRole('Owner');

        $user2 = User::find(2);
        $user2->assignRole('Manager');

        $user3 = User::find(3);
        $user3->assignRole('Cashier');

    }
}
