<?php

namespace Database\Seeders;

use App\Models\DataBackup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataBackupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataBackup::insert([
            'backup' => 'internal Server'
        ]);

        DataBackup::insert([
            'backup' => 'veeam-tool backup'
        ]);

        DataBackup::insert([
            'backup' => 'snapshot nutanix'
        ]);

        DataBackup::insert([
            'backup' => 'tape backup'
        ]);
    }
}
