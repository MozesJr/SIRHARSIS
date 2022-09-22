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
            'level' => 'Low Priority'
        ]);

        Level::insert([
            'level' => 'Medium Priority'
        ]);

        Level::insert([
            'level' => 'High Priority'
        ]);

        Level::insert([
            'level' => 'Very High Priority'
        ]);
    }
}
