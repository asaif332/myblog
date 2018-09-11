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
        App\Setting :: create([
            'site_name' => 'My laravel blog',
            'address' => 'Rudrapur, Uttrakhand',
            'contact_number' => '7744774474',
            'contact_email' => 'blog.asaif332@gmail.com'
        ]);
    }
}
