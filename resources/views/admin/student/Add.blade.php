@extends('layouts.app')

@section('title', 'Add Student - EduManage')

@section('page-title', 'Add New Student')

@section('breadcrumb', 'Home / User Management / Students / Add Students')

@section('styles')
<style>
    .form-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        max-width: 1200px;
        margin: 0 auto;
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

    .form-body {
        padding: 30px;
    }

    .form-section {
        margin-bottom: 35px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: #667eea;
        font-size: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #374151;
        font-size: 14px;
    }

    .required {
        color: #ef4444;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #fafafa;
    }

    .form-control:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-control.is-invalid {
        border-color: #ef4444;
    }

    .form-control:valid {
        border-color: #10b981;
    }

    .form-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 12px center;
        background-repeat: no-repeat;
        background-size: 16px;
        padding-right: 40px;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .photo-upload {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }

    .photo-preview {
        width: 120px;
        height: 120px;
        border-radius: 15px;
        border: 3px dashed #d1d5db;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f9fafb;
        transition: all 0.3s ease;
        cursor: pointer;
        overflow: hidden;
    }

    .photo-preview:hover {
        border-color: #667eea;
        background: #f0f4ff;
    }

    .photo-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
    }

    .photo-placeholder {
        text-align: center;
        color: #6b7280;
    }

    .photo-placeholder i {
        font-size: 24px;
        margin-bottom: 5px;
        display: block;
    }

    .btn-upload {
        background: #667eea;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-upload:hover {
        background: #5a67d8;
        transform: translateY(-1px);
    }

    .form-actions {
        display: flex;
        gap: 15px;
        justify-content: center;
        padding-top: 20px;
        border-top: 2px solid #e5e7eb;
        margin-top: 30px;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary {
        background: #667eea;
        color: white;
    }

    .btn-primary:hover {
        background: #5a67d8;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-secondary {
        background: #6b7280;
        color: white;
    }

    .btn-secondary:hover {
        background: #4b5563;
        transform: translateY(-2px);
    }

    .btn-info {
        background: #06b6d4;
        color: white;
    }

    .btn-info:hover {
        background: #0891b2;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(6, 182, 212, 0.3);
    }

    .alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-success {
        background: #d1fae5;
        color: #065f46;
        border-left: 4px solid #10b981;
    }

    .alert-error {
        background: #fee2e2;
        color: #991b1b;
        border-left: 4px solid #ef4444;
    }

    .help-text {
        font-size: 12px;
        color: #6b7280;
        margin-top: 5px;
    }

    .input-group {
        position: relative;
    }

    .input-group-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 16px;
        z-index: 1;
    }

    .input-group .form-control {
        padding-left: 45px;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(5px);
        animation: fadeIn 0.3s ease-out;
    }

    .modal.show {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideIn {
        from { 
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.9);
        }
        to { 
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
    }

    .modal-content {
        background-color: #fefefe;
        border-radius: 15px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        width: 90%;
        max-width: 900px;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
        animation: slideIn 0.3s ease-out;
    }

    .modal-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px 30px;
        border-radius: 15px 15px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header h5 {
        margin: 0;
        font-size: 20px;
        font-weight: 600;
    }

    .close {
        color: white;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        border: none;
        background: none;
        opacity: 0.8;
        transition: opacity 0.3s ease;
    }

    .close:hover {
        opacity: 1;
    }

    .modal-body {
        padding: 30px;
    }

    .preview-section {
        margin-bottom: 30px;
        background: #f8fafc;
        border-radius: 12px;
        padding: 20px;
        border-left: 4px solid #667eea;
    }

    .preview-section h6 {
        color: #667eea;
        font-weight: 600;
        margin-bottom: 15px;
        font-size: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .preview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }

    .preview-item {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .preview-item strong {
        color: #374151;
        font-size: 12px;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .preview-item span {
        color: #1f2937;
        font-size: 14px;
        padding: 8px 12px;
        background: white;
        border-radius: 6px;
        border: 1px solid #e5e7eb;
    }

    .modal-footer {
        padding: 20px 30px;
        border-top: 2px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        gap: 15px;
        border-radius: 0 0 15px 15px;
        background: #f9fafb;
    }

    .student-photo-preview {
        text-align: center;
        margin-bottom: 20px;
    }

    .student-photo-preview img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #667eea;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .photo-placeholder-small {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        color: #9ca3af;
        border: 2px dashed #d1d5db;
    }

    @media (max-width: 768px) {
        .form-body {
            padding: 20px;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }

        .modal-content {
            width: 95%;
            margin: 10px;
        }

        .modal-footer {
            flex-direction: column;
        }

        .preview-grid {
            grid-template-columns: 1fr;
        }
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
     /* Container for messages */
.alert {
    padding: 15px 20px;
    border-radius: 8px;
    margin: 15px 0;
    font-family: 'Segoe UI', sans-serif;
    font-size: 15px;
    position: relative;
    transition: all 0.3s ease;
}

/* Success */
.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

/* Error */
.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* Validation warning */
.alert-warning {
    background-color: #fff3cd;
    color: #856404;
    border: 1px solid #ffeeba;
}

/* Close button */
.alert .close-btn {
    position: absolute;
    top: 10px;
    right: 15px;
    background: none;
    border: none;
    font-size: 20px;
    color: inherit;
    cursor: pointer;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <!-- Main Form -->
            <div class="form-container">
                 @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
        <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
        <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-warning">
        <strong>Whoops!</strong> Please fix the following:
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
    </div>
@endif


                 <div class="form-header">
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h4></i> Add New Student</h4>
                        <p>Enter student information to create a new account</p>
                 </div>

                <div class="breadcrumb">
            <a href="{{route('dashboard')}}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <i class="fas fa-chevron-right"></i>
            <a href="{{route('studentmanage')}}">Students</a>
            <i class="fas fa-chevron-right"></i>
            <span>Add Studentsr</span>
        </div>

                <div class="form-body">
                    <form action="{{ route('create.student') }}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        
                        <!-- Basic Information -->
                        <div class="form-section">
                            <h5 class="section-title">
                                <i class="fas fa-user"></i>
                                Basic Information
                            </h5>

                            <!-- Photo Upload -->
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Student Photo</label>
                                    <div class="photo-upload">
                                        <div class="photo-preview" onclick="document.getElementById('photo').click()">
                                            <div class="photo-placeholder">
                                                <i class="fas fa-camera"></i>
                                                <small>Click to upload</small>
                                            </div>
                                        </div>
                                        <input type="file" id="photo" name="photo" accept="image/*" style="display: none;" onchange="previewPhoto(this)">
                                        <button type="button" class="btn-upload" onclick="document.getElementById('photo').click()">
                                            <i class="fas fa-upload"></i> Choose Photo
                                        </button>
                                        <p class="help-text">Max size: 2MB (JPG, PNG)</p>
                                    </div>
                                </div>

                                <div style="flex: 2;">
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">First Name <span class="required">*</span></label>
                                            <div class="input-group">
                                                <i class="input-group-icon fas fa-user"></i>
                                                <input type="text" class="form-control" name="first_name" id="first_name" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Last Name <span class="required">*</span></label>
                                            <div class="input-group">
                                                <i class="input-group-icon fas fa-user"></i>
                                                <input type="text" class="form-control" name="last_name" id="last_name" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">Email Address <span class="required">*</span></label>
                                            <div class="input-group">
                                                <i class="input-group-icon fas fa-envelope"></i>
                                                <input type="email" class="form-control" name="email" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Phone Number</label>
                                            <div class="input-group">
                                                <i class="input-group-icon fas fa-phone"></i>
                                                <input type="tel" class="form-control" name="phone">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Date of Birth <span class="required">*</span></label>
                                    <div class="input-group">
                                        <i class="input-group-icon fas fa-calendar"></i>
                                        <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Gender <span class="required">*</span></label>
                                    <select class="form-control form-select" name="gender" required>
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Blood Group</label>
                                    <select class="form-control form-select" name="blood_group">
                                        <option value="">Select Blood Group</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Address</label>
                                <div class="input-group">
                                    <i class="input-group-icon fas fa-map-marker-alt"></i>
                                    <textarea class="form-control" name="address" rows="3" placeholder="Enter full address"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Academic Information -->
                        <div class="form-section">
                            <h5 class="section-title">
                                <i class="fas fa-graduation-cap"></i>
                                Academic Information
                            </h5>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Student ID <span class="required">*</span></label>
                                    <div class="input-group">
                                        <i class="input-group-icon fas fa-id-card"></i>
                                        <input type="text" class="form-control" name="student_id" id="student_id" readonly>
                                    </div>
                                    <p class="help-text">Auto-generated based on name and date of birth</p>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Class <span class="required">*</span></label>
                                    <select class="form-control form-select" name="class_id" required>
                                         <option value="">
                                                       Select Class
                                                    </option>
                                        @foreach($classes as $class)
                                                    <option value="{{ $class->id }}">
                                                        Class {{ $class->name }}{{ $class->section ? ' - ' . $class->section : '' }}
                                                    </option>
                                                @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Roll Number <span class="required">*</span></label>
                                    <div class="input-group">
                                        <i class="input-group-icon fas fa-hashtag"></i>
                                        <input type="number" class="form-control" name="roll_number" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Admission Date <span class="required">*</span></label>
                                    <div class="input-group">
                                        <i class="input-group-icon fas fa-calendar-plus"></i>
                                        <input type="date" class="form-control" name="admission_date" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Academic Year <span class="required">*</span></label>
                                    <select class="form-control form-select" name="academic_year" required>
                                        <option value="">Select Academic Year</option>
                                        <option value="2023-2024">2023-2024</option>
                                        <option value="2024-2025">2024-2025</option>
                                        <option value="2025-2026">2025-2026</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select class="form-control form-select" name="status">
                                        <option value="active" selected>Active</option>
                                        <option value="inactive">Inactive</option>
                                        <option value="suspended">Suspended</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Guardian Information -->
                        <div class="form-section">
                            <h5 class="section-title">
                                <i class="fas fa-users"></i>
                                Guardian Information
                            </h5>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Guardian Name <span class="required">*</span></label>
                                    <div class="input-group">
                                        <i class="input-group-icon fas fa-user-tie"></i>
                                        <input type="text" class="form-control" name="guardian_name" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Relationship <span class="required">*</span></label>
                                    <select class="form-control form-select" name="guardian_relationship" required>
                                        <option value="">Select Relationship</option>
                                        <option value="father">Father</option>
                                        <option value="mother">Mother</option>
                                        <option value="grandfather">Grandfather</option>
                                        <option value="grandmother">Grandmother</option>
                                        <option value="uncle">Uncle</option>
                                        <option value="aunt">Aunt</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Guardian Phone <span class="required">*</span></label>
                                    <div class="input-group">
                                        <i class="input-group-icon fas fa-mobile-alt"></i>
                                        <input type="tel" class="form-control" name="guardian_phone" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Guardian Email</label>
                                    <div class="input-group">
                                        <i class="input-group-icon fas fa-envelope"></i>
                                        <input type="email" class="form-control" name="guardian_email">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Guardian Occupation</label>
                                    <div class="input-group">
                                        <i class="input-group-icon fas fa-briefcase"></i>
                                        <input type="text" class="form-control" name="guardian_occupation">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Account Settings -->
                        <div class="form-section">
                            <h5 class="section-title">
                                <i class="fas fa-key"></i>
                                Account Settings
                            </h5>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Password <span class="required">*</span></label>
                                    <div class="input-group">
                                        <i class="input-group-icon fas fa-lock"></i>
                                        <input type="password" class="form-control" name="password" required minlength="8">
                                    </div>
                                    <p class="help-text">Minimum 8 characters</p>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Confirm Password <span class="required">*</span></label>
                                    <div class="input-group">
                                        <i class="input-group-icon fas fa-lock"></i>
                                        <input type="password" class="form-control" name="password_confirmation" required minlength="8">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" style="display: flex; align-items: center; gap: 10px;">
                                    <input type="checkbox" name="send_credentials" value="1" style="margin: 0;">
                                    Send login credentials via email
                                </label>
                                <p class="help-text">Student and guardian will receive login details via email</p>
                            </div>
                        </div>

                        <!-- Form Actions -->
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-info">
                                        <i class="fas fa-eye"></i>
                                        Submit Form
                                    </button>
                                    <button type="reset" class="btn btn-secondary">
                                        <i class="fas fa-undo"></i>
                                        Reset Form
                                    </button>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
// Auto-generate student ID based on name and DOB
function generateStudentID() {
    const firstNameElement = document.getElementById('first_name');
    const lastNameElement = document.getElementById('last_name');
    const dobElement = document.getElementById('date_of_birth');
    const studentIdElement = document.getElementById('student_id');

    if (!firstNameElement || !lastNameElement || !dobElement || !studentIdElement) {
        return;
    }

    const firstName = firstNameElement.value.trim();
    const lastName = lastNameElement.value.trim();
    const dob = dobElement.value;

    if (firstName && lastName && dob) {
        try {
            const firstInitial = firstName.charAt(0).toUpperCase();
            const lastInitial = lastName.charAt(0).toUpperCase();
            const dobDate = new Date(dob);
            
            if (isNaN(dobDate.getTime())) {
                return;
            }
            
            const year = dobDate.getFullYear().toString().slice(-2);
            const month = (dobDate.getMonth() + 1).toString().padStart(2, '0');
            const day = dobDate.getDate().toString().padStart(2, '0');
            
            const randomNum = Math.floor(Math.random() * 900) + 100;
            const studentId = `${firstInitial}${lastInitial}${year}${month}${day}${randomNum}`;
            
            studentIdElement.value = studentId;
        } catch (error) {
            console.log('Error generating student ID:', error);
        }
    }
}

// Enhanced photo preview with validation
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        if (!validateFileUpload(file)) {
            input.value = ''; // Clear the input
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.querySelector('.photo-preview');
            if (preview) {
                preview.innerHTML = `<img src="${e.target.result}" alt="Student Photo">`;
                preview.classList.add('has-image');
            }
        };
        reader.readAsDataURL(file);
    }
}

// Validate file upload
function validateFileUpload(file) {
    const maxSize = 2 * 1024 * 1024; // 2MB
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    
    if (file.size > maxSize) {
        showAlert('error', 'File size must be less than 2MB');
        return false;
    }
    
    if (!allowedTypes.includes(file.type)) {
        showAlert('error', 'Only JPG and PNG files are allowed');
        return false;
    }
    
    return true;
}

// Submit form to preview page

// Form validation function
function validateForm() {
    const form = document.getElementById('addStudentForm');
    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;
    let firstInvalidField = null;

    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            if (!firstInvalidField) {
                firstInvalidField = field;
            }
            isValid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    });

    // Validate password confirmation
    const password = document.querySelector('input[name="password"]');
    const confirmPassword = document.querySelector('input[name="password_confirmation"]');
    
    if (password && confirmPassword && password.value !== confirmPassword.value) {
        confirmPassword.classList.add('is-invalid');
        showAlert('error', 'Passwords do not match!');
        isValid = false;
    }

    // Validate email format
    const emailField = document.querySelector('input[name="email"]');
    if (emailField && emailField.value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailField.value)) {
            emailField.classList.add('is-invalid');
            showAlert('error', 'Please enter a valid email address!');
            isValid = false;
        }
    }

    // Validate student ID uniqueness (this would typically be done server-side)
    const studentIdField = document.getElementById('student_id');
    if (studentIdField && !studentIdField.value.trim()) {
        studentIdField.classList.add('is-invalid');
        showAlert('error', 'Student ID is required!');
        isValid = false;
    }

    // Validate roll number is positive
    const rollNumberField = document.querySelector('input[name="roll_number"]');
    if (rollNumberField && rollNumberField.value && parseInt(rollNumberField.value) <= 0) {
        rollNumberField.classList.add('is-invalid');
        showAlert('error', 'Roll number must be a positive number!');
        isValid = false;
    }

    // Validate date of birth (not in future)
    const dobField = document.querySelector('input[name="date_of_birth"]');
    if (dobField && dobField.value) {
        const dobDate = new Date(dobField.value);
        const today = new Date();
        if (dobDate >= today) {
            dobField.classList.add('is-invalid');
            showAlert('error', 'Date of birth cannot be in the future!');
            isValid = false;
        }
    }

    // Validate admission date (not in future)
    const admissionField = document.querySelector('input[name="admission_date"]');
    if (admissionField && admissionField.value) {
        const admissionDate = new Date(admissionField.value);
        const today = new Date();
        today.setHours(23, 59, 59, 999); // Allow today
        if (admissionDate > today) {
            admissionField.classList.add('is-invalid');
            showAlert('error', 'Admission date cannot be in the future!');
            isValid = false;
        }
    }

    if (!isValid && firstInvalidField) {
        firstInvalidField.focus();
        firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        // Restore button state
        const previewButton = document.querySelector('.btn-info');
        if (previewButton) {
            previewButton.disabled = false;
            previewButton.innerHTML = '<i class="fas fa-eye"></i> Preview & Confirm';
        }
    }

    return isValid;
}

