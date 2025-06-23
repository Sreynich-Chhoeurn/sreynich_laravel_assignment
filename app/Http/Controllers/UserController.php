<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import your User model
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Requests\StoreUserRequest; // Import your custom request for validation

class UserController extends Controller
{
    // List all users
    public function index()
    {
        $users = User::all();
        return response()->json([
            'message' => 'All users retrieved',
            'data' => $users
        ], 200);
    }

    // Create a new user
public function create(StoreUserRequest $request)
{
    $user = User::create($request->validated());
    return response()->json([
        'message' => 'User created successfully',
        'data' => $user
    ], 201);
}



    // Show user by ID
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json([
            'message' => 'User found',
            'data' => $user
        ], 200);
    }

    // Update user by ID
    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|required|string|min:2|max:255',
            'email' => [
                'sometimes',
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'sometimes|nullable|string|min:6',
            'phone' => 'sometimes|nullable|string|min:6|max:15',
        ]);

        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('password') && $request->password !== null) {
            $user->password = Hash::make($request->password);
        }
        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }

        $user->save();

        return response()->json([
            'message' => 'User updated successfully',
            'data' => $user
        ], 200);
    }

    // Delete user by ID
    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json([
            'message' => "User with id $id deleted successfully"
        ], 200);
    }
}
