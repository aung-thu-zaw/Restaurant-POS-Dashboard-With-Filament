<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cashier_id')->constrained('users');
            $table->string('order_no');
            $table->string('invoice_no');
            $table->integer('product_qty');
            $table->enum('payment_method', ['card', 'cash']);
            $table->enum('payment_status', ['pending', 'completed'])->default('pending');
            $table->enum('order_type', ['takeaway', 'dine-in']);
            $table->timestamp('purchased_at')->nullable();
            $table->decimal('total_amount', 8, 2);
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('note')->nullable();
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
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
