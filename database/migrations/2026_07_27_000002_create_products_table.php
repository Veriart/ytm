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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->bigInteger('price');
            $table->integer('stock')->default(0);
            $table->text('image')->nullable();
            $table->decimal('rating', 3, 2)->default(5.00);
            $table->integer('sold_count')->default(0);
            $table->text('dosage_guidelines')->nullable();
            $table->text('indication')->nullable();
            $table->text('pharmacist_note')->nullable();
            $table->timestamps();
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
