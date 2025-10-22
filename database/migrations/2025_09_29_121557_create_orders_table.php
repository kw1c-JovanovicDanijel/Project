<?php

use App\Enums\OrderStatus;
use App\Models\Customer;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique()->nullable();
            $table->foreignIdFor(Customer::class)->constrained();
            $table->date('order_date')->nullable();
            $table->date('date_completed')->nullable();
            $table->enum('status', OrderStatus::cases());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
