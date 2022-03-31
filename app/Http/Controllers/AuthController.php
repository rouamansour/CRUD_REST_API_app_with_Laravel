<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
class AuthController extends Controller
{
    //
    /**
* Create a new AuthController instance.
*
* @return void
*/
public function __construct() {
    $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
    * Get a JWT via given credentials.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function login(Request $request){
    $input = $request->only('email', 'password');
    $jwt_token = null;
    if (!$jwt_token = JWTAuth::attempt($input)) {
    return response()->json([
    'success' => false,
    'message' => 'Invalid Email or Password',
    ], Response::HTTP_UNAUTHORIZED);
    }
    return response()->json([
    'success' => true,
    'token' => $jwt_token,
    ]);
    }
    /**
    * Register a User.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function register(Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|between:2,100',
        'email' => 'required|string|email|max:100|unique:users',
        'password' => 'required|string|confirmed|min:6',
        ]);
        if($validator->fails()){
        return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
        $validator->validated(),
        ['password' => bcrypt($request->password)]
        ));
        return response()->json([
        'message' => 'User successfully registered',
        'user' => $user
        ], 201);
        }
        /**
        * Log the user out (Invalidate the token).
        *
        * @return \Illuminate\Http\JsonResponse
        */
        public function logout() {
        $this->guard()->logout();
        return response()->json([
        'status' => 'success',
        'msg' => 'Logged out Successfully.'
        ], 200);
        }
        /**
        * Return auth guard
        */
        private function guard()
        {
        return Auth::guard();
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
    /**
    * Get the token array structure.
    *
    * @param string $token
    *
    * @return \Illuminate\Http\JsonResponse
    */
    protected function createNewToken($token){
    return response()->json([
    'access_token' => $token,
    'token_type' => 'bearer',
    'expires_in' => auth('api')->factory()->getTTL() * 60,
    'user' => auth()->user()
    ]);
    }
}
