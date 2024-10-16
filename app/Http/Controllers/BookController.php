<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'name');
        $sortOrder = $request->get('sort_order', 'asc');
        $searchQuery = $request->get('search') ?? '';

        $validSortBy = ['name', 'author'];

        if (!in_array($sortBy, $validSortBy)) {
            $sortBy = 'name';
        }

        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'asc';
        }

        $books = Book::where(function ($query) use ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%')
                ->orWhere('author', 'like', '%' . $searchQuery . '%');
        })
            ->orderBy($sortBy, $sortOrder)
            ->paginate();
        return view('books.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $name = $request->input('name') ?? '';
        $author = $request->input('author') ?? '';
        $image = $request->input('image');
        $path = '';

        $message = [
            'type' => 'success',
            'message' => 'Song successfully added',
        ];

        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $exists = Book::where(['name' => $name, 'author' => $author])
            ->exists();

        if ($exists) {
            $message = [
                'type' => 'danger',
                'message' => 'Book already exists',
            ];

            return redirect()->route('books.index')->with('message', $message);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('images', $imageName);
        }

        $book = Book::create([
            'name' => $name,
            'author' => $author,
            'image' => $path,
        ]);

        return redirect()->route('books.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $book = Book::find($id);
        abort_if(empty($book), 404);
        return view('books.edit')->with('book', $book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $name = $request->get('name') ?? '';
        $author = $request->get('author') ?? '';
        $image = $request->get('image');
        $path = '';

        $message = [
            'type' => 'success',
            'message' => 'Book successfully updated',
        ];

        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $book = Book::find($id);
        $exists = Book::where([
            'name' => $name,
            'author' => $author
        ])
            ->where('id', '!=', $id)
            ->exists();

        abort_if(empty($book), 404);

        if ($exists) {
            $message = [
                'type' => 'danger',
                'message' => 'Song already exists',
            ];

            return redirect()->route('books.index')->with('message', $message);
        }

        $book->update([
            'name' => $name,
            'author' => $author,
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('images', $imageName);

            $book->update([
                'image' => $path,
            ]);
        }

        return redirect()->route('books.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $book = Book::find($id);
        $message = [
            'type' => 'success',
            'message' => 'Book successfully deleted',
        ];
        abort_if(empty($book), 404);
        $book->delete();
        return redirect()->route('books.index')
            ->with('message', $message);
    }

    public static function getImageUrl($fileName = null)
    {
        if (empty($fileName)) {
            return 'https://placehold.co/256';
        }
        return Storage::url($fileName);
    }
}
