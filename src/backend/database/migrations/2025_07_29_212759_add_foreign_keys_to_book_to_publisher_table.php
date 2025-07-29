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
        Schema::table('book_publisher', function (Blueprint $table) {
            $table->foreign(['book_id'], 'bookToPublisher_book_id_fkey')->references(['id'])->on('books')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['publisher_id'], 'bookToPublisher_publisher_id_fkey')->references(['id'])->on('publishers')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_publisher', function (Blueprint $table) {
            $table->dropForeign('bookToPublisher_book_id_fkey');
            $table->dropForeign('bookToPublisher_publisher_id_fkey');
        });
    }
};
