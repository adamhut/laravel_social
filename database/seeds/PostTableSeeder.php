<?php

use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::truncate();
        Post::truncate();

        $user1 = factory('App\User')->create([
        	'name' => 'adam',
        	'email' => 'ahuang@bacera.com',
        	'password' => bcrypt('test0000'),
        	'type' =>'admin',
        ]);
        factory('App\Post',15)->create([
        	'user_id'=>$user1->id,
        ]);

        factory('App\Post',50)->create();

    }
}
