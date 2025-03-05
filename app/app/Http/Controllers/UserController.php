<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\Users\UserResource;
use App\Http\Resources\Users\UsersCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->paginate(10);

        return response()->json([
            'data' => new UsersCollection($users),
            'links' => [
                'prev' => $users->previousPageUrl(),
                'next' => $users->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $users->currentPage(),
                'from' => $users->firstItem(),
                'last_page' => $users->lastPage(),
                'per_page' => $users->perPage(),
                'to' => $users->lastItem(),
                'total' => $users->total(),
            ],
        ], 200);
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        if ($request->email){
            $user->email = $request->email;
        }
        if ($request->password){
            $user->password = Hash::make($request->password);
        }
        if ($request->role){
            $user->role = $request->role;
        }

        $user->save();
        return response()->json(['user'=>new UserResource($user)], 200);
    }

}
