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
        //AKUN SUPER ADMIN
        User::insert([
            'name' => 'Mozes Markus Sapari',
            'email' => 'mozessapari@gmail.com',
            'password' => Hash::make('123123'),
            'username' => 'mozes.sapari',
            'id_role' => 5,
            'id_job' => 1,
        ]);

        User::insert([
            'name' => 'SEKSI HARSIS',
            'email' => 'harsis@gmail.com',
            'password' => Hash::make('P3rur12345!!'),
            'username' => 'admin',
            'id_role' => 5,
            'id_job' => 1,
        ]);

        //AKUN ATASAN

        User::insert([
            'name' => 'Tedi Hermawan',
            'email' => 'tedi.hermawan@peruri.co.id',
            'password' => Hash::make('peruri123'),
            'username' => 'tedi.hermawan',
            'id_role' => 1,
            'id_job' => 1,
        ]);

        User::insert([
            'name' => 'Sunarti',
            'email' => 'sunarti@peruri.co.id',
            'password' => Hash::make('peruri123'),
            'username' => 'sunarti',
            'id_role' => 1,
            'id_job' => 1,
        ]);

        User::insert([
            'name' => 'Zanna Chobitha Arithusa',
            'email' => 'zanna.arithusa@peruri.co.id',
            'password' => Hash::make('peruri123'),
            'username' => 'zanna.arithusa',
            'id_role' => 1,
            'id_job' => 1,
        ]);

        User::insert([
            'name' => 'Fadhilla Puji Cahyani',
            'email' => 'fadhilla.cahyani@peruri.co.id',
            'password' => Hash::make('peruri123'),
            'username' => 'fadhilla.cahyani',
            'id_role' => 1,
            'id_job' => 1,
        ]);

        User::insert([
            'name' => 'Riza Sauqi Valasev',
            'email' => 'riza.valasev@peruri.co.id',
            'password' => Hash::make('peruri123'),
            'username' => 'riza.valasev',
            'id_role' => 1,
            'id_job' => 3,
        ]);

        //AKUN Mozes
        User::insert([
            'name' => 'Mozes Sapari',
            'email' => 'mozessapari11@gmail.com',
            'password' => Hash::make('123123'),
            'username' => 'm.sapari',
            'id_role' => 1,
            'id_job' => 3,
        ]);
    }
}
