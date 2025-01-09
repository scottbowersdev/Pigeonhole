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
        Schema::create('wishlist', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('priority');
            $table->string('title');
            $table->string('url');
            $table->decimal('cost');
            $table->boolean('purchased')->default(0);
            $table->timestamp('date_purchased');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlist');
    }
};
