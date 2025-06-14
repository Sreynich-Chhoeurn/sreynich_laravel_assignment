<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public $books = [
                        [
                    "id" => "1",
                    "title" => "1984",
                    "authorId" => "A1",
                    "isbn" => "9780451524935",
                    "publicationYear" => 1949,
                    "genre" => "Dystopian",
                    "availableCopies" => 5
                ],
                [
                    "id" => "2",
                    "title" => "To Kill a Mockingbird",
                    "authorId" => "A2",
                    "isbn" => "9780061120084",
                    "publicationYear" => 1960,
                    "genre" => "Fiction",
                    "availableCopies" => 3
                ]
    ];
    /**
     * Display a listing of the resource.
     */

    // GET /api/books - Get all books
    public function index()
    {

        return response()->json([
            'message' => 'List of books',
            'data' => $this->books
        ], 200);

    }

    // GET: /api/books/{id}
    public function find($id)
    {
        foreach ($this->books as $book) {
            if ($book['id'] == $id) {
                return $book;
            }
        }
        return null;
    }


    /**
     * Show the form for creating a new resource.
     */
    public function createBook(Request $request) {
        return response() -> json([
            "message" => "Successful",
            "data" => [
                'title' => $request->title,
                "author" => $request->author,
                "isbn" => $request->isbn,
                "publicationYear" => $request->publicationYear,
                "genre" => $request->genre,
                "availableCopies" => $request->availableCopies
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
    public function show($id)
    {
        $book = $this->find($id);
    
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
    
        return response()->json([
            'message' => 'Book found',
            'data' => $book
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, int $id){
        return response()-> json([
            "id" => $id,
            "data" => [
                "title" => $request->title,
                "author" => $request->author,
                "ibsn" => $request->isbn,
                "publicationYear" => $request->publicationYear,
                "genre" => $request->genre,
                "availableCopies" => $request->availableCopies
            ]
            ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
        public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
        public function delete(int $id){
        return response()->json([
            "message" => "Book with id $id deleted successfully",
            "data" => [
                "id" => $id
            ]
        ], 200);
    }
}
