<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'Mozes Markus Sapari',
            'email' => 'mozessapari@gmail.com',
            'password' => Hash::make('123123'),
            'username' => 'mozes.sapari',
            'id_role' => 5,
            'id_job' => 1,
        ]);

        User::insert([
            'name' => 'Mozes Sapari',
            'email' => 'mozessapari11@gmail.com',
            'password' => Hash::make('123123'),
            'username' => 'm.sapari',
            'id_role' => 1,
            'id_job' => 1,
        ]);
    }
}
