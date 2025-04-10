<?php

use App\Models\Category;
use App\Models\Outgoing;
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
        Schema::create('outgoings', function (Blueprint $table) {
            $table->id();
            $table->integer('month_id');
            $table->boolean('recurring')->default(0);
            $table->integer('day');
            $table->string('title');
            $table->decimal('cost');
            $table->boolean('paid')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('category_outgoing', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Outgoing::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outgoings');
    }
};
