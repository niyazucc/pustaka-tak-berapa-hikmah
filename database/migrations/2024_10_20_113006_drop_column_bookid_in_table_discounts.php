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
        Schema::table('discounts', function (Blueprint $table) {
            // Drop the foreign key constraint using the correct name
            $table->dropForeign('discounts_book_id_foreign');
            // Drop the book_id column
            $table->dropColumn('book_id');
        });
    }

    public function down(): void
    {
        Schema::table('discounts', function (Blueprint $table) {
            // Recreate the book_id column
            $table->unsignedBigInteger('book_id')->nullable();
            // Re-add the foreign key constraint
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }
};
