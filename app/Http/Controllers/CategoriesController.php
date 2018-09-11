<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index')->with('categories' , Category :: all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
        ]);

        $category = Category :: create([
            'name' => $request->input('name')
        ]);

        if ($category) {
            return redirect()->route('categories.index')->with('success','Category added successfully !!');
        }
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
        $category = Category :: find($id);
        return view('admin.categories.edit')->with('category' , $category);
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
        $request->validate([
            'name' => 'required|unique:categories,name,'.$id,
        ]);
        $categoryUpdate = Category :: where('id' , $id)->update([
            'name' => $request->input('name')
        ]);

        if ($categoryUpdate) {
            return redirect()->route('categories.index')->with('success','Category updated successfully !!');
        }
        
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category :: find($id);
        foreach($category->posts as $post)
        {
            $delete_image = 'uploads\posts\\'.array_last(explode('/' , $post->featured));
            @unlink(public_path($delete_image));

            $post->tags()->detach();
            $post->forceDelete();
        }

        if ($category->delete()) {
            return redirect()->route('categories.index')->with('success','Category deleted successfully !!');
        }
    }
}
