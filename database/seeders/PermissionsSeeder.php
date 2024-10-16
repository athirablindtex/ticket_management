<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create permissions
        $permissions = [
            'user_create',
            'user_edit',
            'user_delete',
            'department_add',
            'department_delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

 
    }
}
