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
                $table->string('name');          // Ex: HP EliteBook, iPhone 13
                $table->string('brand');         // Marque
                $table->string('category');      // Ordinateur ou Téléphone
                $table->text('description');     // Caractéristiques (RAM, Stockage...)
                $table->decimal('price', 10, 2); // Prix en FCFA
                $table->integer('stock_quantity')->default(0);
                $table->string('image')->nullable(); 
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
