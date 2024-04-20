<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }


/**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['username', 'password']);

        if (!auth()->attempt($credentials)) {
            return response()->json(['errors' => 'Invalid username and Password'], 401);
        }

        $token = auth('api')->claims(['roles' => auth('api')->user()->getUserPrivilege()])->attempt($credentials);

        return $this->respondWithToken($token);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|string|min:4',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }

        $user = User::create(array_merge(
            $validator->validate(),
            ['password' => bcrypt($request->password),]
        ));

        $role = Role::create([
            'privilege' => 'user',
            'ref_id' => 2001,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'message' => '¡Successfully registered user!',
            'user' => $user,
            'privilege' => $role->privilege,
        ], 201);
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
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}