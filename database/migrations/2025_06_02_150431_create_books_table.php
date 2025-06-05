<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->string('book_id')->primary();  // or use $table->id() for auto-increment
            $table->string('title');
            $table->string('author');
            $table->integer('year');
            $table->decimal('price', 8, 2);
            $table->enum('status', ['available', 'unavailable']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
