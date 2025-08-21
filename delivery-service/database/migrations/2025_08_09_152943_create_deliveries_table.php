<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_code')->unique();

            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('courier_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();

            $table->unsignedBigInteger('delivery_status_id')->default(1);
            $table->foreign('delivery_status_id')->references('id')->on('delivery_statuses');

            $table->string('type');

            $table->string('pickup_address');
            $table->string('delivery_address');

            $table->dateTime('pickup_time')->nullable();
            $table->dateTime('delivery_time')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index('delivery_status_id');
            $table->index('courier_id');
            $table->index('order_id');
            $table->index('customer_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
