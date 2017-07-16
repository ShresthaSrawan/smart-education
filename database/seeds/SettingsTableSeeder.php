<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'slug'  => 'title',
                'value' => 'Smart Education'
            ],
            [
                'slug'  => 'description',
                'value' => 'Lorem ipsum is a pseudo-Latin text used in web design, typography, layout, and printing in place of English to emphasise design elements over content.'
            ],
            [
                'slug'  => 'address',
                'value' => 'Lalitpur, Nepal',
            ],
            [
                'slug'  => 'phone',
                'value' => '01-xxxxxxx',
            ],
            [
                'slug'  => 'email',
                'value' => 'info@smarteducation.com'
            ],
            [
                'slug'  => 'postbox',
                'value' => 'PO Box 44700'
            ],
            [
                'slug'  => 'facebook',
                'value' => 'https://www.facebook.com'
            ],
            [
                'slug'  => 'twitter',
                'value' => 'https://www.twitter.com'
            ],
            [
                'slug'  => 'google_plus',
                'value' => 'https://www.google.com'
            ],
            [
                'slug'  => 'logo',
                'value' => '/img/logo.png'
            ],
            [
                'slug'  => 'notification-emails',
                'value' => 'admin@smarteducation.com'
            ],
            [
                'slug'  => 'placeholder',
                'value' => '/img/placeholder.jpg'
            ]
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('settings')->truncate();
        DB::table('settings')->insert($settings);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
