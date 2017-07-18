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
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('role_user')->truncate();
        DB::table('permission_role')->truncate();

        $adminRole = Role::create([
            'name'         => 'admin',
            'display_name' => 'Administrator',
            'description'  => 'Manages everything'
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
         * Teacher CRUD Permission
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
         * Parent CRUD Permission
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
        /*
         * Post CRUD Permission
         */
        $createPostPermission = Permission::create([
            'name'         => 'create-post',
            'display_name' => 'Create Post',
            'description'  => 'Can create Post'
        ]);
        $viewPostPermission   = Permission::create([
            'name'         => 'view-post',
            'display_name' => 'View Post',
            'description'  => 'Can view Post'
        ]);
        $updatePostPermission = Permission::create([
            'name'         => 'update-post',
            'display_name' => 'Update Post',
            'description'  => 'Can update Post'
        ]);
        $deletePostPermission = Permission::create([
            'name'         => 'delete-post',
            'display_name' => 'Delete Post',
            'description'  => 'Can delete Post'
        ]);
        /*
         * Notice CRUD Permission
         */
        $createNoticePermission = Permission::create([
            'name'         => 'create-notice',
            'display_name' => 'Create Notice',
            'description'  => 'Can create Notice'
        ]);
        $viewNoticePermission   = Permission::create([
            'name'         => 'view-notice',
            'display_name' => 'View Notice',
            'description'  => 'Can view Notice'
        ]);
        $updateNoticePermission = Permission::create([
            'name'         => 'update-notice',
            'display_name' => 'Update Notice',
            'description'  => 'Can update Notice'
        ]);
        $deleteNoticePermission = Permission::create([
            'name'         => 'delete-notice',
            'display_name' => 'Delete Notice',
            'description'  => 'Can delete Notice'
        ]);
        /*
         * Grade CRUD Permission
         */
        $createGradePermission = Permission::create([
            'name'         => 'create-grade',
            'display_name' => 'Create Grade',
            'description'  => 'Can create Grade'
        ]);
        $viewGradePermission   = Permission::create([
            'name'         => 'view-grade',
            'display_name' => 'View Grade',
            'description'  => 'Can view Grade'
        ]);
        $updateGradePermission = Permission::create([
            'name'         => 'update-grade',
            'display_name' => 'Update Grade',
            'description'  => 'Can update Grade'
        ]);
        $deleteGradePermission = Permission::create([
            'name'         => 'delete-grade',
            'display_name' => 'Delete Grade',
            'description'  => 'Can delete Grade'
        ]);
        /*
         * Subject CRUD Permission
         */
        $createSubjectPermission = Permission::create([
            'name'         => 'create-subject',
            'display_name' => 'Create Subject',
            'description'  => 'Can create Subject'
        ]);
        $viewSubjectPermission   = Permission::create([
            'name'         => 'view-subject',
            'display_name' => 'View Subject',
            'description'  => 'Can view Subject'
        ]);
        $updateSubjectPermission = Permission::create([
            'name'         => 'update-subject',
            'display_name' => 'Update Subject',
            'description'  => 'Can update Subject'
        ]);
        $deleteSubjectPermission = Permission::create([
            'name'         => 'delete-subject',
            'display_name' => 'Delete Subject',
            'description'  => 'Can delete Subject'
        ]);


        $adminRole->attachPermissions([
            $createAdminPermission,
            $viewAdminPermission,
            $updateAdminPermission,
            $deleteAdminPermission,
            $createTeacherPermission,
            $viewTeacherPermission,
            $updateTeacherPermission,
            $deleteTeacherPermission,
            $createParentPermission,
            $viewParentPermission,
            $updateParentPermission,
            $deleteParentPermission,
            $createPostPermission,
            $viewPostPermission,
            $updatePostPermission,
            $deletePostPermission,
            $createNoticePermission,
            $viewNoticePermission,
            $updateNoticePermission,
            $deleteNoticePermission,
            $createGradePermission,
            $viewGradePermission,
            $updateGradePermission,
            $deleteGradePermission,
            $createSubjectPermission,
            $viewSubjectPermission,
            $updateSubjectPermission,
            $deleteSubjectPermission,
        ]);

        $teacherRole->attachPermissions([
            $createParentPermission,
            $viewParentPermission,
            $updateParentPermission,
            $deleteParentPermission,
            $createPostPermission,
            $viewPostPermission,
            $updatePostPermission,
            $deletePostPermission,
        ]);

        $parentRole->attachPermissions([
            $createPostPermission,
            $viewPostPermission,
            $updatePostPermission,
            $deletePostPermission,
        ]);
    }
}
