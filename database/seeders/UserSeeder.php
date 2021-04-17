<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'phone' => '0812345678910',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123')
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'User',
            'phone' => '0812345678910',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user1234')
        ]);

        $user->assignRole('user');
    }
}
