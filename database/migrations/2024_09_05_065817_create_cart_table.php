<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('carts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('customer_id')->constrained('users');
        $table->foreignId('bookid')->constrained('books'); // Ensure this matches 'bookid' in books table
        $table->integer('quantity', false, true)->length(11);
        $table->decimal('price', 9, 2);
        $table->decimal('total', 9, 2);
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('carts');
}
};
