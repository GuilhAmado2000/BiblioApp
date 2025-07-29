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
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('isbn', 25)->unique();
            $table->string('code', 191)->unique();
            $table->string('name', 191);
            $table->string('edition', 100);
            $table->date('publication_date');
            $table->string('description', 255)->nullable();
            $table->unsignedInteger('pages');
            $table->string('image', 191)->nullable();
            $table->decimal('price', 5, 2);
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('rating');

            $table->dateTime('created_at', 3)->useCurrent();
            $table->dateTime('updated_at', 3);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
