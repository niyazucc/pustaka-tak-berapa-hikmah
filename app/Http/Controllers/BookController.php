<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;

use App\Models\Discount;
use Illuminate\Http\Request;
use Symfony\Component\Clock\now;
use App\Traits\NotificationTrait;
use App\Http\Controllers\Controller;
use App\Models\BookDiscount;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Laravel\Jetstream\InteractsWithBanner;

class BookController extends Controller
{
    use InteractsWithBanner;
    use NotificationTrait;

    public $currentCategories;
    public function index()
    {
        // Retrieve books with active discounts
        $ondiscounts = Book::with([
            'discounts' => function ($q) {
                $q->latestDiscount();
            }
        ])->whereHas('discounts', function ($q) {
            $q->where('start_datetime', '<=', now())
                ->where('end_datetime', '>=', now());
        })->get();
        // Get all books, regardless of whether they have active discounts

        // Retrieve latest books, including their discounts
        $latest = Book::where('isnew', true)
            ->with([
                'discounts' => function ($q) {
                    $q->latestDiscount()
                        ->where('start_datetime', '<=', now())
                        ->where('end_datetime', '>=', now());
                }
            ])->get();

        // Retrieve popular books, including their discounts
        $popular = Book::where('popularity', '>', 5)
            ->with([
                'discounts' => function ($q) {
                    $q->latestDiscount()
                        ->where('start_datetime', '<=', now())
                        ->where('end_datetime', '>=', now());
                }
            ])->get();

        // Retrieve all categories with book counts
        $categories = Category::withCount('books')->get();

        return view('welcome', compact('popular', 'ondiscounts', 'latest', 'categories'));
    }

    public function showByType($type)
    {
        switch ($type) {
            case 'promosi':
                // Retrieve books with active discounts
                $books = Book::with([
                    'discounts' => function ($q) {
                        $q->latestDiscount()
                            ->where('start_datetime', '<=', now())
                            ->where('end_datetime', '>=', now());
                    }
                ])->get();
                break;

            case 'keluaran-terbaru':
                // Retrieve latest books with active discounts
                $books = Book::where('isnew', true)
                    ->with([
                        'discounts' => function ($q) {
                            $q->latestDiscount()
                                ->where('start_datetime', '<=', now())
                                ->where('end_datetime', '>=', now());
                        }
                    ])->get();
                break;

            case 'buku-terlaris':
                // Retrieve popular books with active discounts
                $books = Book::where('popularity', '>', 5)
                    ->with([
                        'discounts' => function ($q) {
                            $q->latestDiscount()
                                ->where('start_datetime', '<=', now())
                                ->where('end_datetime', '>=', now());
                        }
                    ])->get();
                break;

            case 'dokumen-terbitan':
                // Retrieve documents without discount filtering
                $books = Book::where('is_document', true)->get();
                break;

            default:
                // Retrieve all books without discount filtering
                $books = Book::all();
                break;
        }

        $count = $books->count(); // Get the count of the books
        $categories = Category::withCount('books')->get();

        return view('categorized-book', compact('books', 'type', 'count', 'categories'));
    }


    public function listallbooks()
    {
        // $books = Book::all();
        // return view("admin.book-list", compact("books"));
        return view("admin.book-list");
    }
    public function viewBookDetails($id)
    {
        $book = Book::with([
            'categories',
            'discounts' => function ($q) {
                $q->latestDiscount()->where('start_datetime', '<=', now())
                    ->where('end_datetime', '>=', now());;
            }
        ])->findOrFail($id);
        $currentCategories = $book->categories;
        $categories = Category::withCount('books')->get();
        return view("book-details", compact("book", "currentCategories", 'categories'));
    }

