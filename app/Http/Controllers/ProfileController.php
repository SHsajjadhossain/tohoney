<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Image;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('profile');
    }

    public function namechange(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        User::find(auth::id())->update([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Your Name Changed Successfully!!');
    }

    public function passwordchange(Request $request)
    {
        $request->validate([
            '*' => 'required',
            'password' => 'required|min:8',
        ]);

        if (Hash::check($request->old_password, Auth::user()->password)) {
            if ($request->password == $request->confirm_password) {
                User::find(auth::id())->update([
                    'password' => bcrypt($request->password),
                ]);
                return back()->with('success_pass', 'Your Password Changed Successfully!!');
            }
            else {
                return back()->withErrors("Confirm Password Does not Match!!");
            }
        }
        else {
            return back()->withErrors("Old Password Does not Match!!");
        }
    }

    public function photochange(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image',
        ]);
        if (Auth::user()->profile_photo != 'default.jpg') {
            // return time();
            unlink(base_path('public/uploads/profile_photoes/'. Auth::user()->profile_photo));
        }
        $new_profile_photo = time() . '_' . uniqid() . Auth::id() . '.' . $request->file('profile_photo')->getClientOriginalExtension();
        $img = Image::make($request->file('profile_photo'));
        $img->save(base_path('public/uploads/profile_photoes/' . $new_profile_photo));
        User::find(Auth::id())->update([
            'profile_photo' => $new_profile_photo,
        ]);
        return back()->with('success_photo', 'Your Photo Changed Successfully!!');
    }
}
