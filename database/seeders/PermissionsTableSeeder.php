<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'manage_business_account_access',
            ],
            [
                'id'    => 18,
                'title' => 'business_account_create',
            ],
            [
                'id'    => 19,
                'title' => 'business_account_edit',
            ],
            [
                'id'    => 20,
                'title' => 'business_account_show',
            ],
            [
                'id'    => 21,
                'title' => 'business_account_delete',
            ],
            [
                'id'    => 22,
                'title' => 'business_account_access',
            ],
            [
                'id'    => 23,
                'title' => 'manage_employee_access',
            ],
            [
                'id'    => 24,
                'title' => 'employee_create',
            ],
            [
                'id'    => 25,
                'title' => 'employee_edit',
            ],
            [
                'id'    => 26,
                'title' => 'employee_show',
            ],
            [
                'id'    => 27,
                'title' => 'employee_delete',
            ],
            [
                'id'    => 28,
                'title' => 'employee_access',
            ],
            [
                'id'    => 29,
                'title' => 'attendance_show',
            ],
            [
                'id'    => 30,
                'title' => 'attendance_access',
            ],
            [
                'id'    => 31,
                'title' => 'business_location_create',
            ],
            [
                'id'    => 32,
                'title' => 'business_location_edit',
            ],
            [
                'id'    => 33,
                'title' => 'business_location_show',
            ],
            [
                'id'    => 34,
                'title' => 'business_location_delete',
            ],
            [
                'id'    => 35,
                'title' => 'business_location_access',
            ],
            [
                'id'    => 36,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
