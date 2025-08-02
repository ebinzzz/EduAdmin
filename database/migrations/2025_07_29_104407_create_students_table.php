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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id', 20)->unique(); // School student ID
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->foreignId('class_id')->nullable()->constrained('school_classes')->onDelete('set null');
            $table->string('roll_number', 10)->nullable();
            $table->string('admission_number', 20)->unique();
            $table->date('admission_date');
            $table->string('academic_year', 20);
            $table->enum('status', ['active', 'inactive', 'transferred', 'graduated'])->default('active');
            
            // Contact Information
            $table->string('phone', 15)->nullable();
            $table->string('email', 100)->nullable();
            $table->text('address')->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('pincode', 10)->nullable();
            
            // Guardian Information
            $table->string('father_name', 100)->nullable();
            $table->string('mother_name', 100)->nullable();
            $table->string('guardian_name', 100)->nullable();
            $table->string('guardian_phone', 15)->nullable();
            $table->string('guardian_email', 100)->nullable();
            $table->string('guardian_relation', 50)->nullable();
            
            // Additional Info
            $table->string('blood_group', 5)->nullable();
            $table->text('medical_conditions')->nullable();
            $table->string('emergency_contact', 15)->nullable();
            $table->text('remarks')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index(['class_id', 'status']);
            $table->index('academic_year');
            $table->index(['status', 'academic_year']);
            $table->unique(['class_id', 'roll_number'], 'unique_class_roll');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};