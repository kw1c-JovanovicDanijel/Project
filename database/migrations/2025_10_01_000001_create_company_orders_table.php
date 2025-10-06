<?php

use App\Enums\OrderStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_orders', function (Blueprint $table) {
            $table->id();
            $table->date('order_date')->nullable();
            $table->enum('status', OrderStatus::cases());
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_orders');
    }
};
