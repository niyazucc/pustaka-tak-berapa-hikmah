<?php

namespace App\Livewire;
use App\Models\Book;
use Livewire\Component;

class DeleteBook extends Component
{
    public $id;

    public function deleteBook()
    {
        $book = Book::find(id: $this->id);

        if ($book) {
            $book->delete();
            session()->flash('success', 'Book deleted successfully!');
        } else {
            session()->flash('error', 'Book not found!');
        }

        // Optionally, you can trigger a redirect or refresh after deletion.
        return redirect()->route('admin.listbook'); // Redirect back to the list
    }
    public function render()
    {
        return view('livewire.delete-book');
    }
}
