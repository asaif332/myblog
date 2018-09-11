<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Storage;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.posts.index')->with('posts' , Post :: all()); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category :: all();
        if ($categories->count() == 0) {
            return redirect()->route('categories.create')->with('error' , 'You must atleast have one category to create a post');
        }
        return view('admin.posts.create' , ['categories' => Category :: all() , 'tags' => Tag :: all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            'title' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'tag' => 'required',
            'featured' => 'required|image',
        ]);

        // upload the image with new name
        $featured = $request->file('featured');
        $new_name = time() . $featured->getClientOriginalName();
        
        $featured->move('uploads/posts' , $new_name);

        $post = Post :: create([
            'title' => $request->input('title'),
            'category_id' => $request->input('category_id'),
            'content' => $request->input('content'),
            'featured' => 'uploads/posts/' . $new_name,
            'slug' => str_slug($request->title),
            'user_id' => Auth :: id(),
        ]);

        if ($post) {
            $post->tags()->attach($request->tag);
            return redirect()->back()->with('success' , 'Post added successfully');    
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.posts.edit' , [
            'post' => Post::find($id) , 'categories' => Category::all() , 'tags' => Tag :: all()
            ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $this->validate($request , [
            'title' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'tag' => 'required'
        ]);
        
        $post = Post :: find($id);

        if ($request->hasFile('featured')) {
            $delete_image = 'uploads\posts\\'.array_last(explode('/' , $post->featured));
            @unlink(public_path($delete_image));

            $featured = $request->file('featured');
            $new_name = time() . $featured->getClientOriginalName();
        
            $featured->move('uploads/posts' , $new_name);
            $post->featured = 'uploads/posts/'.$new_name;

        }

        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->content = $request->content;

        if ($post->save()) {
            $post->tags()->sync($request->tag);
            return redirect()->route('posts.index')->with('success' , 'Post updated successfully');
        }
        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post :: find($id);

        if ($post->delete()) {
            return redirect()->back()->with('success' , 'Post moved to trash');
        }
        return redirect()->back();
    }


    public function trash(){
        $posts = Post :: onlyTrashed()->get();

        return view('admin.posts.trash')->with('posts' , $posts);
    }


    public function kill($id)
    {
        $post = Post :: withTrashed()->where('id' , $id)->first();
        
        $delete_image = 'uploads\posts\\'.array_last(explode('/' , $post->featured));
        @unlink(public_path($delete_image));

        $post->tags()->detach();
    
        if ($post->forceDelete()) {
            return redirect()->back()->with('success' , 'Post permanently deleted');
        }

        return redirect()->back();
    }

    public function restore($id)
    {
        $post = Post :: withTrashed()->where('id' , $id)->first();
        if ($post->restore()) {
            return redirect()->route('posts.index')->with('success' , 'Post successfully restored');
        }
        return redirect()->back();
    }


}
