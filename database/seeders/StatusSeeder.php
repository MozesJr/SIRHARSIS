<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::insert([
            'status' => 'On Proses'
        ]);

        Status::insert([
            'status' => 'Success'
        ]);

        Status::insert([
            'status' => 'Non Success'
        ]);
    }
}
