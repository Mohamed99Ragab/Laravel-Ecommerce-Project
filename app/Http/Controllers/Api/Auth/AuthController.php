<?php
namespace App\Http\Controllers\Api\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Traits\HttpResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    use HttpResponse;
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request){


        if (! $token = auth()->attempt(['email'=>$request->email,'password'=>$request->password])) {

            return $this->responseJson( null,'login credentials not correct',false);
        }
        return $this->createNewToken($token,'login success');
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request) {


      $user = User::create([
          'first_name'=>$request->first_name,
          'last_name'=>$request->last_name,
          'email'=>$request->email,
          'password'=>Hash::make($request->password),
      ]);

        if(isset($user)){
            if (! $token = auth()->attempt(['email'=>$request->email,'password'=>$request->password])) {

                return $this->responseJson( null,'try again login falied',false);
            }
            return $this->createNewToken($token,'Account created successfully');

        }


//      return $this->responseJson(null,"Account created successfully",true);




    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {

        if(!empty(Auth::guard('api')->user())){
            auth()->logout();
            return $this->responseJson(null,"logout success",true);
        }
        return $this->responseJson(null,"should login first",false);


    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->user());
    }

    protected function createNewToken($token,$message){

        return $this->responseJson([
            'token' =>  $token,
            'token_type' => 'bearer',
            'user' => auth()->user()],$message,true);

    }
}