// Show alert messages
function showAlert(type, message) {
    const alertId = type === 'success' ? 'successAlert' : 'errorAlert';
    const messageId = type === 'success' ? 'successMessage' : 'errorMessage';
    
    const alertElement = document.getElementById(alertId);
    const messageElement = document.getElementById(messageId);
    
    if (alertElement && messageElement) {
        messageElement.textContent = message;
        alertElement.style.display = 'flex';
        
        // Hide other alert types
        const otherAlertId = type === 'success' ? 'errorAlert' : 'successAlert';
        const otherAlert = document.getElementById(otherAlertId);
        if (otherAlert) {
            otherAlert.style.display = 'none';
        }
        
        // Auto-hide success messages after 5 seconds
        if (type === 'success') {
            setTimeout(() => {
                alertElement.style.display = 'none';
            }, 5000);
        }
        
        // Scroll to top to show alert
        alertElement.scrollIntoView({ behavior: 'smooth' });
    }
}

// Auto-format phone numbers
function formatPhoneNumber(input) {
    let value = input.value.replace(/\D/g, '');
    if (value.length >= 10) {
        value = value.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
    }
    input.value = value;
}

// Real-time validation feedback
function setupRealTimeValidation() {
    // Email validation
    const emailField = document.querySelector('input[name="email"]');
    if (emailField) {
        emailField.addEventListener('blur', function() {
            if (this.value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (emailRegex.test(this.value)) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else {
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');
                }
            }
        });
    }

    // Password strength indicator
    const passwordField = document.querySelector('input[name="password"]');
    if (passwordField) {
        passwordField.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            this.classList.remove('is-invalid', 'is-valid');
            if (password.length > 0) {
                if (strength >= 3) {
                    this.classList.add('is-valid');
                } else {
                    this.classList.add('is-invalid');
                }
            }
        });
    }

    // Required field validation
    const requiredFields = document.querySelectorAll('[required]');
    requiredFields.forEach(field => {
        field.addEventListener('blur', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            } else {
                this.classList.add('is-invalid');
                this.classList.remove('is-valid');
            }
        });
    });
}

