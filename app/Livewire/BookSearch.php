<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;

class BookSearch extends Component
{
    public $search = ''; // This property will hold the search input

    public function render()
    {
        $results =[];

        if(strlen($this->search)>=1){
            $results = Book::where('title','like','%'.$this->search.'%')->limit(7)->get();
        }

        return view('livewire.book-search',[
            'books' => $results
        ]);
    }
}
