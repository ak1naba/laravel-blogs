<?php

namespace App\Http\Controllers;

use App\DTOs\UserCreateDTO;
use App\DTOs\UserUpdateDTO;
use App\Http\Requests\User\CreateUserRequest;
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

    public function create(CreateUserRequest $request)
    {
        $userData = new UserCreateDTO($request->all());
        $user = User::create($userData->toArray());

        return response()->json(['message' => 'User created', 'user' => new UserResource($user)], 201);
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        $userData = new UserUpdateDTO($request->all());
        $user->update($userData->toArray());

        $user->save();
        return response()->json(['message'=>'Данные пользователя обновлены','user'=>new UserResource($user)], 200);
    }

    public function destroy(User $user)
    {
        $user->tokens()->delete();
        $user->delete();

        return response()->json(['message'=>'Пользователь удален'], 204);
    }
}
