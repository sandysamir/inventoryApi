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
           Schema::create('stock_transfers', function (Blueprint $table) {
        $table->id();

        $table->foreignId('inventory_item_id')
              ->constrained()
              ->cascadeOnDelete();

    $table->foreignId('from_warehouse_id')
      ->constrained('warehouses')
      ->noActionOnDelete();

$table->foreignId('to_warehouse_id')
      ->constrained('warehouses')
      ->noActionOnDelete();

        $table->unsignedInteger('quantity');

        $table->index(['from_warehouse_id', 'to_warehouse_id']);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transfers');
    }
};
