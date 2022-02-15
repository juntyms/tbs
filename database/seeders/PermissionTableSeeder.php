<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            
            'TBS-managment',
            'acadmicyear-list',
            'acadmicyear-add',
            'acadmicyear-edit',
            'acadmicyear-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'course-list',
            'course-create',
            'course-edit',
            'course-delete',
            'all-deps',
            'dep-list',
            'dep-user',
            'dep-course',
            'dep-course-add',
            'dep-course-edit',
            'dep-course-delete',
            'dep-TBS',
            'dep-tutor-list',
            'dep-tutor-add',
            'dep-tutor-delete',
            'dep-AVcourse-list',
            'dep-AVcourse-add',
            'dep-AVcourse-delete',
            'booking',
            'booking-dep',
            'booking-select',
            'student-tutorials',
            'student-schedule',
            'tutor-tutorials',
            'tutor-schdual',
            'edit-profile'
            
         ];
      
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
