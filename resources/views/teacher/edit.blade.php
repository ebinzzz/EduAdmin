@extends('layouts.app')

@section('title', 'Edit Teacher - EduManage')

@section('page-title', 'Edit Teacher')

@section('breadcrumb', 'Home / User Management / Teachers / Edit Teacher')

@section('styles')
<style>
    .container {
        max-width: 1000px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        animation: slideUp 0.6s ease;
        margin: 0 auto;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-header {
        background: linear-gradient(135deg, #e67e22 0%, #d35400 100%);
        color: white;
        padding: 30px;
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
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 10px;
        position: relative;
        z-index: 2;
    }

    .form-header p {
        font-size: 16px;
        opacity: 0.9;
        position: relative;
        z-index: 2;
    }

    .form-header .icon {
        font-size: 48px;
        margin-bottom: 15px;
        opacity: 0.8;
    }

    .form-body {
        padding: 40px;
    }

    .page-breadcrumb {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 30px;
        font-size: 14px;
        color: #718096;
    }

    .page-breadcrumb a {
        color: #e67e22;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .page-breadcrumb a:hover {
        color: #d35400;
    }

    .page-breadcrumb i {
        font-size: 12px;
    }

    .teacher-id-display {
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 15px;
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .teacher-id-display .icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #e67e22, #d35400);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
    }

    .teacher-id-display .info h3 {
        font-size: 18px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 5px;
    }

    .teacher-id-display .info p {
        font-size: 14px;
        color: #718096;
    }

    .info-badge {
        background: linear-gradient(135deg, #3498db, #2980b9);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #374151;
        font-size: 14px;
        position: relative;
    }

    .form-label.required::after {
        content: '*';
        color: #e53e3e;
        margin-left: 4px;
    }

    .form-input, .form-select, .form-textarea {
        width: 100%;
        padding: 15px 18px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #f8fafc;
    }

    .form-input:focus, .form-select:focus, .form-textarea:focus {
        outline: none;
        border-color: #e67e22;
        background: white;
        box-shadow: 0 0 0 4px rgba(230, 126, 34, 0.1);
        transform: translateY(-2px);
    }

    .form-input:read-only {
        background-color: #f1f5f9;
        cursor: not-allowed;
        opacity: 0.7;
    }

    .form-select {
        cursor: pointer;
        background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="%23718096" stroke-width="2"><polyline points="6,9 12,15 18,9"/></svg>');
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 20px;
        appearance: none;
    }

    .form-textarea {
        resize: vertical;
        min-height: 120px;
        font-family: inherit;
    }

    .input-icon {
        position: relative;
    }

    .input-icon i {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #a0aec0;
        font-size: 16px;
    }

    .input-icon .form-input {
        padding-left: 50px;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
        margin-top: 40px;
        padding-top: 30px;
        border-top: 2px solid #f1f5f9;
    }

    .btn {
        padding: 15px 30px;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        font-weight: 600;
        font-size: 15px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 140px;
        justify-content: center;
    }

    .btn-primary {
        background: linear-gradient(135deg, #e67e22, #d35400);
        color: white;
        box-shadow: 0 4px 12px rgba(230, 126, 34, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #d35400, #ba4a00);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(230, 126, 34, 0.4);
    }

    .btn-secondary {
        background: #f8fafc;
        color: #4a5568;
        border: 2px solid #e2e8f0;
    }

    .btn-secondary:hover {
        background: #edf2f7;
        border-color: #cbd5e0;
        transform: translateY(-2px);
    }

    .btn-danger {
        background: linear-gradient(135deg, #e74c3c, #c0392b);
        color: white;
        box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
    }

    .btn-danger:hover {
        background: linear-gradient(135deg, #c0392b, #a93226);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
    }

    .form-section {
        margin-bottom: 35px;
        padding-bottom: 25px;
        border-bottom: 1px solid #f1f5f9;
    }

    .form-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: #e67e22;
    }

    .help-text {
        font-size: 13px;
        color: #718096;
        margin-top: 5px;
        font-style: italic;
    }

    .alert {
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .alert ul {
        margin: 0;
        padding-left: 20px;
    }

    /* Custom checkbox styling */
    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 15px;
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
        height: 20px;
        width: 20px;
        background-color: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .custom-checkbox:hover input ~ .checkmark {
        border-color: #e67e22;
    }

    .custom-checkbox input:checked ~ .checkmark {
        background-color: #e67e22;
        border-color: #e67e22;
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
        left: 6px;
        top: 2px;
        width: 6px;
        height: 10px;
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
        width: 18px;
        height: 18px;
        border: 2px solid transparent;
        border-top: 2px solid currentColor;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Delete Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    .modal.show {
        display: flex;
    }

    .modal-content {
        background: white;
        border-radius: 12px;
        padding: 30px;
        max-width: 400px;
        width: 90%;
        text-align: center;
    }

    .modal-content .icon {
        font-size: 48px;
        color: #e74c3c;
        margin-bottom: 20px;
    }

    .modal-content h3 {
        margin-bottom: 15px;
        color: #2d3748;
    }

    .modal-content p {
        color: #718096;
        margin-bottom: 25px;
    }

    .modal-actions {
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .form-body {
            padding: 30px 20px;
        }

        .form-header {
            padding: 25px 20px;
        }

        .form-header h1 {
            font-size: 24px;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }

        .teacher-id-display {
            flex-direction: column;
            text-align: center;
        }
    }
    
<style>
.alert {
    border: none;
    border-radius: 10px;
    margin-bottom: 1rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.alert-success {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    border-left: 4px solid #28a745;
    color: #155724;
}

.alert-danger {
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    border-left: 4px solid #dc3545;
    color: #721c24;
}

.alert-warning {
    background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
    border-left: 4px solid #ffc107;
    color: #856404;
}

.alert-info {
    background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
    border-left: 4px solid #17a2b8;
    color: #0c5460;
}

.alert-primary {
    background: linear-gradient(135deg, #d6d8db 0%, #c6c8ca 100%);
    border-left: 4px solid #007bff;
    color: #004085;
}

.alert ul {
    padding-left: 1.2rem;
}

.alert ul li {
    margin-bottom: 0.25rem;
}

.alert .fas {
    font-size: 1.1rem;
}

.btn-close {
    font-size: 0.875rem;
}

/* Auto-hide messages after 5 seconds */
.alert.auto-hide {
    animation: slideOut 0.5s ease-in-out 5s forwards;
}

@keyframes slideOut {
    0% { opacity: 1; transform: translateY(0); }
    100% { opacity: 0; transform: translateY(-20px); height: 0; margin: 0; padding: 0; }
}
</style>

</style>
@endsection

@section('content')
<div class="container">
    <div class="form-header">
        <div class="icon">
            <i class="fas fa-user-edit"></i>
        </div>
        <h1>Edit Teacher Information</h1>
        <p>Update the teacher's details below</p>
    </div>

    <div class="form-body">
        <div class="page-breadcrumb">
            <a href="{{ route('dashboard') }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <i class="fas fa-chevron-right"></i>
            <a href="{{ route('teachermanage') }}">Teachers</a>
            <i class="fas fa-chevron-right"></i>
            <span>Edit Teacher</span>
        </div>

        <!-- Teacher Info Display -->
        <div class="teacher-id-display">
            <div class="icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="info">
                <h3>{{ $teacher->first_name}} {{ $teacher->last_name  }}</h3>
                <p>Employee ID: {{ $teacher->employee_id  }} • {{ $teacher->department }} Department</p>
            </div>
        </div>

        <div class="info-badge">
            <i class="fas fa-info-circle"></i>
            Last updated: {{ $teacher->updated_at ? $teacher->updated_at->format('F j, Y \a\t g:i A') : 'November 15, 2024 at 2:30 PM' }}
        </div>

      {{-- Success Messages --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Error Messages --}}
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        <strong>Error!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Validation Errors --}}
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <div>
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Info Messages --}}
@if(session('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <i class="fas fa-info-circle me-2"></i>
        <strong>Info:</strong> {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Warning Messages --}}
@if(session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <strong>Warning:</strong> {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Teacher Updated Special Message --}}
@if(session('teacher_updated'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-user-check me-2"></i>
        <strong>Profile Updated!</strong> 
        The teacher profile has been successfully updated.
        @if(session('email_sent'))
            An email notification has been sent to the teacher.
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Email Notification Status --}}
@if(session('email_sent'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <i class="fas fa-envelope me-2"></i>
        <strong>Email Sent:</strong> Notification email has been sent successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('email_failed'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fas fa-envelope-open-text me-2"></i>
        <strong>Email Warning:</strong> Profile was updated successfully, but email notification could not be sent.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Bulk Operation Messages --}}
@if(session('bulk_success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-users me-2"></i>
        <strong>Bulk Operation:</strong> {{ session('bulk_success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Custom Status Messages --}}
@if(session('status'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <i class="fas fa-bell me-2"></i>
        <strong>Status:</strong> {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
            <form id="editTeacherForm" method="POST" action="{{ route('teacher.update', $teacher->id) }}">
            @csrf
            @method('PUT')
            
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
                            <input type="text" class="form-input" id="firstName" name="firstName" value="{{ old('firstName', $teacher->first_name ?? 'Sarah') }}" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required" for="lastName">Last Name</label>
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" class="form-input" id="lastName" name="lastName" value="{{ old('lastName', $teacher->last_name?? 'Johnson') }}" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required" for="email">Email Address</label>
                        <div class="input-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" class="form-input" id="email" name="email" value="{{ old('email', $teacher->email ?? 'sarah.johnson@school.edu') }}" required>
                        </div>
                        <div class="help-text">This is used for login credentials</div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required" for="phone">Phone Number</label>
                        <div class="input-icon">
                            <i class="fas fa-phone"></i>
                            <input type="tel" class="form-input" id="phone" name="phone" value="{{ old('phone', $teacher->phone ?? '(555) 123-4567') }}" required>
                        </div>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label class="form-label required" for="address">Address</label>
                    <textarea class="form-textarea" id="address" name="address" rows="3" placeholder="Enter full address..." required>{{ old('address', $teacher->address ?? '123 Oak Street, Springfield, IL 62701') }}</textarea>
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
                        <label class="form-label required" for="employeeId">Employee ID</label>
                        <div class="input-icon">
                            <i class="fas fa-id-badge"></i>
                            <input type="text" class="form-input" id="employeeId" name="employeeId" value="{{ $teacher->employeeId ?? 'TCH2024SJ001' }}" readonly>
                        </div>
                        <div class="help-text">Employee ID cannot be changed</div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required" for="department">Department</label>
                        <select class="form-select" id="department" name="department" required>
                            <option value="">Select Department</option>
                            @php
                                $departments = ['Mathematics', 'Science', 'English', 'History', 'Computer Science', 'Physical Education', 'Art', 'Music', 'Languages', 'Social Studies'];
                                $selectedDepartment = old('department', $teacher->department ?? 'Mathematics');
                            @endphp
                            @foreach($departments as $dept)
                                <option value="{{ $dept }}" {{ $selectedDepartment == $dept ? 'selected' : '' }}>{{ $dept }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required" for="joinDate">Joining Date</label>
                        <input type="date" class="form-input" id="joinDate" name="joinDate" value="{{ old('joinDate', $teacher->joinDate ?? '2020-08-15') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label required" for="salary">Salary</label>
                        <div class="input-icon">
                            <i class="fas fa-dollar-sign"></i>
                            <input type="number" class="form-input" id="salary" name="salary" value="{{ old('salary', $teacher->salary ?? '65000.00') }}" step="0.01" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="experience">Years of Experience</label>
                        <div class="input-icon">
                            <i class="fas fa-calendar-check"></i>
                            <input type="number" class="form-input" id="experience" name="experience" value="{{ old('experience', $teacher->experience ?? '8') }}" min="0">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="status">Employment Status</label>
                        <select class="form-select" id="status" name="status">
                            @php
                                $statuses = ['Active', 'Inactive', 'On Leave', 'Suspended'];
                                $selectedStatus = old('status', $teacher->status ?? 'Active');
                            @endphp
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" {{ $selectedStatus == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label class="form-label" for="qualification">Qualifications</label>
                    <textarea class="form-textarea" id="qualification" name="qualification" rows="3" placeholder="Enter educational qualifications and certifications...">{{ old('qualification', $teacher->qualification ?? "Master's in Mathematics Education, University of Illinois (2015)\nBachelor's in Mathematics, Springfield College (2012)\nCertified Secondary Mathematics Teacher") }}</textarea>
                </div>
            </div>

            <!-- Account Settings Section -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="fas fa-cog"></i>
                    Account Settings
                </h3>
                
                <div class="checkbox-group">
                        <input type="hidden" name="accountActive" value="0">

                    <label class="custom-checkbox">
                        <input type="checkbox" id="resetPassword" name="resetPassword" value="1"{{ old('resetPassword') ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                    </label>
                    <label for="resetPassword" class="form-label">Reset Password</label>
                    <div class="help-text">Generate a new password and send it to the teacher's email</div>
                </div>

                <!-- Account Active -->
<div class="checkbox-group">
    <!-- Hidden fallback when unchecked -->
    <input type="hidden" name="accountActive" value="0">

    <label class="custom-checkbox">
        <input type="checkbox" id="accountActive" name="accountActive" value="1"
            {{ old('accountActive', $teacher->status ?? true) ? 'checked' : '' }}>
        <span class="checkmark"></span>
    </label>
    <label for="accountActive" class="form-label">Account Active</label>
    <div class="help-text">Allow the teacher to access their account</div>
</div>

<!-- Send Notification -->
<div class="checkbox-group">
    <!-- Hidden fallback when unchecked -->
    <input type="hidden" name="sendNotification" value="0">

    <label class="custom-checkbox">
        <input type="checkbox" id="sendNotification" name="sendNotification" value="1"
            {{ old('sendNotification', true) ? 'checked' : '' }}>
        <span class="checkmark"></span>
    </label>
    <label for="sendNotification" class="form-label">Send Update Notification</label>
    <div class="help-text">Notify the teacher about the changes made to their profile</div>
</div>

            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                    <i class="fas fa-trash"></i>
                    Delete Teacher
                </button>
                <button type="button" class="btn btn-secondary" onclick="cancelEdit()">
                    <i class="fas fa-times"></i>
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save"></i>
                    Update Teacher
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <i class="fas fa-exclamation-triangle icon"></i>
        <h3>Delete Teacher</h3>
        <p>Are you sure you want to delete {{ $teacher->first_name ?? 'Sarah' }} {{ $teacher->last_name ?? 'Johnson' }}? This action cannot be undone.</p>
        <div class="modal-actions">
            <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">
                <i class="fas fa-times"></i>
                Cancel
            </button>
           <!-- Delete Form - Removed the onclick confirm -->
        <form action="{{ route('teacher.destroy', $teacher->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i>
                Delete
            </button>
        </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Form functionality
    document.getElementById('editTeacherForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        
        // Show loading state
        submitBtn.classList.add('loading');
        submitBtn.innerHTML = '<div class="spinner"></div> Updating...';
        
        // Form will submit normally, loading state will persist until page reload
    });

    function cancelEdit() {
        if (confirm('Are you sure you want to cancel? Any unsaved changes will be lost.')) {
            window.history.back();
        }
    }

    function confirmDelete() {
        document.getElementById('deleteModal').classList.add('show');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('show');
    }

    // Close modal when clicking outside
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });

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

    // Track form changes
    let hasUnsavedChanges = false;
    const form = document.getElementById('editTeacherForm');
    const originalFormData = new FormData(form);

    form.addEventListener('change', function() {
        hasUnsavedChanges = true;
    });

    // Warn about unsaved changes
    window.addEventListener('beforeunload', function(e) {
        if (hasUnsavedChanges) {
            e.preventDefault();
            e.returnValue = 'You have unsaved changes. Are you sure you want to leave?';
        }
    });

    // Reset unsaved changes flag on successful submit
    form.addEventListener('submit', function() {
        hasUnsavedChanges = false;
    });

    // Status change warning
    document.getElementById('status').addEventListener('change', function(e) {
        if (e.target.value === 'Inactive' || e.target.value === 'Suspended') {
            if (confirm('Changing status to "' + e.target.value + '" will prevent the teacher from accessing their account. Continue?')) {
                document.getElementById('accountActive').checked = false;
            } else {
                e.target.value = 'Active';
            }
        }
    });

    // Account active checkbox interaction
    document.getElementById('accountActive').addEventListener('change', function(e) {
        const statusSelect = document.getElementById('status');
        if (!e.target.checked && statusSelect.value === 'Active') {
            if (confirm('Deactivating the account will change the employment status. Continue?')) {
                statusSelect.value = 'Inactive';
            } else {
                e.target.checked = true;
            }
        } else if (e.target.checked && statusSelect.value !== 'Active') {
            if (confirm('Activating the account will change the employment status to Active. Continue?')) {
                statusSelect.value = 'Active';
            }
        }
    });

    // Auto-hide success/error messages after 5 seconds
    document.addEventListener("DOMContentLoaded", function () {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = 0;
                setTimeout(() => {
                    if (alert.parentNode) {
                        alert.remove();
                    }
                }, 500);
            }, 5000);
        });
    });

    // Form validation styling
    document.querySelectorAll('.form-input, .form-select, .form-textarea').forEach(input => {
        input.addEventListener('invalid', function(e) {
            e.target.style.borderColor = '#e53e3e';
        });
        
        input.addEventListener('input', function(e) {
            if (e.target.checkValidity()) {
                e.target.style.borderColor = '#48bb78';
            } else {
                e.target.style.borderColor = '#e53e3e';
            }
        });
    });

    // Delete form submission with loading state
    document.querySelector('#deleteModal form').addEventListener('submit', function(e) {
        const deleteBtn = document.getElementById('deleteBtn');
        deleteBtn.innerHTML = '<div class="spinner"></div> Deleting...';
        deleteBtn.disabled = true;
    });

    // Update teacher display info when names change
    document.getElementById('firstName').addEventListener('input', updateTeacherDisplay);
    document.getElementById('lastName').addEventListener('input', updateTeacherDisplay);
    document.getElementById('department').addEventListener('change', updateTeacherDisplay);

    function updateTeacherDisplay() {
        const firstName = document.getElementById('firstName').value;
        const lastName = document.getElementById('lastName').value;
        const department = document.getElementById('department').value;
        const employeeId = document.getElementById('employeeId').value;
        
        const nameDisplay = document.querySelector('.teacher-id-display .info h3');
        const infoDisplay = document.querySelector('.teacher-id-display .info p');
        
        if (firstName || lastName) {
            nameDisplay.textContent = `${firstName} ${lastName}`.trim();
        }
        
        if (employeeId || department) {
            infoDisplay.textContent = `Employee ID: ${employeeId} • ${department} Department`;
        }
    }
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide success messages after 5 seconds
    const successAlerts = document.querySelectorAll('.alert-success, .alert-info');
    successAlerts.forEach(function(alert) {
        setTimeout(function() {
            if (alert && alert.parentNode) {
                alert.classList.add('auto-hide');
                setTimeout(function() {
                    if (alert && alert.parentNode) {
                        alert.remove();
                    }
                }, 500);
            }
        }, 5000);
    });
});
</script>
@endpush