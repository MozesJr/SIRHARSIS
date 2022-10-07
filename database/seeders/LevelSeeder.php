<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::insert([
            'level' => 'Low Priority',
            'id_ext' => 1,
        ]);

        Level::insert([
            'level' => 'Medium Priority',
            'id_ext' => 1,
        ]);

        Level::insert([
            'level' => 'High Priority',
            'id_ext' => 1,
        ]);

        Level::insert([
            'level' => 'Very High Priority',
            'id_ext' => 1,
        ]);

        Level::insert([
            'level' => 'Core',
            'id_ext' => 2,
        ]);

        Level::insert([
            'level' => 'Non Core',
            'id_ext' => 2,
        ]);
    }
}
