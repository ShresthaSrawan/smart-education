<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create([
            'name'         => 'admin',
            'display_name' => 'Administrator',
            'description'  => 'Manages everything'
        ]);

        $classTeacherRole = Role::create([
            'name'         => 'class-teacher',
            'display_name' => 'Class Teacher',
            'description'  => 'Manages class'
        ]);

        $teacherRole = Role::create([
            'name'         => 'teacher',
            'display_name' => 'Teacher',
            'description'  => 'Manages single subject'
        ]);

        $parentRole = Role::create([
            'name'         => 'parent',
            'display_name' => 'Parent',
            'description'  => 'Monitors his/her child activities'
        ]);

        /*
         * Admin CRUD Permission
         */
        $createAdminPermission = Permission::create([
            'name'         => 'create-admin',
            'display_name' => 'Create Admin',
            'description'  => 'Can create Admin'
        ]);
        $viewAdminPermission   = Permission::create([
            'name'         => 'view-admin',
            'display_name' => 'View Admin',
            'description'  => 'Can view Admin'
        ]);
        $updateAdminPermission = Permission::create([
            'name'         => 'update-admin',
            'display_name' => 'Update Admin',
            'description'  => 'Can update Admin'
        ]);
        $deleteAdminPermission = Permission::create([
            'name'         => 'delete-admin',
            'display_name' => 'Delete Admin',
            'description'  => 'Can delete Admin'
        ]);

        /*
         * Class Teacher CRUD Permission
         */
        $createClassTeacherPermission = Permission::create([
            'name'         => 'create-class-teacher',
            'display_name' => 'Create Class Teacher',
            'description'  => 'Can create Class Teacher'
        ]);
        $viewClassTeacherPermission   = Permission::create([
            'name'         => 'view-class-teacher',
            'display_name' => 'View Class Teacher',
            'description'  => 'Can view Class Teacher'
        ]);
        $updateClassTeacherPermission = Permission::create([
            'name'         => 'update-class-teacher',
            'display_name' => 'Update Class Teacher',
            'description'  => 'Can update Class Teacher'
        ]);
        $deleteClassTeacherPermission = Permission::create([
            'name'         => 'delete-class-teacher',
            'display_name' => 'Delete Class Teacher',
            'description'  => 'Can delete Class Teacher'
        ]);
        /*
         * Class Teacher CRUD Permission
         */
        $createTeacherPermission = Permission::create([
            'name'         => 'create-teacher',
            'display_name' => 'Create Teacher',
            'description'  => 'Can create Teacher'
        ]);
        $viewTeacherPermission   = Permission::create([
            'name'         => 'view-teacher',
            'display_name' => 'View Teacher',
            'description'  => 'Can view Teacher'
        ]);
        $updateTeacherPermission = Permission::create([
            'name'         => 'update-teacher',
            'display_name' => 'Update Teacher',
            'description'  => 'Can update Teacher'
        ]);
        $deleteTeacherPermission = Permission::create([
            'name'         => 'delete-teacher',
            'display_name' => 'Delete Teacher',
            'description'  => 'Can delete Teacher'
        ]);
        /*
         * Class Teacher CRUD Permission
         */
        $createParentPermission = Permission::create([
            'name'         => 'create-parent',
            'display_name' => 'Create Parent',
            'description'  => 'Can create Parent'
        ]);
        $viewParentPermission   = Permission::create([
            'name'         => 'view-parent',
            'display_name' => 'View Parent',
            'description'  => 'Can view Parent'
        ]);
        $updateParentPermission = Permission::create([
            'name'         => 'update-parent',
            'display_name' => 'Update Parent',
            'description'  => 'Can update Parent'
        ]);
        $deleteParentPermission = Permission::create([
            'name'         => 'delete-parent',
            'display_name' => 'Delete Parent',
            'description'  => 'Can delete Parent'
        ]);

        $adminRole->attachPermissions([
            $createAdminPermission,
            $viewAdminPermission,
            $updateAdminPermission,
            $deleteAdminPermission,
            $createClassTeacherPermission,
            $viewClassTeacherPermission,
            $updateClassTeacherPermission,
            $deleteClassTeacherPermission,
            $createTeacherPermission,
            $viewTeacherPermission,
            $updateTeacherPermission,
            $deleteTeacherPermission,
            $createParentPermission,
            $viewParentPermission,
            $updateParentPermission,
            $deleteParentPermission,
        ]);

        $classTeacherRole->attachPermissions([
            $createTeacherPermission,
            $viewTeacherPermission,
            $updateTeacherPermission,
            $deleteTeacherPermission,
            $createParentPermission,
            $viewParentPermission,
            $updateParentPermission,
            $deleteParentPermission,
        ]);

        $teacherRole->attachPermissions([
            $createParentPermission,
            $viewParentPermission,
            $updateParentPermission,
            $deleteParentPermission,
        ]);
    }
}
