<?php

use Illuminate\Database\Seeder;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $grades = [
            [
                'name'             => 'Grade 1',
                'slug'             => 'grad-1',
                'class_teacher_id' => 2
            ]
        ];

        DB::table('grades')->truncate();
        DB::table('grades')->insert($grades);
    }
}
