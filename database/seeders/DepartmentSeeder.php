<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create([
            'name' => 'Support',
            'description' => 'Support department',
            'status' => 1,
        ]);

        Department::create([
            'name' => 'Sales',
            'description' => 'Sales department',
            'status' => 1,
        ]);
    }
}
