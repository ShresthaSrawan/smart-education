<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Administrator',
                'slug'  => 'admin',
                'description' => 'Manages everything'
            ],[
                'name' => 'Teacher',
                'slug'  => 'teacher',
                'description' => 'Manages class, can be classteacher'
            ],[
                'name' => 'Parent',
                'slug'  => 'parent',
                'description' => 'Monitors his/her child activities'
            ],
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::table('roles')->insert($roles);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
