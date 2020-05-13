<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use App\Notifications\SignupActivate;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::with('role')->paginate(15);

        return response()->json($users, 200);
    }

    public function store(Request $request)
    {        
        $user = User::create([
            'name' => $request->name,
            'user' => $request->user,
            'password' => bcrypt($request->password),
            'cpf' => $request->cpf,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'activation_token' => Str::random(40)
        ]);

        $user->notify(new SignupActivate($user));


        return response()->json($request->all(), 200);
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $response = User::find($user->id)->load('role');
        return response()->json($response);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->update([
            'name' => $request->name,
            'user' => $request->user,
            'password' => bcrypt($request->password),
            'cpf' => $request->cpf,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ]);

        $user->save();

        return response()->json(["message"=>'sucess'], 200);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json(["message"=>'sucess'], 200);
    }

    public function notifications(User $user)
    {
        $notifications = $user->notifications()->paginate(15);

        return response()->json($notifications);
    }

    public function markAsRead(User $user)
    {
        $user->unreadNotifications->markAsRead(); 
        return response()->json(['message'=> 'read', 200]);
    }
}
