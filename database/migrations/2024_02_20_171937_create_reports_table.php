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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')->cascadeOnDelete();

            $table->unsignedBigInteger('reportedUserId')->nullable();
            $table->foreign('reportedUserID')->references('id')->on('users')->cascadeOnDelete();

            $table->unsignedBigInteger('reportedPostId')->nullable();
            $table->foreign('reportedPostID')->references('id')->on('posts')->cascadeOnDelete();

            $table->unsignedBigInteger('reportedCommentId')->nullable();
            $table->foreign('reportedCommentID')->references('id')->on('comments')->cascadeOnDelete();

            $table->string('reportReason');

            $table->string('reportStatus');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
