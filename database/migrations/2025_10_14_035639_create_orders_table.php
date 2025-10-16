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
            $table->string('order_number')->unique();
            $table->unsignedBigInteger('customer_id')->nullable(); // User who created the order
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->enum('status', [
                'pending', 'approved', 'preparing', 'shipped', 'delivered', 'returned', 'cancelled'
            ])->default('pending');
            $table->string('payment_type')->nullable();
            $table->string('branch_code');
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users')->onDelete('set null');
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
