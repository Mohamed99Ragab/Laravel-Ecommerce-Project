<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\HttpResponse;
use App\Mail\userRestPasswordEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Testing\Fluent\Concerns\Has;

class RestPassword extends Controller
{

    use HttpResponse;

    public function forgetPassword(Request $request){



        $rules = [
            'email' => 'required|email|exists:users,email',
        ];

        $messages = [
            'email.required' => 'must enter email of your account',
            'email.email'=>'this field must type email',
            'email.exists'=>'this email not exist'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails())
        {
            return $this->responseJson(null,$validator->errors()->first(),false);
        }





        $pass_rests = DB::table('password_resets')->where('email',$request->email)->first();

        if (isset($pass_rests)&&!empty($pass_rests))
        {

            DB::table('password_resets')->where('email',$pass_rests->email)->delete();

        }

        $code = random_int(100000, 999999);

        DB::table('password_resets')->insert([
            'email'=>$request->email,
            'token'=>$code
        ]);

        $user = User::where('email',$request->email)->first();


        Mail::to($request->email)->send(new userRestPasswordEmail($code,$user->first_name));

        return $this->responseJson(null,'we send code please check your email',true);


    }


    public function restPassword(Request $request)
    {


        $rules = [
            'code' => 'required|exists:password_resets,token',
            'password'=>'required|confirmed'
        ];

        $messages = [
            'code.required' => 'must enter code send on email to rest your password',
            'code.exists'=>'this code is invaild',
            'password.required'=>'must enter new password',
            'password.confirmed'=>'password confirm should equal password field'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails())
        {
            return $this->responseJson(null,$validator->errors()->first(),false);
        }





        $rest_pass = DB::table('password_resets')->where('token',$request->code)->first();

        if(isset($rest_pass))
        {
           $user = User::where('email',$rest_pass->email)->first();
           $user->update([
               'password'=>Hash::make($request->password)
           ]);

           DB::table('password_resets')->where('token',$rest_pass->token)->delete();


            return $this->responseJson(null,'Password Updated success',true);


        }
        return $this->responseJson(null,'this code is invaild',false);

    }
}
