<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        return view('admin.settings.index')->with('settings' , Setting :: first());
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required',
            'address' => 'required',
            'contact_number' => 'bail|required|string|size:10|not_regex:/[a-z][A-Z]*/',
            'contact_email' => 'required|email'
        ]);

        $settings  = Setting :: first()->update([
            'site_name' => $request->site_name,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'contact_email' => $request->contact_email
        ]);

        if ($settings) {
            return redirect()->back()->with('success' , 'Site setting updated');
        }
        return redirect()->back();
    }

  
}
