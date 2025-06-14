<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public $authors = [
        ['id' => '1', 'name' => 'Jane Austen', 'bio' => 'English novelist.', 'nationality' => 'British'],
        ['id' => '2', 'name' => 'Mark Twain', 'bio' => 'American writer.', 'nationality' => 'American'],
        ['id' => '3', 'name' => 'Nguyen Du', 'bio' => 'Vietnamese poet.', 'nationality' => 'Vietnamese'],
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // GET /api/authors
        return response()->json([
            'message' => 'All authors retrieved',
            'data' => $this->authors
        ], 200);
    }

    // GET: /api/authors/{id}
    public function find($id)
    {
        foreach ($this->authors as $author) {
            if ($author['id'] == $id) {
                return $author;
            }
        }
        return null;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createUsers(Request $request)
    {
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
        foreach ($this->authors as $author) {
            if ($author['id'] == $id) {
                return response()->json([
                    'message' => 'Author found',
                    'data' => $author
                ], 200);
            }
        }

    return response()->json([
        'message' => 'Author not found',
       
    ], 404);
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, int $id)
    {
        return response()->json([
            "id" => $id,
            "data" => [
                "name" => $request->name,
                "bio" => $request->bio,
                "nationality" => $request->nationality
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
    public function delete(int $id){
        return response()->json([
            "message" => "Author with id $id deleted successfully",
            "data" => [
                "id" => $id
            ]
        ], 200);
    }
}
