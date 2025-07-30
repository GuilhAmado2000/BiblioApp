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
        Schema::create('book_publisher', function (Blueprint $table) {
            $table->uuid('book_id');
            $table->uuid('publisher_id');

            // Chaves estrangeiras com CASCADE
            $table->foreign('book_id')
                ->references('id')->on('books')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('publisher_id')
                ->references('id')->on('publishers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->primary(['book_id', 'publisher_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_publisher', function (Blueprint $table) {
            Schema::dropIfExists('book_publisher');
        });
    }
};
