<?php

namespace App\Livewire\Admin\Book\Tables;

use App\Models\Book;
use Livewire\Component;
use Filament\Tables\Table;
use App\Livewire\BaseTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class BookTable extends BaseTable
{

    public ?Book $book = null;

    public function table(Table $table): Table
    {
        return $table
            ->recordUrl(    
                fn(Book $book): string => route('admin.edit', ['book' => $book->id]),
            )
            ->query(Book::query())
            ->columns([
                TextColumn::make('id')->label('Book ID'),
                TextColumn::make('title')->searchable()->label('Title'),
                TextColumn::make('author')->label('Author'),
                TextColumn::make('publisher')->label('Publisher'),
                ImageColumn::make('bookimage1')->label('Book Image')->width(100)->height(100),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y, h:i A'), // Formatting the timestamp
                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d M Y, h:i A'), // Formatting the timestamp
            ]);

    }
    public function render()
    {
        return view('livewire.admin.book.tables.book-table');
    }
}
