<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'key' => 'app-name', 
                'value' => 'Webcore', 
                'description' => 'Your application name',
                'type' => 'app', 
                'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'key' => 'site-title', 
                'value' => 'Webcore Platform', 
                'description' => 'Your site title',
                'type' => 'app', 
                'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'key' => 'site-slogan', 
                'value' => 'Built according to your needs', 
                'description' => 'Your site slogan',
                'type' => 'app', 
                'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'key' => 'site-description', 
                'value' => 'Single Platform can be used for Admin Panel or Web CMS (built according to your needs)', 
                'description' => 'Your site description',
                'type' => 'app', 
                'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'key' => 'site-logo', 
                'value' => 'https://dummyimage.com/600x100/f5f5f5/999999&text=Webcore', 
                'description' => 'Your site logo. Note : upload your logo using assets manager, and copy your uploded logo link to Value field in here',
                'type' => 'app', 
                'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'key' => 'google-analytics', 
                'value' => 'google_analytics_code', 
                'description' => 'Your google analytics key',
                'type' => 'app', 
                'created_at' => date('Y-m-d H:i:s'), 
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
