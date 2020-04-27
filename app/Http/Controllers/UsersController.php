<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::with('role')->paginate(15);

        return response()->json($users, 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
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
