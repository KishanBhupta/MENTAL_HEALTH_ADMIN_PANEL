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
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('reportedUserId')->nullable();
            $table->foreign('reportedUserID')->references('id')->on('users');

            $table->unsignedBigInteger('reportedPostId')->nullable();
            $table->foreign('reportedPostID')->references('id')->on('posts');

            $table->unsignedBigInteger('reportedCommentId')->nullable();
            $table->foreign('reportedCommentID')->references('id')->on('comments');

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
