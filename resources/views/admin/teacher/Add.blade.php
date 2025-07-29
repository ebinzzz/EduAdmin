@extends('layouts.app')

@section('title', 'Add Teacher - EduManage')

@section('page-title', 'Add Teacher')

@section('breadcrumb', 'Home / User Management / Teachers / Add Teacher')

@section('styles')
<style>
    /* OPTIMIZED CONTAINER - Increased width and reduced padding */
    .container {
        max-width: 1200px; /* Increased from 1000px */
        background: white;
        border-radius: 15px; /* Reduced from 20px */
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1); /* Reduced shadow */
        overflow: hidden;
        animation: slideUp 0.5s ease;
        margin: 15px auto; /* Reduced margin */
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px); /* Reduced from 30px */
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-header {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        color: white;
        padding: 20px 30px; /* Reduced from 30px */
        text-align: center;
        position: relative;
    }

    .form-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" opacity="0.1"><polygon points="0,100 1000,0 1000,100"/></svg>');
        background-size: cover;
    }

    .form-header h1 {
        font-size: 24px; /* Reduced from 28px */
        font-weight: 700;
        margin-bottom: 8px;
        position: relative;
        z-index: 2;
    }

    .form-header p {
        font-size: 14px; /* Reduced from 16px */
        opacity: 0.9;
        position: relative;
        z-index: 2;
    }

    .form-header .icon {
        font-size: 36px; /* Reduced from 48px */
        margin-bottom: 12px;
        opacity: 0.8;
    }

    /* OPTIMIZED FORM BODY - Reduced padding */
    .form-body {
        padding: 30px; /* Reduced from 40px */
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 25px; /* Reduced from 30px */
        font-size: 13px;
        color: #718096;
    }

    .breadcrumb a {
        color: #3498db;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb a:hover {
        color: #2980b9;
    }

    .breadcrumb i {
        font-size: 11px;
    }

    /* OPTIMIZED GRID - Better spacing for wider container */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr; /* Changed to 3 columns from 2 */
        gap: 20px; /* Reduced from 25px */
        margin-bottom: 20px; /* Reduced from 25px */
    }

    .form-group {
        margin-bottom: 20px; /* Reduced from 25px */
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group.half-width {
        grid-column: span 2;
    }

    .form-label {
        display: block;
        margin-bottom: 6px; /* Reduced from 8px */
        font-weight: 600;
        color: #374151;
        font-size: 13px; /* Reduced from 14px */
        position: relative;
    }

    .form-label.required::after {
        content: '*';
        color: #e53e3e;
        margin-left: 3px;
    }

    /* OPTIMIZED INPUTS - Reduced padding and size */
    .form-input, .form-select, .form-textarea {
        width: 100%;
        padding: 12px 15px; /* Reduced from 15px 18px */
        border: 2px solid #e2e8f0;
        border-radius: 8px; /* Reduced from 12px */
        font-size: 14px; /* Reduced from 15px */
        transition: all 0.3s ease;
        background: #f8fafc;
    }

    .form-input:focus, .form-select:focus, .form-textarea:focus {
        outline: none;
        border-color: #3498db;
        background: white;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1); /* Reduced from 4px */
        transform: translateY(-1px); /* Reduced from -2px */
    }

    .form-select {
        cursor: pointer;
        background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="%23718096" stroke-width="2"><polyline points="6,9 12,15 18,9"/></svg>');
        background-repeat: no-repeat;
        background-position: right 12px center; /* Adjusted for smaller padding */
        background-size: 18px; /* Reduced from 20px */
        appearance: none;
    }

    .form-textarea {
        resize: vertical;
        min-height: 100px; /* Reduced from 120px */
        font-family: inherit;
    }

    .input-icon {
        position: relative;
    }

    .input-icon i {
        position: absolute;
        left: 15px; /* Adjusted for smaller padding */
        top: 50%;
        transform: translateY(-50%);
        color: #a0aec0;
        font-size: 14px; /* Reduced from 16px */
    }

    .input-icon .form-input {
        padding-left: 42px; /* Adjusted for smaller icon */
    }

    .form-actions {
        display: flex;
        gap: 12px; /* Reduced from 15px */
        justify-content: flex-end;
        margin-top: 30px; /* Reduced from 40px */
        padding-top: 25px; /* Reduced from 30px */
        border-top: 2px solid #f1f5f9;
    }

    /* OPTIMIZED BUTTONS - Slightly smaller */
    .btn {
        padding: 12px 25px; /* Reduced from 15px 30px */
        border: none;
        border-radius: 8px; /* Reduced from 12px */
        cursor: pointer;
        font-weight: 600;
        font-size: 14px; /* Reduced from 15px */
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 6px; /* Reduced from 8px */
        min-width: 120px; /* Reduced from 140px */
        justify-content: center;
    }

    .btn-primary {
        background: linear-gradient(135deg, #3498db, #2980b9);
        color: white;
        box-shadow: 0 3px 10px rgba(52, 152, 219, 0.3); /* Reduced shadow */
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #2980b9, #1f5f8b);
        transform: translateY(-1px); /* Reduced from -2px */
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4); /* Reduced shadow */
    }

    .btn-secondary {
        background: #f8fafc;
        color: #4a5568;
        border: 2px solid #e2e8f0;
    }

    .btn-secondary:hover {
        background: #edf2f7;
        border-color: #cbd5e0;
        transform: translateY(-1px); /* Reduced from -2px */
    }

    /* OPTIMIZED SECTIONS - Reduced spacing */
    .form-section {
        margin-bottom: 25px; /* Reduced from 35px */
        padding-bottom: 20px; /* Reduced from 25px */
        border-bottom: 1px solid #f1f5f9;
    }

    .form-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .section-title {
        font-size: 16px; /* Reduced from 18px */
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 15px; /* Reduced from 20px */
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-title i {
        color: #3498db;
    }

    .help-text {
        font-size: 12px; /* Reduced from 13px */
        color: #718096;
        margin-top: 4px; /* Reduced from 5px */
        font-style: italic;
    }

    .success-message {
        background: #d4edda;
        color: #155724;
        padding: 12px; /* Reduced from 15px */
        border-radius: 6px; /* Reduced from 8px */
        margin-bottom: 15px; /* Reduced from 20px */
        display: none;
        align-items: center;
        gap: 8px;
    }

    .error-message {
        background: #f8d7da;
        color: #721c24;
        padding: 12px; /* Reduced from 15px */
        border-radius: 6px; /* Reduced from 8px */
        margin-bottom: 15px; /* Reduced from 20px */
        display: none;
        align-items: center;
        gap: 8px;
    }

    /* Custom checkbox styling - optimized */
    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 12px; /* Reduced from 15px */
    }

    .custom-checkbox {
        position: relative;
        display: inline-block;
    }

    .custom-checkbox input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 18px; /* Reduced from 20px */
        width: 18px; /* Reduced from 20px */
        background-color: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 3px; /* Reduced from 4px */
        transition: all 0.3s ease;
    }

    .custom-checkbox:hover input ~ .checkmark {
        border-color: #3498db;
    }

    .custom-checkbox input:checked ~ .checkmark {
        background-color: #3498db;
        border-color: #3498db;
    }

    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    .custom-checkbox input:checked ~ .checkmark:after {
        display: block;
    }

    .custom-checkbox .checkmark:after {
        left: 5px; /* Adjusted for smaller checkbox */
        top: 1px;
        width: 5px; /* Reduced from 6px */
        height: 9px; /* Reduced from 10px */
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    /* Loading state */
    .btn.loading {
        opacity: 0.7;
        cursor: not-allowed;
        pointer-events: none;
    }

    .spinner {
        display: inline-block;
        width: 16px; /* Reduced from 18px */
        height: 16px; /* Reduced from 18px */
        border: 2px solid transparent;
        border-top: 2px solid currentColor;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .form-grid {
            grid-template-columns: 1fr 1fr; /* Back to 2 columns on smaller screens */
        }
    }

    @media (max-width: 1024px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .container {
            margin: 10px;
            max-width: none;
        }
    }

    @media (max-width: 768px) {
        .container {
            margin: 8px;
            border-radius: 10px;
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .form-body {
            padding: 20px 15px;
        }

        .form-header {
            padding: 20px 15px;
        }

        .form-header h1 {
            font-size: 20px;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="form-header">
        <div class="icon">
            <i class="fas fa-user-plus"></i>
        </div>
        <h1>Add New Teacher</h1>
        <p>Fill in the details below to add a new teacher to the system</p>
    </div>

    <div class="form-body">
        <div class="breadcrumb">
            <a href="{{route('dashboard')}}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <i class="fas fa-chevron-right"></i>
            <a href="{{route('teachermanage')}}">Teachers</a>
            <i class="fas fa-chevron-right"></i>
            <span>Add Teacher</span>
        </div>

        @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 10px 15px; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
        @endif
        @if($errors->any())
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px 15px; border: 1px solid #f5c6cb; border-radius: 5px; margin-bottom: 15px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="error-message" id="errorMessage">
            <i class="fas fa-exclamation-circle"></i>
            Please fill in all required fields correctly.
        </div>

        <form id="addTeacherForm" method="POST" action="{{route('store')}}">
            @csrf
            <!-- Personal Information Section -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-user"></i>
                    Personal Information
                </h3>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label required" for="firstName">First Name</label>
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" class="form-input" id="firstName" name="firstName" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required" for="lastName">Last Name</label>
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" class="form-input" id="lastName" name="lastName" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required" for="email">Email Address</label>
                        <div class="input-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" class="form-input" id="email" name="email" required>
                        </div>
                        <div class="help-text">This will be used for login credentials</div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required" for="phone">Phone Number</label>
                        <div class="input-icon">
                            <i class="fas fa-phone"></i>
                            <input type="tel" class="form-input" id="phone" name="phone" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required" for="employeeId">Employee ID</label>
                        <div class="input-icon">
                            <i class="fas fa-id-badge"></i>
                            <input type="text" class="form-input" id="employeeId" name="employeeId" vlaue="employeeIdField.value " required>
                        </div>
                        <div class="help-text">Unique identifier for the teacher</div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required" for="department">Department</label>
                        <select class="form-select" id="department" name="department" required>
                            <option value="">Select Department</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Science">Science</option>
                            <option value="English">English</option>
                            <option value="History">History</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Physical Education">Physical Education</option>
                            <option value="Art">Art</option>
                            <option value="Music">Music</option>
                            <option value="Languages">Languages</option>
                            <option value="Social Studies">Social Studies</option>
                        </select>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label class="form-label required" for="address">Address</label>
                    <textarea class="form-textarea" id="address" name="address" rows="3" placeholder="Enter full address..." required></textarea>
                </div>
            </div>

            <!-- Professional Information Section -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-briefcase"></i>
                    Professional Information
                </h3>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label required" for="joinDate">Joining Date</label>
                        <input type="date" class="form-input" id="joinDate" name="joinDate" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required" for="salary">Salary</label>
                        <div class="input-icon">
                            <i class="fas fa-dollar-sign"></i>
                            <input type="number" class="form-input" id="salary" name="salary" placeholder="0.00" step="0.01" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="experience">Years of Experience</label>
                        <div class="input-icon">
                            <i class="fas fa-calendar-check"></i>
                            <input type="number" class="form-input" id="experience" name="experience" placeholder="0" min="0">
                        </div>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label class="form-label" for="qualification">Qualifications</label>
                    <textarea class="form-textarea" id="qualification" name="qualification" rows="3" placeholder="Enter educational qualifications and certifications..."></textarea>
                </div>
            </div>

            <!-- Additional Information Section -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-cog"></i>
                    Account Settings
                </h3>
                
                <div class="checkbox-group">
                     <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                @include('components.send-credentials-checkbox', ['userType' => 'teacher'])
                            </div>
                        </div>
                    </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="resetForm()">
                    <i class="fas fa-undo"></i>
                    Reset Form
                </button>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-user-plus"></i>
                    Add Teacher
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function resetForm() {
        document.getElementById('addTeacherForm').reset();
        document.getElementById('errorMessage').style.display = 'none';
        
        // Reset border colors
        const inputs = document.querySelectorAll('.form-input, .form-select, .form-textarea');
        inputs.forEach(input => {
            input.style.borderColor = '#e2e8f0';
        });
    }

    // Auto-generate employee ID
    document.getElementById('firstName').addEventListener('input', generateEmployeeId);
    document.getElementById('lastName').addEventListener('input', generateEmployeeId);

    function generateEmployeeId() {
        const firstName = document.getElementById('firstName').value;
        const lastName = document.getElementById('lastName').value;
        const employeeIdField = document.getElementById('employeeId');
        
        if (firstName && lastName && !employeeIdField.value) {
            const year = new Date().getFullYear();
            const initials = (firstName.charAt(0) + lastName.charAt(0)).toUpperCase();
            const randomNum = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
            employeeIdField.value = `TCH${year}${initials}${randomNum}`;
        }
    }

    // Phone number formatting
    document.getElementById('phone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length >= 6) {
            value = value.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
        } else if (value.length >= 3) {
            value = value.replace(/(\d{3})(\d{0,3})/, '($1) $2');
        }
        e.target.value = value;
    });

    // Set maximum date for joining date (today)
    document.getElementById('joinDate').setAttribute('max', new Date().toISOString().split('T')[0]);

    // Success message auto-hide
    document.addEventListener("DOMContentLoaded", function () {
        const successMessage = document.querySelector('[style*="background-color: #d4edda"]');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.transition = "opacity 0.5s ease";
                successMessage.style.opacity = 0;
                setTimeout(() => successMessage.remove(), 500);
            }, 3000);
        }
    });
</script>
@endpush