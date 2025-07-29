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
            $table->foreign(['language_id'], 'books_language_id_fkey')->references(['id'])->on('languages')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['type_id'], 'books_type_id_fkey')->references(['id'])->on(['book_types'])->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['category_id'], 'books_category_id_fkey')->references(['id'])->on(['categories'])->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign('books_language_id_fkey');
            $table->dropForeign('books_type_id_fkey');
            $table->dropForeign('books_category_id_fkey');
        });
    }
};
