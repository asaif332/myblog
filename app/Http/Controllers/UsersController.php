<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;

class UsersController extends Controller
{


    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index' , ['users' => User :: all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'name' => 'required',
            'email' => 'required|email|unique:users'
        ]);

        $user = User :: create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt('password')
        ]);

        if ($user) {
            Profile :: create([
                'user_id' => $user->id,
                'avatar' => 'uploads/avatars/User.png'
            ]);

            return redirect()->route('users.index')->with('success' , 'User added successfully');
        }
        return redirect()->back()->withInput();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User :: find($id);
        
        if (array_last(explode('/' , $user->profile->avatar)) != "User.png") {
            $delete_image = 'uploads\avatars\\'.array_last(explode('/' , $user->profile->avatar));
            @unlink(public_path($delete_image));                
        }

        if ($user->profile->delete()) {
            $user->delete();
            return redirect()->route('users.index')->with('success' , 'User deleted successfully');
        }

        return redirect()->back();

        
        
    }

    public function admin($id)
    {
        $user = User :: find($id);

        $user->admin = 1;
        if ($user->save()) {
            return redirect()->back()->with('success' . 'Permissions changed');
        }
        return redirect()->back();
    }

    public function not_admin($id)
    {
        $user = User :: find($id);

        $user->admin = 0;
        if ($user->save()) {
            return redirect()->back()->with('success' . 'Permissions changed');
        }
        return redirect()->back();
    }
}
