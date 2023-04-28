<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\updateProfileRequest;
use App\Http\Traits\HttpResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class updateProfile extends Controller
{

    use HttpResponse;


    public function userData(){

        $user = User::find(Auth::guard('api')->id());

        return $this->responseJson($user,null,true);

    }


    public function updateProfile(updateProfileRequest $request)
    {


       $user = User::find(Auth::guard('api')->id());

       $user->update([
           'first_name'=>$request->first_name,
           'last_name'=>$request->last_name,
           'email'=>$request->email,
       ]);

       if($request->password){
           $user->update([
               'password'=>Hash::make($request->password),
           ]);
       }

        return $this->responseJson($user,'profile is updated',true);



    }
}
