<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Models\PostsLikes;
use App\User;
use Illuminate\Support\Facades\Hash;

class PagesController extends Controller
{
    public function home(){
    
        // $faker = Faker\Factory::create(); 
        // $user = new User();
        // $post = new Post();
        // $users = [];

        // for($i = 0; $i < 20; $i++){
        //     $user->name = $faker->name;
        //     $user->email = $faker->email;
        //     $user->password = Hash::make('password');
        //     $user->role = 0;

        //     $user->save();
        //     $users[] = $user;
        // }


        // for($i = 0; $i < 20; $i++){
        //     $post->title = $faker->sentence(6);
        //     $post->introduce = $faker->paragraph();
        //     $post->body = implode(' , ',$faker->paragraphs(10));
        //     $post->slug = Str::slug($post->title);
        //     $post->user_id = 1;
        //     $post->save();
        //     for($j = 0; $j < mt_rand(0, 10); $j++){
        //         $like = new PostsLikes();
        //         $like->post_id = $post->id;
        //         $like->user_id = ($faker->randomElement($users))->id;

        //         $like->save();
        //     }
        // }
        // // // dd(implode(' , ',$faker->paragraphs(10)));
    
        return view('pages.home');
    }

    public function about(){
        return view('pages.about');
    }

}
