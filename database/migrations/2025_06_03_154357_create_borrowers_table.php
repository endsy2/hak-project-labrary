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
       Schema::create('borrowers', function (Blueprint $table) {
    $table->id();
    $table->string('member_id');
    $table->string('first_name');
    $table->string('last_name');
    $table->string('address');
    $table->string('book_id');
    $table->string('mobile_phone');
    $table->enum('member_type', ['student', 'faculty', 'staff']);
    $table->enum('book_status', ['borrowed', 'returned', 'overdue']);
    $table->date('borrow_date')->nullable();
    $table->date('due_date')->nullable();
    $table->date('return_date')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowers');
    }
};
