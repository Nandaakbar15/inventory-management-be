<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function getUsers()
    {
        $user = User::all();

        return response()->json([
            'statusCode' => 200,
            'data' => $user
        ], 200);
    }

    public function detailUsers(User $user)
    {
        return response()->json([
            'statusCode' => 200,
            'data' => $user
        ], 200);
    }

    public function deleteUser(User $user)
    {
        $user->delete();

        return response()->json([
            'statusCode' => 201,
            'message' => 'Berhasil menghapus user'
        ], 201);
    }
}
