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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('order_number')->unique();

            $table->enum('status', [
                'pending',
                'approved',
                'preparing',
                'shipped',
                'delivered',
                'returned',
                'cancelled'
            ])->default('pending');

            $table->decimal('total_amount', 10, 2)->default(0);
            $table->string('payment_type')->nullable();
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('set null');

            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('set null');
        });


        Schema::create("order_product", function (Blueprint $table) {
            $table->id()->bigIncrements();
            $table->timestamps();

            $table->unsignedInteger("amount");

            $table->unsignedInteger("price_before_tax");

            $table->unsignedBigInteger("product_id");
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');

            $table->unsignedBigInteger("order_id");
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_product');
    }
};
