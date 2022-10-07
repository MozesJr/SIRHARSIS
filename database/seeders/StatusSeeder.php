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
            'status' => 'Open',
            'id_ext' => 1,
        ]);

        Status::insert([
            'status' => 'On Proses',
            'id_ext' => 1,
        ]);

        Status::insert([
            'status' => 'Success',
            'id_ext' => 1,
        ]);

        Status::insert([
            'status' => 'Non Success',
            'id_ext' => 1,
        ]);

        Status::insert([
            'status' => 'Closed',
            'id_ext' => 1,
        ]);

        Status::insert([
            'status' => 'Active',
            'id_ext' => 2,
        ]);

        Status::insert([
            'status' => 'Pending',
            'id_ext' => 2,
        ]);

        Status::insert([
            'status' => 'Inactive',
            'id_ext' => 2,
        ]);
    }
}
