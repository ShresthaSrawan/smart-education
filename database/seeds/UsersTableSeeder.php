<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        (factory(User::class)->create())->attachRole(User::ADMIN);
        (factory(User::class)->create())->attachRole(User::TEACHER);
        (factory(User::class)->create())->attachRole(User::PARENT);
    }
}
