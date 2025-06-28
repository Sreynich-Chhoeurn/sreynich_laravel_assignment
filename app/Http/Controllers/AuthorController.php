<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;

class AuthorController extends Controller
{
    // 1. List all authors
    public function index()
    {
        $authors = Author::all();
        return response()->json([
            'message' => 'All authors retrieved',
            'data' => $authors
        ], 200);
    }

    // Create new author (POST /authors/create)
    public function create(StoreAuthorRequest $request)
    {
        $author = Author::create($request->validated());

        return response()->json([
            'message' => 'Author created successfully',
            'data' => $author
        ], 201);
    }

    // Show single author by id
    // public function show($id)
    // {
    //     $author = Author::find($id);

    //     if (!$author) {
    //         return response()->json(['message' => 'Author not found'], 404);
    //     }

    //     return response()->json([
    //         'message' => 'Author found',
    //         'data' => $author
    //     ], 200);
    // }

    public function show($id)
    {
        // Load the author and their books
        $author = Author::with('books')->findOrFail($id);

        return response()->json([
            'id' => $author->id,
            'name' => $author->name,
            'bio' => $author->bio,
            'nationality' => $author->nationality,
            'books' => $author->books->pluck('title'), // ✅ get book titles
        ]);
    }

    // Update author (PUT /authors/edit/{id})
    public function edit(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|min:2|max:255',
            'bio' => 'nullable|string|max:1000',
            'nationality' => 'sometimes|required|string|max:255',
        ]);

        $author = Author::find($id);

        if (!$author) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        $author->update($request->all());

        return response()->json([
            'message' => 'Author updated successfully',
            'data' => $author
        ], 200);
    }

    // Delete author (DELETE /authors/delete/{id})
    public function delete($id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        $author->delete();

        return response()->json([
            'message' => "Author with ID $id deleted successfully"
        ], 200);
    }
}
