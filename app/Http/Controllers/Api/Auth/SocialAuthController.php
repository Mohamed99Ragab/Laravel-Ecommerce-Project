<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserAuth;
use App\Http\Traits\HttpResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    use HttpResponse;

    private $token;

    public function __construct()
    {


    }




    public function token(Request $request)
    {




        try {
            // authenticate the token against the provider
            $user = Socialite::driver($request->provider)->stateless()->userFromToken($request->oauth_token);


            return $user;

            // find or create an authenticated user
            if (!$authenticatedUser = User::where('provider_id', $user->id)->first()) {
                $authenticatedUser = User::create([
                    'email' => $user->email,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'password'=>null,
                    'provider' => $request->provider,
                    'provider_id' => $user->id,
                ]);
            }

            // login the user & get an access token for the API
            $this->token = Auth::guard('api')->login($authenticatedUser);




            // respond with the access token
            return $this->respondWithToken($this->token,$authenticatedUser);
        }
        catch (\Exception $e){

            return $this->responseJson(null,$e->getMessage(),false);

        }







    }


    public function respondWithToken($token,$user)
    {

        return $this->responseJson([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user'=>auth()->user()
        ],null,true);

    }
}
