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
        Schema::create('school_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50); // Class name like '1', '2', 'LKG', etc.
            $table->string('section', 10); // Section like 'A', 'B', etc.
            $table->foreignId('class_teacher_id')->nullable()->constrained('teachers')->onDelete('set null');
            $table->integer('student_capacity')->default(30);
            $table->integer('current_student_count')->default(0);
            $table->string('room_number', 20)->nullable();
            $table->string('building', 100)->default('Main Block');
            $table->integer('floor_number')->nullable();
            $table->string('academic_year', 20); // e.g., '2024-2025'
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            
            // Indexes
            $table->index(['name', 'section', 'academic_year']);
            $table->index('academic_year');
            $table->index('status');
            $table->unique(['name', 'section', 'academic_year'], 'unique_class_section_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_classes');
    }
};