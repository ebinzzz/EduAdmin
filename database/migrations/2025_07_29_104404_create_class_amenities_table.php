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
        Schema::create('class_amenities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('school_classes')->onDelete('cascade');
            $table->enum('item_type', ['furniture', 'equipment', 'electronics', 'stationary']);
            $table->string('item_name', 100);
            $table->integer('total_quantity');
            $table->integer('working_quantity')->default(0);
            $table->integer('damaged_quantity')->default(0);
            $table->integer('repair_quantity')->default(0);
            $table->string('brand', 100)->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_cost', 10, 2)->nullable();
            $table->enum('overall_condition', ['excellent', 'good', 'fair', 'poor', 'damaged']);
            $table->string('vendor', 200)->nullable();
            $table->text('specifications')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index(['class_id', 'item_type']);
            $table->index('item_type');
            $table->index('overall_condition');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_amenities');
    }
};