// Initialize all functionality when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Set default admission date to today
    const admissionDateField = document.querySelector('input[name="admission_date"]');
    if (admissionDateField) {
        const today = new Date().toISOString().split('T')[0];
        admissionDateField.value = today;
    }
    
    // Setup Student ID generation with a small delay to ensure elements are loaded
    setTimeout(() => {
        const firstNameInput = document.getElementById('first_name');
        const lastNameInput = document.getElementById('last_name');
        const dobInput = document.getElementById('date_of_birth');
        
        if (firstNameInput && lastNameInput && dobInput) {
            firstNameInput.addEventListener('input', generateStudentID);
            lastNameInput.addEventListener('input', generateStudentID);
            dobInput.addEventListener('change', generateStudentID);
        }
        
        // Setup phone number formatting
        const phoneInputs = document.querySelectorAll('input[type="tel"]');
        phoneInputs.forEach(input => {
            input.addEventListener('input', () => formatPhoneNumber(input));
        });
        
        // Setup password confirmation validation
        const confirmPasswordField = document.querySelector('input[name="password_confirmation"]');
        const passwordField = document.querySelector('input[name="password"]');
        
        if (confirmPasswordField && passwordField) {
            confirmPasswordField.addEventListener('input', function() {
                if (this.value && passwordField.value && this.value !== passwordField.value) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });
        }
        
        // Setup real-time validation
        setupRealTimeValidation();
        
    }, 100);
    
    // Setup reset button functionality
    const resetButton = document.querySelector('button[type="reset"]');
    if (resetButton) {
        resetButton.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to reset the form? All entered data will be lost.')) {
                e.preventDefault();
                return;
            }
            
            // Clear photo preview
            const photoPreview = document.querySelector('.photo-preview');
            if (photoPreview) {
                photoPreview.innerHTML = `
                    <div class="photo-placeholder">
                        <i class="fas fa-camera"></i>
                        <small>Click to upload</small>
                    </div>
                `;
            }
            
            // Clear all validation states
            const invalidFields = document.querySelectorAll('.is-invalid, .is-valid');
            invalidFields.forEach(field => {
                field.classList.remove('is-invalid', 'is-valid');
            });
            
            // Clear alerts
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => alert.style.display = 'none');
        });
    }
    
    // Auto-hide alerts after page load
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            if (alert.style.display !== 'none') {
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 5000);
            }
        });
    }, 100);
});
    
</script>
@endsection