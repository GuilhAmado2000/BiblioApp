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
        Schema::create('book_author', function (Blueprint $table) {
            $table->uuid('author_id');
            $table->uuid('book_id');

            // Define a chave primária composta
            $table->primary(['author_id', 'book_id']);

            // Foreign keys
            $table->foreign('author_id')
                ->references('id')->on('authors')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('book_id')
                ->references('id')->on('books')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_author');
    }
};
