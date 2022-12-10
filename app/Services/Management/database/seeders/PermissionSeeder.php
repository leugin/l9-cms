<?php

namespace App\Services\Management\database\seeders;

use App\Foundation\Modules\Data\Repository\ModuleRepository;
use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param ModuleRepository $repository
     * @return void
     */
    public function run(ModuleRepository $repository):void
    {
        print_r($repository->all());
    }
}
