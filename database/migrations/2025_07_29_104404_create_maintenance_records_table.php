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
        Schema::create('maintenance_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('amenity_id')->constrained('class_amenities')->onDelete('cascade');
            $table->enum('maintenance_type', ['repair', 'replacement', 'upgrade', 'disposal']);
            $table->date('maintenance_date');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent']);
            $table->integer('quantity_affected');
            $table->text('issue_description');
            $table->decimal('maintenance_cost', 10, 2)->nullable();
            $table->string('maintenance_vendor', 200)->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->text('completion_notes')->nullable();
            $table->date('completion_date')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            
            // Indexes
            $table->index(['status', 'priority']);
            $table->index('maintenance_date');
            $table->index(['amenity_id', 'status']);
            $table->index('priority');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_records');
    }
};