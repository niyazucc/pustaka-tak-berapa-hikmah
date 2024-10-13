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
        Schema::table('discounts', function (Blueprint $table) {
            $table->foreignId('book_id')->nullable()->change();
            $table->decimal('discount_rate', 5, 2)->nullable()->change();
            $table->dateTime('start_datetime')->nullable()->change();
            $table->dateTime('end_datetime')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('discounts', function (Blueprint $table) {
            $table->foreignId('book_id')->nullable(false)->change();
            $table->decimal('discount_rate', 5, 2)->nullable(false)->change();
            $table->dateTime('start_datetime')->nullable(false)->change();
            $table->dateTime('end_datetime')->nullable(false)->change();
        });
    }
};
