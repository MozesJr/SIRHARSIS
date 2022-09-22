<?php

namespace Database\Seeders;

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
    }
}
