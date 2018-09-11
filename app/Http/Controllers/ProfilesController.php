<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.profile' , ['user' => Auth :: user()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth:: user()->id,
            'facebook' => 'nullable|url',
            'youtube' => 'nullable|url',
        ]);

        if (!empty($request->password)) {
            $request->validate([
                'password' => 'bail|required|min:6|confirmed'
            ]);
        }

        $user = Auth::user();

        if ($request->hasFile('avatar')) {

            $avatar = $request->file('avatar');
            
            if (array_last(explode('/' , $user->profile->avatar)) != "User.png") {
                $delete_image = 'uploads\avatars\\'.array_last(explode('/' , $user->profile->avatar));
                @unlink(public_path($delete_image));                
            }

            
            $new_name = time() . $avatar->getClientOriginalName();
        
            $avatar->move('uploads/avatars' , $new_name);
            $user->profile->avatar = 'uploads/avatars/'.$new_name;

        }
        
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->profile->facebook = $request->facebook;
        $user->profile->youtube = $request->youtube;
        $user->profile->about = $request->about;

        if ($user->save()) {
            $user->profile->save();
            return redirect()->back()->with('success' , 'Profile updated');
        }
        
        return redirect()->back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
}
