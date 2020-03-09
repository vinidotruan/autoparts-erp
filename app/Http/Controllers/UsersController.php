<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json(["users" => $users], 200);
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
}
