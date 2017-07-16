<?php

use Illuminate\Database\Seeder;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = [
            [
                'name' => 'Grade 1',
                'slug' => 'grad-1'
            ],[
                'name' => 'Grade 2',
                'slug' => 'grad-2'
            ],[
                'name' => 'Grade 3',
                'slug' => 'grad-3'
            ],[
                'name' => 'Grade 4',
                'slug' => 'grad-4'
            ],[
                'name' => 'Grade 5',
                'slug' => 'grad-5'
            ],[
                'name' => 'Grade 6',
                'slug' => 'grad-6'
            ],[
                'name' => 'Grade 7',
                'slug' => 'grad-7'
            ],[
                'name' => 'Grade 8',
                'slug' => 'grad-8'
            ],[
                'name' => 'Grade 9',
                'slug' => 'grad-9'
            ],[
                'name' => 'Grade 10',
                'slug' => 'grad-10'
            ]
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('grades')->truncate();
        DB::table('grades')->insert($grades);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
