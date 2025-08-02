@extends('layouts.app')

@section('title', 'Create New Class')
@section('page_title')
Class Management
@endsection

@section('breadcrumb', 'Home / Administration / Class Management/ Create New Class')
@section('content')
<div class="dashboard-wrapper">
    <!-- Header Section -->


    <!-- Hero Section -->
   

    <!-- Main Hero Banner -->
    <div class="main-hero">
        <div class="hero-inner">
            <h1 class="hero-title">Add New Class</h1>
            <p class="hero-description">Fill in the details below to add a new class to the system</p>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="breadcrumb-container">
        <nav class="breadcrumb">
            <a href="{{ route('dashboard') }}" class="breadcrumb-item">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <span class="breadcrumb-separator">></span>
            <a href="{{ route('class-management.index') }}" class="breadcrumb-item">Classes</a>
            <span class="breadcrumb-separator">></span>
            <span class="breadcrumb-current">Add Class</span>
        </nav>
    </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    <!-- Form Container -->
    <div class="form-container">
        <form id="createClassForm" method="POST" action="{{ route('create.class') }}" class="class-form">
            @csrf
            
            <!-- Basic Information Section -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h2 class="section-title">Basic Information</h2>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="class_name" class="form-label">Class Name <span class="required">*</span></label>
                        <div class="select-wrapper">
                            <i class="fas fa-graduation-cap select-icon"></i>
                            <select class="form-select @error('name') is-invalid @enderror" 
                                    id="class_name" 
                                    name="name" 
                                    required>
                                <option value="">Select Class</option>
                                <option value="LKG" {{ old('name') == 'LKG' ? 'selected' : '' }}>LKG</option>
                                <option value="UKG" {{ old('name') == 'UKG' ? 'selected' : '' }}>UKG</option>
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ old('name') == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        @error('name')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="section" class="form-label">Section <span class="required">*</span></label>
                        <div class="select-wrapper">
                            <i class="fas fa-list select-icon"></i>
                            <select class="form-select @error('section') is-invalid @enderror" 
                                    id="section" 
                                    name="section" 
                                    required>
                                <option value="">Select Section</option>
                                @foreach(range('A', 'G') as $letter)
                                    <option value="{{ $letter }}" {{ old('section') == $letter ? 'selected' : '' }}>
                                        Section {{ $letter }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('section')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="academic_year" class="form-label">Academic Year <span class="required">*</span></label>
                        <div class="select-wrapper">
                            <i class="fas fa-calendar-alt select-icon"></i>
                            <select class="form-select @error('academic_year') is-invalid @enderror" 
                                    id="academic_year"
                                    name="academic_year" 
                                    required>
                                <option value="2024-2025" {{ old('academic_year', '2024-2025') == '2024-2025' ? 'selected' : '' }}>
                                    2024-2025
                                </option>
                                <option value="2025-2026" {{ old('academic_year') == '2025-2026' ? 'selected' : '' }}>
                                    2025-2026
                                </option>
                            </select>
                        </div>
                        @error('academic_year')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="class_teacher_id" class="form-label">Class Teacher</label>
                        <div class="select-wrapper">
                            <i class="fas fa-user select-icon"></i>
                            <select class="form-select @error('class_teacher_id') is-invalid @enderror" 
                                    id="class_teacher_id" 
                                    name="class_teacher_id">
                                <option value="">Select Teacher</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('class_teacher_id') == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->first_name }} {{ $teacher->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <span class="help-text">Optional: Assign a class teacher</span>
                        @error('class_teacher_id')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="student_capacity" class="form-label">Student Capacity</label>
                        <div class="input-wrapper">
                            <i class="fas fa-users input-icon"></i>
                            <input type="number" 
                                   class="form-input @error('student_capacity') is-invalid @enderror" 
                                   id="student_capacity"
                                   name="student_capacity" 
                                   value="{{ old('student_capacity', 40) }}" 
                                   min="1" 
                                   max="100"
                                   placeholder="40">
                        </div>
                        <span class="help-text">Maximum number of students (1-100)</span>
                        @error('student_capacity')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="room_number" class="form-label">Room Number</label>
                        <div class="input-wrapper">
                            <i class="fas fa-door-open input-icon"></i>
                            <input type="text" 
                                   class="form-input @error('room_number') is-invalid @enderror" 
                                   id="room_number"
                                   name="room_number" 
                                   value="{{ old('room_number') }}"
                                   placeholder="e.g., R-101">
                        </div>
                        @error('room_number')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Location Details Section -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h2 class="section-title">Location Details</h2>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="building" class="form-label">Building</label>
                        <div class="input-wrapper">
                            <i class="fas fa-building input-icon"></i>
                            <input type="text" 
                                   class="form-input @error('building') is-invalid @enderror" 
                                   id="building"
                                   name="building" 
                                   value="{{ old('building') }}"
                                   placeholder="e.g., Main Block">
                        </div>
                        @error('building')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="floor_number" class="form-label">Floor</label>
                        <div class="select-wrapper">
                            <i class="fas fa-layer-group select-icon"></i>
                            <select class="form-select @error('floor_number') is-invalid @enderror" 
                                    id="floor_number"
                                    name="floor_number">
                                <option value="">Select Floor</option>
                                <option value="0" {{ old('floor_number') == '0' ? 'selected' : '' }}>Ground Floor</option>
                                @for($i = 1; $i <= 4; $i++)
                                    <option value="{{ $i }}" {{ old('floor_number') == $i ? 'selected' : '' }}>
                                        {{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Floor
                                    </option>
                                @endfor
                            </select>
                        </div>
                        @error('floor_number')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status" class="form-label">Status</label>
                        <div class="select-wrapper">
                            <i class="fas fa-toggle-on select-icon"></i>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status"
                                    name="status">
                                <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        @error('status')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-textarea @error('description') is-invalid @enderror" 
                                  id="description"
                                  name="description" 
                                  rows="4" 
                                  placeholder="Optional description about the class">{{ old('description') }}</textarea>
                        <span class="help-text">Provide any additional information about this class</span>
                        @error('description')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="button" onclick="window.location.href='{{ route('class-management.index') }}'" class="btn btn-cancel">
                    <i class="fas fa-times"></i>
                    Cancel
                </button>
                <button type="submit" class="btn btn-save" id="submitBtn">
                    <i class="fas fa-save"></i>
                    Save Class
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Dashboard Wrapper */
.dashboard-wrapper {
    background: #f8f9fb;
    min-height: 100vh;
}

/* Page Header */
.page-header {
    background: white;
    padding: 20px 30px;
    border-bottom: 1px solid #e5e7eb;
}

.header-content {
    max-width: 1200px;
    margin: 0 auto;
}

.page-title {
    font-size: 24px;
    font-weight: 600;
    color: #1f2937;
    margin: 0 0 5px 0;
}

.page-subtitle {
    font-size: 14px;
    color: #6b7280;
    margin: 0;
}

/* Hero Section */
.hero-section {
    background: #e5e7eb;
    padding: 40px 0;
    text-align: center;
}

.hero-content {
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
}

.hero-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 80px;
    height: 80px;
    background: #6b7280;
    border-radius: 50%;
    color: white;
    font-size: 32px;
}

/* Main Hero */
.main-hero {
    background: linear-gradient(135deg, #4f94d4 0%, #3b82f6 100%);
    padding: 60px 0;
    text-align: center;
    color: white;
    
}

.hero-inner {
    max-width: 1200px;
    margin: 0 auto;
}

.hero-title {
    font-size: 36px;
    font-weight: 600;
    margin: 0 0 15px 0;
}

.hero-description {
    font-size: 16px;
    opacity: 0.9;
    margin: 0;
}

/* Breadcrumb */
.breadcrumb-container {
    padding: 20px 0;
    max-width: 1200px;
    margin-left:20px;
    padding-left: 30px;
    padding-right: 30px;
}

.breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
}

.breadcrumb-item {
    color: #3b82f6;
    text-decoration: none;
    transition: color 0.2s;
}

.breadcrumb-item:hover {
    color: #1d4ed8;
}

.breadcrumb-separator {
    color: #6b7280;
    font-size: 12px;
}

.breadcrumb-current {
    color: #6b7280;
}

/* Form Container */
.form-container {
    width:100%;
    margin: 0 auto;
    padding: 0 30px 50px;
}

.class-form {
    background: white;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

/* Form Sections */
.form-section {
    padding: 30px;
    border-bottom: 1px solid #f3f4f6;
}

.form-section:last-of-type {
    border-bottom: none;
}

.section-header {
    display: flex;
    align-items: center;
    margin-bottom: 25px;
}

.section-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
    background: #3b82f6;
    border-radius: 50%;
    color: white;
    font-size: 12px;
    margin-right: 12px;
}

.section-title {
    font-size: 16px;
    font-weight: 600;
    color: #1f2937;
    margin: 0;
}

/* Form Rows */
.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.form-row:last-child {
    margin-bottom: 0;
}

/* Form Groups */
.form-group {
    display: flex;
    flex-direction: column;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-label {
    font-size: 14px;
    font-weight: 500;
    color: #374151;
    margin-bottom: 8px;
}

.required {
    color: #ef4444;
}

/* Input Wrappers */
.input-wrapper,
.select-wrapper {
    position: relative;
}

.input-icon,
.select-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    font-size: 14px;
    z-index: 2;
}

/* Form Inputs */
.form-input,
.form-select,
.form-textarea {
    width: 100%;
    padding: 12px 16px 12px 40px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 14px;
    background: #f9fafb;
    transition: all 0.2s ease;
    outline: none;
}

.form-input:focus,
.form-select:focus,
.form-textarea:focus {
    background: white;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-select {
    appearance: none;
    background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="%236b7280"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>');
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px;
    cursor: pointer;
}

.form-textarea {
    padding: 12px 16px;
    resize: vertical;
    min-height: 100px;
    font-family: inherit;
}

/* Validation States */
.form-input.is-invalid,
.form-select.is-invalid,
.form-textarea.is-invalid {
    border-color: #ef4444;
    background: #fef2f2;
}

.form-input.is-invalid:focus,
.form-select.is-invalid:focus,
.form-textarea.is-invalid:focus {
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

/* Help Text */
.help-text {
    font-size: 12px;
    color: #6b7280;
    margin-top: 5px;
    font-style: italic;
}

/* Error Text */
.error-text {
    font-size: 12px;
    color: #ef4444;
    margin-top: 5px;
}

/* Form Actions */
.form-actions {
    padding: 25px 30px;
    background: #f9fafb;
    border-top: 1px solid #f3f4f6;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
}

.btn-cancel {
    background: #f3f4f6;
    color: #374151;
    border: 1px solid #d1d5db;
}

.btn-cancel:hover {
    background: #e5e7eb;
    transform: translateY(-1px);
}

.btn-save {
    background: #3b82f6;
    color: white;
}

.btn-save:hover {
    background: #2563eb;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.btn.loading {
    opacity: 0.7;
    cursor: not-allowed;
    pointer-events: none;
}

.btn.loading i {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-header,
    .breadcrumb-container,
    .form-container {
        padding-left: 20px;
        padding-right: 20px;
    }
    
    .hero-title {
        font-size: 28px;
    }
    
    .form-section {
        padding: 20px;
    }
    
    .form-row {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .form-actions {
        padding: 20px;
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
}

/* Animation */
.class-form {
    animation: slideUp 0.5s ease-out;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
/* Optional: Custom alert style overrides */
.alert {
    border-radius: 0.5rem;
    padding: 1rem 1.25rem;
    font-size: 0.95rem;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    position: relative;
    transition: opacity 0.3s ease;
}

/* Alert text styling */
.alert ul {
    margin: 0;
    padding-left: 1.2rem;
}

.alert-success {
    background-color: #e8f5e9;
    color: #2e7d32;
    border: 1px solid #c8e6c9;
}

.alert-danger {
    background-color: #ffebee;
    color: #c62828;
    border: 1px solid #ef9a9a;
}

.alert-warning {
    background-color: #fff8e1;
    color: #f57c00;
    border: 1px solid #ffe082;
}

/* Close button customization */
.alert .btn-close {
    position: absolute;
    right: 1rem;
    top: 1rem;
    background: none;
    border: none;
    font-size: 1.1rem;
    opacity: 0.6;
}

.alert .btn-close:hover {
    opacity: 1;
}

</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('createClassForm');
    const submitBtn = document.getElementById('submitBtn');
    const requiredFields = form.querySelectorAll('[required]');
    
    // Form submission handling
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        // Validate required fields
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            
            // Scroll to first invalid field
            const firstInvalid = form.querySelector('.is-invalid');
            if (firstInvalid) {
                firstInvalid.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'center' 
                });
                firstInvalid.focus();
            }
        } else {
            // Show loading state
            submitBtn.classList.add('loading');
            submitBtn.innerHTML = '<i class="fas fa-spinner"></i>Creating Class...';
        }
    });
    
    // Real-time validation
    requiredFields.forEach(field => {
        field.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
            }
        });
        
        field.addEventListener('change', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
            }
        });
    });
    
    // Student capacity validation
    const capacityField = document.getElementById('student_capacity');
    if (capacityField) {
        capacityField.addEventListener('input', function() {
            const value = parseInt(this.value);
            if (value < 1 || value > 100 || isNaN(value)) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    }
    
    // Prevent double submission
    let isSubmitting = false;
    form.addEventListener('submit', function(e) {
        if (isSubmitting) {
            e.preventDefault();
            return false;
        }
        
        const isValid = form.checkValidity();
        if (isValid) {
            isSubmitting = true;
        }
    });
});
</script>
@endpush