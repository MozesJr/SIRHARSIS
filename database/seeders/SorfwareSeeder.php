<?php

namespace Database\Seeders;

use App\Models\Ext;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SorfwareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ext::insert([
            'name' => 'MySQL',
            'id_ext' => 1,
        ]);

        Ext::insert([
            'name' => 'SQL Server',
            'id_ext' => 1,
        ]);

        Ext::insert([
            'name' => 'Laravel',
            'id_ext' => 2,
        ]);

        Ext::insert([
            'name' => 'CodeIgniter',
            'id_ext' => 2,
        ]);
    }
}
