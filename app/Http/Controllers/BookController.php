<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
   
    public function index()
{
    $books = Book::with('author')->get();

    return response()->json($books->map(function ($book) {
        return [
            'id' => $book->id,
            'title' => $book->title,
            'author' => $book->author->name
        ];
    }));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateBookRequest $request){
        $book = Book::create($request->all());

        return response()->json([
            'message'=>'Book create successfully',
            'data'=> $book
        ],201);


    }


   public function show($id)
{
    $book = Book::with('author')->findOrFail($id);

    return response()->json([
        'id' => $book->id,
        'title' => $book->title,
        'description' => $book->description,
        'published_year' => $book->published_year,
        'author' => $book->author->name,
    ]);
}

    public function update(UpdateBookRequest $request, $id)
    {
       $book = Book::where('id',$id)->update([
        'title'=>$request->title,
            'author'=>$request-> author,
            'published_year'=>$request->published_year
       ]);
       if($book){
           return response()->json([
                'message'=> 'book updated successfully',
                'data'=>$book
            ],201);
       }
            return response()->json(['message' => 'Book not found'], 404);
        }
   
    

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $book = Book::where('id',$id)->delete();
        if($book){
            return response()->json([
                'message'=>'delete book success',
                'data' => $book
            ],200);
        }
        

        // If book not found
        return response()->json([
            'message' => 'Book not found, cannot delete'
        ], 404);
    }
}
