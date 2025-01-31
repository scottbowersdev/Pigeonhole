<?php

use App\Models\Category;
use App\Models\User;
use App\Models\Wishlist;
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
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->integer('priority');
            $table->string('title');
            $table->string('url')->nullable();
            $table->decimal('cost');
            $table->boolean('purchased')->default(0);
            $table->timestamp('date_purchased')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('category_wishlist', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Wishlist::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
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
