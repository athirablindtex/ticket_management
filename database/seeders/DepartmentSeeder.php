<?php
namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        // Clear the departments table before seeding (optional)
        Department::truncate();

        // Create departments
        Department::create([
            'name' => 'Sales',
            'user_id' => 1, // Adjust user_id as necessary
        ]);

        Department::create([
            'name' => 'IT',
            'user_id' => 1, // Adjust user_id as necessary
        ]);

        Department::create([
            'name' => 'Accounts',
            'user_id' => 2, // Adjust user_id as necessary
        ]);
    }
}
