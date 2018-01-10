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
            ['key' => 'site_title', 'value' => 'Site Title', 'description' => 'Your site title', 'created_at' => date('Y-m-d H:i:s')],
            ['key' => 'site_slogan', 'value' => 'Site Slogan', 'description' => 'Your site slogan', 'created_at' => date('Y-m-d H:i:s')],
            ['key' => 'site_description', 'value' => 'Site Description', 'description' => 'Your site description', 'created_at' => date('Y-m-d H:i:s')],
            ['key' => 'site_logo', 'value' => 'images/logo/logo.png', 'description' => 'Your site logo. Note : upload your logo using assets manager, and copy your uploded logo link to Value field in here', 'created_at' => date('Y-m-d H:i:s')],
            ['key' => 'google_analytics', 'value' => 'google_analytics_code', 'description' => 'Your google analytics key', 'created_at' => date('Y-m-d H:i:s')]
        ]);
    }
}
