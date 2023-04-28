<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\HttpResponse;
use App\Mail\ContactUsMail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class contactController extends Controller
{

    use HttpResponse;

    public function  contactUs(Request $request) {


        $rules = [
            'name'=>'required',
            'email'=>'email|required',
            'message'=>'required'
        ];

        $messages = [
            'name.required' => 'must enter name',
            'email.required' => 'please enter your email',
            'email.email'=>'this field must type email',
            'message.required'=>'please write your message'
        ];

        $validator = Validator::make($request->all(),$rules,$messages);

        if($validator->fails())
        {
            return $this->responseJson(null,$validator->errors()->first(),false);
        }




        $admin = Admin::first();

            $mess =  $request->message;

        Mail::to($admin->email)->send(new ContactUsMail($request->name,$request->email,$request->phone,$request->subject,$mess));

        return $this->responseJson(null,'thanks will contact you',true);

    }
}
