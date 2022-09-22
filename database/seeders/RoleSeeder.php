<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            'role' => 'User'
        ]);

        Role::insert([
            'role' => 'Kepala Seksi'
        ]);

        Role::insert([
            'role' => 'Kepala Divisi'
        ]);

        Role::insert([
            'role' => 'Kepala Depertemen'
        ]);

        Role::insert([
            'role' => 'Super Admin'
        ]);
    }
}
