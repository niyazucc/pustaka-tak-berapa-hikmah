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
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('date_added'); // Drop the 'date_added' column
        });
    }


    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->date('date_added'); // Recreate the 'date_added' column
        });
    }
};
