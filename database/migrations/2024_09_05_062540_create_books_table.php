<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // Creates 'id' column as primary key with auto-increment
            $table->string('title', 50); // VARCHAR(50) for the book title
            $table->string('bookimage1', 255); // Adjusted length for VARCHAR
            $table->string('bookimage2', 255)->nullable(); // Adjusted length for VARCHAR
            $table->string('bookimage3', 255)->nullable(); // Adjusted length for VARCHAR
            $table->string('author', 50); // VARCHAR(50) for the book author
            $table->string('publisher', 50); // VARCHAR(50) for the book publisher
            $table->text('synopsis'); // TEXT for the book synopsis
            $table->string('language', 50); // VARCHAR(50) for the book language
            $table->decimal('price', 9, 2); // DECIMAL(9,2) for the book price
            $table->decimal('weight', 9, 2); // DECIMAL(9,2) for the book weight
            $table->integer('page', false, true)->length(11); // INT(11) for the number of pages
            $table->string('chapter', 50); // VARCHAR(50) for the chapter of the book
            $table->string('isbn', 20); // VARCHAR(20) for the ISBN number
            $table->integer('stockcount', false, true)->length(11); // INT(11) for the stock count
            $table->integer('publishyear', false, true)->length(11); // INT(11) for the publish year
            $table->integer('popularity'); // Adjusted type for popularity
            $table->date('date_added'); // DATE for the date added
            $table->boolean('isnew'); // BOOLEAN for indicating if the book is new
            $table->timestamps(); // Adds 'created_at' and 'updated_at' timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }

    /**
     * Reverse the migrations.
     */

};
