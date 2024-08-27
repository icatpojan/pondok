<?php

use App\Kelas;
use App\Mapel;
use App\MapelKelas;
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

        $guru = User::create([
            'username'      => 'guru',
            'password'  => bcrypt('guru'),
        ]);
        $guru->assignRole('guru');

        $guru = User::create([
            'username'      => 'guru2',
            'password'  => bcrypt('guru2'),
        ]);
        $guru->assignRole('guru');


        $murid = User::create([
        'username' => 'murid',
        'kelas_id' => 1,
        'password' => bcrypt('murid'),
        ]);
        $murid->assignRole('murid');

        $murid = User::create([
            'username' => 'murid2',
            'kelas_id' => 2,
            'password' => bcrypt('murid2'),
        ]);
        $murid->assignRole('murid');

        $kelas = Kelas::create([
            'name' => '1',
        ]);

        $kelas = Kelas::create([
            'name' => '2',
        ]);

        $kelas = Kelas::create([
            'name' => '3',
        ]);

        $mapel = Mapel::create([
            'name' => 'B.INDO',
        ]);

        $mapel = Mapel::create([
            'name' => 'B.INGGRIS',
        ]);

        $mapel = Mapel::create([
            'name' => 'PKN',
        ]);

        $mapel = MapelKelas::create([
            'guru_id' => 2,
            'kelas_id' => 2,
            'mapel_id' => 1,
        ]);

        $mapel = MapelKelas::create([
            'guru_id' => 3,
            'kelas_id' => 2,
            'mapel_id' => 1,
        ]);

    }
}
