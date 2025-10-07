<?php

use App\Models\Order;
use App\Models\Product;
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
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            // cascade is dat het ook verwijderd in de schakeltabel (pivot). update haalt het id helemaal weg zodat je er NIKS aan kan koppelen
            $table->foreignIdFor(Order::class)->constrained()->updateOnDelete()->cascadeOnDelete();
            $table->foreignIdFor(Product::class)->constrained();
            $table->integer('quantity')->default(1);
            $table->float('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
};
