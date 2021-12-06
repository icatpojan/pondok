<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Status::insert([
            ['name' => 'Tersedia'],
            ['name' => 'Ditawarkan'],
            ['name' => 'Terjual'],
            ['name' => 'Rusak'],
            ['name' => 'Retur']
        ]);
    }
}