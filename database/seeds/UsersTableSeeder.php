<?php

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
        $user = App\User :: create([
            'name' => 'saif ali',
            'email' => 'asaif332@gmail.com',
            'password' => bcrypt('asaif332'),
            'admin' => 1
        ]);

        App\Profile :: create([
            'user_id' => $user->id,
            'avatar' => 'uploads/avatars/User.png',
            'about' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique mollitia numquam fugit ipsa, impedit excepturi asperiores necessitatibus nesciunt hic doloremque nemo, deleniti iure rem facere amet quos! Quam, dolore alias.',
            'facebook' => 'facebook.com',
            'youtube' => 'youtube.com'
        ]);
    }
}
