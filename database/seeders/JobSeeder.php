<?php

namespace Database\Seeders;

use App\Models\Engine;
use App\Models\EngineDB;
use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Job::insert([
            'job' => 'Application Administrator'
        ]);

        Job::insert([
            'job' => 'Database Administrator'
        ]);

        Job::insert([
            'job' => 'PKWT'
        ]);

        EngineDB::insert([
            'engine' => 'MySQL'
        ]);

        EngineDB::insert([
            'engine' => 'SQL Server'
        ]);

        EngineDB::insert([
            'engine' => 'Oracle'
        ]);

        Engine::insert([
            'engine' => 'Laravel'
        ]);

        Engine::insert([
            'engine' => 'CodeIgniter'
        ]);

        Engine::insert([
            'engine' => 'YII'
        ]);
    }
}