    public function create()
    {
        $book = new Book();
        $categories = Category::all();
        $currentCategories = collect();
        return view("admin.createbook", compact('book', 'categories', 'currentCategories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'page' => 'required|integer|min:1',
            'chapter' => 'required|string|max:255',
            'isbn' => 'required|string',  // assuming ISBN has to be 13 characters
            'stockcount' => 'required|integer|min:0',
            'publishyear' => 'required|integer|digits:4|min:1900',  // valid year range
            'language' => 'required|in:Bahasa Melayu,Bahasa Inggeris,DwiBahasa',
            'bookimage1' => 'required|image|mimes:jpeg,png,jpg,gif',
            'bookimage2' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'bookimage3' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'synopsis' => 'nullable|string',
            'isnew' => 'nullable|boolean',  // checkbox validation
            'category' => 'required|array',  // Ensure that category is an array
            'category.*' => 'integer|exists:categories,id',  // Validate each category exists in the categories table

        ]);
        //set default value for popularity
        $validatedData['popularity'] = 0;

        if ($request->hasFile('bookimage1')) {
            // Store bookimage1 in 'public/images' and get the file name
            $validatedData['bookimage1'] = $request->file('bookimage1')->store('images', 'public');
        }

        if ($request->hasFile('bookimage2')) {
            // Store bookimage2 if uploaded
            $validatedData['bookimage2'] = $request->file('bookimage2')->store('images', 'public');
        }

        if ($request->hasFile('bookimage3')) {
            // Store bookimage3 if uploaded
            $validatedData['bookimage3'] = $request->file('bookimage3')->store('images', 'public');
        }
        $book = Book::create($validatedData);
        $book->categories()->sync($request->category);

        $this->popupNotification('Book added successfully!');
        return Redirect::route('admin.listbook');
    }

    public function edit($id)
    {
        // $book = Book::findOrFail($id); // Find the book by ID or fail
        $categories = Category::all(); //utk select
        // $currentCategories = Book::with('categories')->find($id);

        $book = Book::findOrFail($id); // Get a book with id 1
        $currentCategories = $book->categories; // Get all categories associated with the boo
        // print_r($categories);
        // die();
        // dd($currentCategories);
        return view('admin.createbook', compact('book', 'categories', 'currentCategories')); // Pass the book data to the view
    }

    public function update(Request $request): RedirectResponse
    {
        // Find the book by ID
        $id = $request->id;
        $book = Book::findOrFail($id);

        // Validate the incoming request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'page' => 'required|integer|min:1',
            'chapter' => 'required|string|max:255',
            'isbn' => 'required|string',  // assuming ISBN has to be 13 characters
            'stockcount' => 'required|integer|min:0',
            'publishyear' => 'required|integer|digits:4|min:1900',
            'language' => 'required|in:Bahasa Melayu,Bahasa Inggeris,DwiBahasa',
            'bookimage1' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'bookimage2' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'bookimage3' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'synopsis' => 'nullable|string',
            'isnew' => 'nullable|boolean',
            'category' => 'required|array',  // Validate categories as an array
            'category.*' => 'integer|exists:categories,id',  // Validate each category exists
        ]);

        // Handle the bookimage1 update
        if ($request->hasFile('bookimage1')) {
            // Delete the old image from storage
            if ($book->bookimage1) {
                Storage::disk('public')->delete($book->bookimage1);
            }
            // Store the new image
            $validatedData['bookimage1'] = $request->file('bookimage1')->store('images', 'public');
        } else {
            // Keep the old image if no new one is uploaded
            $validatedData['bookimage1'] = $book->bookimage1;
        }

        // Handle the bookimage2 update
        if ($request->hasFile('bookimage2')) {
            if ($book->bookimage2) {
                Storage::disk('public')->delete($book->bookimage2);
            }
            $validatedData['bookimage2'] = $request->file('bookimage2')->store('images', 'public');
        } else {
            $validatedData['bookimage2'] = $book->bookimage2;
        }

        // Handle the bookimage3 update
        if ($request->hasFile('bookimage3')) {
            if ($book->bookimage3) {
                Storage::disk('public')->delete($book->bookimage3);
            }
            $validatedData['bookimage3'] = $request->file('bookimage3')->store('images', 'public');
        } else {
            $validatedData['bookimage3'] = $book->bookimage3;
        }

        // Update the book record with validated data
        $book->update($validatedData);
        $book->categories()->sync($request->category);
        // Redirect to the book listing with a success message
        $this->popupNotification('Book updated successfully!');

        return Redirect::route('admin.edit', ['book' => $book->id]);
    }
}
