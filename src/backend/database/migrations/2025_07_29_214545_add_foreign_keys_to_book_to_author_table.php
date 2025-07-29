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
        Schema::table('book_author', function (Blueprint $table) {
            $table->foreign(['author_id'], 'bookToAuthor_author_id_fkey')->references(['id'])->on('authors')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['book_id'], 'bookToAuthor_book_id_fkey')->references(['id'])->on('books')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_author', function (Blueprint $table) {
            $table->dropForeign('bookToAuthor_author_id_fkey');
            $table->dropForeign('bookToAuthor_book_id_fkey');
        });
    }
};
