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
        Schema::create('l_a_roles', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id');
    $table->enum('role', ['admin', 'organizer', 'attendee']);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('l_a_roles');
    }
};
