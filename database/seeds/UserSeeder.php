<?php

use App\User;
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
            'username'      => 'admin',
            'password'  => bcrypt('admin'),
        ]);
        $admin->assignRole('admin');

        $pengurus = User::create([
            'username'      => 'pengurus',
            'password'  => bcrypt('pengurus'),
        ]);
        $pengurus->assignRole('pengurus');

        $operator = User::create([
        'username' => 'operator',
        'password' => bcrypt('operator'),
        ]);
        $operator->assignRole('operator');
    }
}