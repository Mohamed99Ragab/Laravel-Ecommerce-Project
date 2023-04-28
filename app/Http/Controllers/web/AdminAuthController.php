<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;


class AdminAuthController extends Controller
{


    public function loginview()
    {
        return view('auth.login');
    }


    public function login(Request $request){

        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){
            $admin = Admin::where('email',$request->email)->first();

            Auth::guard('admin')->login($admin);
            session()->flash('success','login success');

            return redirect()->route('home');

        }
        session()->flash('error','login credination not crorrect');

        return back();

    }

    public function logout(){

        Auth::guard('admin')->logout();

        return redirect('/');
    }



    public function profile(){

        $admin = Admin::find(Auth::guard('admin')->id());

        return view('auth.update-profile',compact('admin'));
    }




    public function updateProfile(Request $request)
    {

//        return $request;
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'photo'=>'image'
        ]);


        $admin = Admin::find(Auth::guard('admin')->id());

        $admin->update([
            'name'=>$request->name,
            'email'=>$request->email,

        ]);

        if($request->password){

            $admin->update([
                'password'=>Hash::make($request->password),

            ]);
        }
        if($request->file('photo')){

            //delete old photo from on server
            Storage::disk('public')->delete('admins/'.$admin->photo);
            // upload photo on server
            $request->file('photo')->store('admins','public');

            $admin->update([
                'photo'=>$request->file('photo')->hashName(),

            ]);

        }


        session()->flash('success','profile is updated success');

        return back();
    }



}
