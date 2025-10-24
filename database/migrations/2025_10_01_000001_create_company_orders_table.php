<?php

use App\Enums\OrderStatus;
use App\Models\Supplier;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_orders', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique()->nullable();
            $table->date('order_date')->nullable();
            $table->enum('status', OrderStatus::cases());
            $table->foreignIdFor(Supplier::class)->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_orders');
    }
};
