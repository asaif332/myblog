<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Category;
use App\Post;
use App\Tag;
use Newsletter;

class FrontEndController extends Controller
{
    public function index()
    {
        $settings = Setting :: first();

        return view('index', [
            'title' => $settings->site_name,
            'settings' => $settings,  
            'menu_items' => Category :: take(4)->get(),
            'categories' => Category :: all(),
            'post_one' => Post :: orderBy('created_at' , 'desc')->first(),
            'post_two' => Post :: orderBy('created_at' , 'desc')->skip(1)->first(),
            'post_three' => Post :: orderBy('created_at' , 'desc')->skip(2)->first()
        ]);
    }

    public function postSingle($slug)
    {
        $post = Post :: where('slug' , $slug)->first();
        $next_id = Post :: where('id' , '>' , $post->id)->min('id');
        $prev_id = Post :: where('id' , '<' , $post->id)->max('id');
        $settings = Setting :: first();
        

        return view('single' , [
            'title' => $post->title,
            'settings' => $settings,   // for footer 
            'menu_items' => Category :: take(4)->get(),
            'categories' => Category :: all(),
            'tags' => Tag :: all(),
            'post' => $post,
            'next' => Post :: find($next_id),
            'prev' => Post :: find($prev_id),
        ]);
    }

    public function categorySingle($id)
    {
        $settings = Setting :: first();
        $category = Category :: find($id);
        return view('category' , [
            'title' => $category->name,
            'settings' => $settings,   // for footer 
            'category' => $category,
            'menu_items' => Category :: take(4)->get(), 
            'tags' => Tag :: all(),
        ]);
    }

    public function tagSingle($id)
    {
        $tag = Tag :: find($id);

        return view('tag' , [
            'title' => $tag->tag,
            'settings' => Setting :: first(),   // for footer,
            'menu_items' => Category :: take(4)->get(), 
            'tag' => $tag,
            'tags' => Tag :: all(),
        ]);
    }

    public function result()
    {
        $posts = Post :: where('title' , 'like' , '%' . request('query') . '%')->get();

        return view('result' , [
            'title' => 'search for :' . request('query'),
            'settings' => Setting :: first(),   // for footer,
            'menu_items' => Category :: take(4)->get(), 
            'tags' => Tag :: all(),
            'query' => request('query'),
            'posts' => $posts,
        ]);
    }

    public function subscribe()
    {
        if (Newsletter :: subscribe(request('email'))) {
            return redirect()->back()->with('success' , 'Thank you for subscription !!');
        }
        return redirect()->back()->with('error' , 'Something went wrong');
        
    }

}
