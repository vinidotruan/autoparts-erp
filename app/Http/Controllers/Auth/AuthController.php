<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Notifications\SignupActivate;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'user' => 'required|string',
            'password' => 'required|string',
            'cpf' => 'required|integer',
            'email' => 'required|string|email',
        ]);

        $user = User::create([
            'name' => $request->name,
            'user' => $request->user,
            'password' => bcrypt($request->password),
            'cpf' => $request->cpf,
            'email' => $request->email,
            'activation_token' => Str::random(40)
        ]);

        $user->notify(new SignupActivate($user));

        return response()->json(["message" => "User created!"], 201);
    }

    public function signupActivate($token)
    {
        $user = User::where('activation_token', $token)->first();

        if( !$user ) {
            return response()->json([
                'message' => "Token de ativação inválido"
            ], 404);
        }

        $user->active = true;
        $user->activation_token = '';
        $user->save();

        return $user;
    }

    public function login(Request $request)
    {
        $request->validate([
            'user' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean',
        ]);

        $credentials = request(['user', 'password']);
        $credentials['active'] = 1;
        $credentials['deleted_at'] = null;
    
        if(!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'id' => $user->id,
            'role_id' => $user->role_id,
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

}
