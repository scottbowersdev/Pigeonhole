<?php

use App\Models\Category;
use App\Models\OutgoingsRecurring;
use App\Models\User;
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
        Schema::create('outgoings_recurring', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->integer('day');
            $table->string('title');
            $table->decimal('cost');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('category_outgoings_recurring', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(OutgoingsRecurring::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outgoings_recurring');
    }
};
