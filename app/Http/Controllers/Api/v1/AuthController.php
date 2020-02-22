<?php

namespace App\Http\Controllers\Api\v1;

use App\Model\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if ($token = $this->guard()->attempt($credentials)) {//auth()->
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Incorrect email/password'], 401);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:155|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return response()->json(["error" => $validator->errors()], 400);
        }

        $user = User::create([
            'phone' => $request->get('phone'),
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);
        return $this->respondWithToken($token);
        //return response()->json(['data' => compact('user','token')],201);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['error' => 'user not found !'], 404);
        }

        $token = JWTAuth::fromUser($user);

        return response()->json(['data' => compact('user','token')]);
        //return response()->json($this->guard()->user()); eski hali.
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try{
            $this->guard()->logout();
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()]);
        }
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $jwt_expired_time = config('values.jwt_expired_time');
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $jwt_expired_time, //$this->guard()->factory()->getTTL()
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}
