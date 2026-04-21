<?php

use App\Models\Category;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10);
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete(); // Пока сделаем связь 1->М, а не М->М через category_products
            $table->boolean('in_stock')->default(true);
            $table->float('rating')->default(0);
            $table->timestamps();

            $table->index('name');
            $table->index('category_id');
            $table->index('price');
            $table->index('in_stock');
            $table->index('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
