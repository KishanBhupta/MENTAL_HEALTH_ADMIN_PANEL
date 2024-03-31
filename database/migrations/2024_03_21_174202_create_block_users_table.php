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
        Schema::create('block_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("users_id");
            $table->foreign('users_id')->references('id')->on('users')->cascadeOnDelete()->onUpdate('cascade');
            $table->unsignedBigInteger("block_users_id");
            $table->foreign('block_users_id')->references('id')->on('users')->cascadeOnDelete()->onUpdate('cascade');
            $table->boolean('status');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('block_users');
    }
};
