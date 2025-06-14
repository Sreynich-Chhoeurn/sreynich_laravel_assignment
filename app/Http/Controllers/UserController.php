<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public $users = [
        ['id' => '1', 'name' => 'Alice Smith', 'email' => 'alice@example.com', 'phone' => '012345678'],
        ['id' => '2', 'name' => 'Bob Johnson', 'email' => 'bob@example.com', 'phone' => '098765432'],
        ['id' => '3', 'name' => 'Charlie Lee', 'email' => 'charlie@example.com', 'phone' => '011223344'],
    ];

    
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        //GET /api/users
        return response()->json([
            'message' => 'All users retrieved',
            'data' => $this->users
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    
    public function createUser(Request $request)
    {
        // POST /api/users
        return response()->json([
            "message" => "User created successfully",
            "data" => [
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone
            ]
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // GET /api/users/{id}
        foreach ($this->users as $user) {
            if ($user['id'] == $id) {
                return response()->json([
                    'message' => 'User found',
                    'data' => $user
                ], 200);
            }
        }

        return response()->json([
            'message' => 'User not found',
        ], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
  
    public function edit(Request $request, int $id)
    {
          // PUT /api/users/{id}
        return response()->json([
            "id" => $id,
            "data" => [
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone
            ]
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    // DELETE /api/users/{id}
    public function delete(int $id)
    {
        return response()->json([
            "message" => "User with id $id deleted successfully",
            "data" => [
                "id" => $id
            ]
        ], 200);
    }
}
