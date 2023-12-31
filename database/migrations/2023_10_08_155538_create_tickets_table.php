<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->text('title');
            $table->longText('description')->nullable();
            $table->text('image')->nullable();

            $table->ulid('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('ticket_categories');

            $table->enum('status', ['open', 'closed', 'in progress', 'on hold'])->default('open');
            $table->enum('priority', ['high', 'medium', 'low'])->default('medium');
            $table->text('feedback_notes')->nullable();

            $table->ulid('creator_user_id')->nullable();
            $table->foreign('creator_user_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
