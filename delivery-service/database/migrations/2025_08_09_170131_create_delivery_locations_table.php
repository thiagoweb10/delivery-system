<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('delivery_locations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('delivery_id');
            $table->foreign('delivery_id')->references('id')->on('deliveries')->cascadeOnDelete();

            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);

            $table->string('type'); // ex: pickup, checkpoint, dropoff

            $table->timestamp('recorded_at')->useCurrent();

            $table->timestamps();

            $table->index(['delivery_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_locations');
    }
};
