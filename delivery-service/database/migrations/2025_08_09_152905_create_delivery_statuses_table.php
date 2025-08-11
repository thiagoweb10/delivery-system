<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('delivery_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug', 50)->unique();
            $table->string('color', 20)->nullable();
            $table->timestamps();
        });

        // Seed padrão (opcional)
        DB::table('delivery_statuses')->insert([
            ['name' => 'Pendente', 'slug' => 'pending', 'color' => '#ffc107', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Em Rota', 'slug' => 'in_transit', 'color' => '#17a2b8', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Entregue', 'slug' => 'delivered', 'color' => '#28a745', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cancelado', 'slug' => 'canceled', 'color' => '#dc3545', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_statuses');
    }
};
