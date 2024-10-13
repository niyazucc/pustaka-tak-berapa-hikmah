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
        Schema::table('books', function (Blueprint $table) {
            // Make bookimage1, title, and popularity nullable
            $table->string('bookimage1')->nullable()->change();
            $table->string('title')->nullable()->change();
            $table->integer('popularity')->nullable()->change();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('bookimage1')->nullable(false)->change();
            $table->string('title')->nullable(false)->change();
            $table->integer('popularity')->nullable(false)->change();
        });
    }
};
