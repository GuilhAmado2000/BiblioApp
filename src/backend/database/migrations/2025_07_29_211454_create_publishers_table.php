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
        Schema::create('publishers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 191);
            $table->text('description')->nullable();
            $table->string('address', 191);
            $table->string('phone_number', 50)->unique();
            $table->string('email', 191)->unique();
            $table->string('website', 191)->unique();
            $table->string('image_logo', 191)->nullable();
            $table->boolean('status');

            $table->dateTime('created_at', 3)->useCurrent();
            $table->dateTime('updated_at', 3);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publishers');
    }
};
