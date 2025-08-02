@extends('layouts.app')

@section('title', 'Update Student - EduManage')

@section('page-title', 'Update Student Information')

@section('breadcrumb', 'Home / User Management / Students / Update Student')

@section('styles')
<style>
    /* Fixed CSS with corrected issues */
    .form-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        max-width: 1200px;
        margin: 0 auto;
    }

    .form-header {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        color: white;
        padding: 20px 30px;
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
        background: url('data:image/svg+xml;charset=utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" opacity="0.1"><polygon points="0,100 1000,0 1000,100"/></svg>');
        background-size: cover;
    }

    .form-header h1, .form-header h4 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 8px;
        position: relative;
        z-index: 2;
    }

    .form-header p {
        font-size: 14px;
        opacity: 0.9;
        position: relative;
        z-index: 2;
        margin: 0;
    }

    .form-header .icon {
        font-size: 36px;
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
        color: #f39c12;
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
        border-color: #f39c12;
        background: white;
        box-shadow: 0 0 0 3px rgba(243, 156, 18, 0.1);
    }

    .form-control.is-invalid {
        border-color: #ef4444;
        background-color: #fef2f2;
    }

    .form-control.is-valid {
        border-color: #10b981;
        background-color: #f0fdf4;
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

    /* Fixed photo upload section */
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
        border-color: #f39c12;
        background: #fef7e7;
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

    .current-photo {
        text-align: center;
        margin-bottom: 15px;
    }

    .current-photo img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #f39c12;
        box-shadow: 0 4px 12px rgba(243, 156, 18, 0.2);
    }

    .no-photo {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        color: #9ca3af;
        border: 2px dashed #d1d5db;
        font-size: 24px;
    }

    /* Button styles */
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
        justify-content: center;
    }

    .btn-upload {
        background: #f39c12;
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
        background: #e67e22;
        transform: translateY(-1px);
    }

    .btn-remove-photo {
        background: #ef4444;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 11px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-remove-photo:hover {
        background: #dc2626;
    }

    .btn-primary {
        background: #f39c12;
        color: white;
    }

    .btn-primary:hover {
        background: #e67e22;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3);
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

    .btn-danger {
        background: #ef4444;
        color: white;
    }

    .btn-danger:hover {
        background: #dc2626;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(239, 68, 68, 0.3);
    }

    .form-actions {
        display: flex;
        gap: 15px;
        justify-content: center;
        padding-top: 20px;
        border-top: 2px solid #e5e7eb;
        margin-top: 30px;
        flex-wrap: wrap;
    }

    /* Alert styles */
    .alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        position: relative;
    }

    .alert-success {
        background: #d1fae5;
        color: #065f46;
        border-left: 4px solid #10b981;
    }

    .alert-danger {
        background: #fee2e2;
        color: #991b1b;
        border-left: 4px solid #ef4444;
    }

    .alert-warning {
        background: #fff3cd;
        color: #856404;
        border-left: 4px solid #f59e0b;
    }

    .alert ul {
        margin: 0;
        padding-left: 20px;
    }

    .close-btn {
        position: absolute;
        top: 10px;
        right: 15px;
        background: none;
        border: none;
        font-size: 20px;
        color: inherit;
        cursor: pointer;
        opacity: 0.7;
    }

    .close-btn:hover {
        opacity: 1;
    }

    /* Student info card */
    .student-info-card {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 25px;
        border-left: 5px solid #f39c12;
    }

    .student-info-card h5 {
        color: #2d3748;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .info-item strong {
        color: #4a5568;
        font-size: 12px;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .info-item span {
        color: #2d3748;
        font-size: 14px;
        padding: 8px 12px;
        background: white;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
    }

    /* Badge styles */
    .badge {
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-success {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-secondary {
        background: #f3f4f6;
        color: #4b5563;
    }

    /* Password section */
    .password-section {
        background: #fef7e7;
        border-radius: 10px;
        padding: 20px;
        border-left: 4px solid #f39c12;
    }

    .password-section h6 {
        color: #92400e;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .password-help {
        background: #dbeafe;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 15px;
        font-size: 13px;
        color: #1e40af;
    }

    /* Input group styles */
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

    /* Breadcrumb */
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 25px;
        font-size: 13px;
        color: #718096;
        padding: 15px 30px;
        background: #f8f9fa;
        border-bottom: 1px solid #e2e8f0;
    }

    .breadcrumb a {
        color: #f39c12;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb a:hover {
        color: #e67e22;
    }

    .breadcrumb i {
        font-size: 11px;
    }

    .help-text {
        font-size: 12px;
        color: #6b7280;
        margin-top: 5px;
    }

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(5px);
    }

    .modal.show {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background: white;
        border-radius: 15px;
        width: 90%;
        max-width: 800px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        padding: 20px 30px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f8f9fa;
        border-radius: 15px 15px 0 0;
    }

    .modal-header h5 {
        margin: 0;
        color: #2d3748;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .modal-header .close {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #6b7280;
    }

    .modal-body {
        padding: 30px;
    }

    .modal-footer {
        padding: 20px 30px;
        border-top: 1px solid #e2e8f0;
        display: flex;
        gap: 15px;
        justify-content: center;
        background: #f8f9fa;
        border-radius: 0 0 15px 15px;
    }

    .preview-section {
        margin-bottom: 30px;
    }

    .preview-section h6 {
        color: #2d3748;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 10px;
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
        color: #4a5568;
        font-size: 12px;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .preview-item span {
        color: #2d3748;
        font-size: 14px;
        padding: 8px 12px;
        background: #f8f9fa;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
    }

    .student-photo-preview {
        text-align: center;
        margin-bottom: 20px;
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
        font-size: 24px;
    }

    /* Responsive design */
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

        .info-grid {
            grid-template-columns: 1fr;
        }

        .preview-grid {
            grid-template-columns: 1fr;
        }

        .modal-content {
            width: 95%;
            margin: 10px;
        }

        .modal-body {
            padding: 20px;
        }

        .breadcrumb {
            padding: 10px 20px;
        }
    }

    @media (max-width: 480px) {
        .form-container {
            margin: 10px;
            border-radius: 10px;
        }

        .form-header {
            padding: 20px;
        }

        .form-header .icon {
            font-size: 28px;
        }

        .form-header h4 {
            font-size: 20px;
        }

        .section-title {
            font-size: 16px;
        }

        .modal-header, .modal-footer {
            padding: 15px 20px;
        }
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
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                        <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ session('error') }}
                        <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-warning">
                        <div>
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Whoops!</strong> Please fix the following:
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
                    </div>
                @endif

                <div class="form-header">
                    <div class="icon">
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <h4>Update Student Information</h4>
                    <p>Modify student details and account settings</p>
                </div>

                <div class="breadcrumb">
                    <a href="{{route('dashboard')}}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <i class="fas fa-chevron-right"></i>
                    <a href="{{route('studentmanage')}}">Students</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Update Student</span>
                </div>

                <!-- Current Student Info Card -->
                <div class="student-info-card">
                    <h5><i class="fas fa-info-circle"></i> Current Student Information</h5>
                    <div class="info-grid">
                        <div class="info-item">
                            <strong>Student ID</strong>
                            <span>{{ $student->student_id ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <strong>Full Name</strong>
                            <span>{{ $student->first_name ?? '' }} {{ $student->last_name ?? '' }}</span>
                        </div>
                        <div class="info-item">
                            <strong>Class</strong>
                            <span>{{ $student->class->name ?? 'N/A' }}{{ $student->class->section ? ' - ' . $student->class->section : '' }}</span>
                        </div>
                        <div class="info-item">
                            <strong>Status</strong>
                            <span class="badge badge-{{ $student->status === 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($student->status ?? 'N/A') }}
                            </span>
                        </div>
                        <div class="info-item">
                            <strong>Last Updated</strong>
                            <span>{{ $student->updated_at ? $student->updated_at->format('M d, Y H:i') : 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <div class="form-body">
                    <form action="{{ route('update.student', $student->id) }}" method="POST" enctype="multipart/form-data" id="updateStudentForm">
                        @csrf
                        @method('PUT')
                        
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
                                        <div class="current-photo">
                                            @if($student->photo)
                                                <img src="{{ asset('storage/' . $student->photo) }}" alt="Current Photo" id="currentPhoto">
                                            @else
                                                <div class="no-photo">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="photo-preview" onclick="document.getElementById('photo').click()" style="display: none;">
                                            <div class="photo-placeholder">
                                                <i class="fas fa-camera"></i>
                                                <small>New photo preview</small>
                                            </div>
                                        </div>
                                        <input type="file" id="photo" name="photo" accept="image/*" style="display: none;" onchange="previewPhoto(this)">
                                        <div style="display: flex; gap: 10px; flex-wrap: wrap; justify-content: center;">
                                            <button type="button" class="btn-upload" onclick="document.getElementById('photo').click()">
                                                <i class="fas fa-upload"></i> Change Photo
                                            </button>
                                            @if($student->photo)
                                                <button type="button" class="btn-remove-photo" onclick="removeCurrentPhoto()">
                                                    <i class="fas fa-trash"></i> Remove
                                                </button>
                                            @endif
                                        </div>
                                        <input type="hidden" name="remove_photo" id="remove_photo" value="0">
                                        <p class="help-text">Max size: 2MB (JPG, PNG)</p>
                                    </div>
                                </div>

                                <div style="flex: 2;">
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">First Name <span class="required">*</span></label>
                                            <div class="input-group">
                                                <i class="input-group-icon fas fa-user"></i>
                                                <input type="text" class="form-control" name="first_name" id="first_name" 
                                                       value="{{ old('first_name', $student->first_name) }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Last Name <span class="required">*</span></label>
                                            <div class="input-group">
                                                <i class="input-group-icon fas fa-user"></i>
                                                <input type="text" class="form-control" name="last_name" id="last_name" 
                                                       value="{{ old('last_name', $student->last_name) }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">Email Address <span class="required">*</span></label>
                                            <div class="input-group">
                                                <i class="input-group-icon fas fa-envelope"></i>
                                                <input type="email" class="form-control" name="email" 
                                                       value="{{ old('email', $student->email) }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Phone Number</label>
                                            <div class="input-group">
                                                <i class="input-group-icon fas fa-phone"></i>
                                                <input type="tel" class="form-control" name="phone" 
                                                       value="{{ old('phone', $student->phone) }}">
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
                                        <input type="date" class="form-control" name="date_of_birth" 
                                               value="{{ old('date_of_birth', $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('Y-m-d') : '') }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Gender <span class="required">*</span></label>
                                    <select class="form-control form-select" name="gender" required>
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender', $student->gender) === 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender', $student->gender) === 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender', $student->gender) === 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Blood Group</label>
                                    <select class="form-control form-select" name="blood_group">
                                        <option value="">Select Blood Group</option>
                                        <option value="A+" {{ old('blood_group', $student->blood_group) === 'A+' ? 'selected' : '' }}>A+</option>
                                        <option value="A-" {{ old('blood_group', $student->blood_group) === 'A-' ? 'selected' : '' }}>A-</option>
                                        <option value="B+" {{ old('blood_group', $student->blood_group) === 'B+' ? 'selected' : '' }}>B+</option>
                                        <option value="B-" {{ old('blood_group', $student->blood_group) === 'B-' ? 'selected' : '' }}>B-</option>
                                        <option value="AB+" {{ old('blood_group', $student->blood_group) === 'AB+' ? 'selected' : '' }}>AB+</option>
                                        <option value="AB-" {{ old('blood_group', $student->blood_group) === 'AB-' ? 'selected' : '' }}>AB-</option>
                                        <option value="O+" {{ old('blood_group', $student->blood_group) === 'O+' ? 'selected' : '' }}>O+</option>
                                        <option value="O-" {{ old('blood_group', $student->blood_group) === 'O-' ? 'selected' : '' }}>O-</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Address</label>
                                <div class="input-group">
                                    <i class="input-group-icon fas fa-map-marker-alt"></i>
                                    <textarea class="form-control" name="address" rows="3" placeholder="Enter full address">{{ old('address', $student->address) }}</textarea>
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
                                    <label class="form-label">Admission Number <span class="required">*</span></label>
                                    <div class="input-group">
                                        <i class="input-group-icon fas fa-id-badge"></i>
                                        <input type="text" class="form-control" name="admission_number" 
                                               value="{{ old('admission_number', $student->admission_number) }}" required
                                               placeholder="e.g., ADM2024001" readonly>
                                    </div>
                                    <p class="help-text">Unique admission number for the student</p>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Roll Number <span class="required">*</span></label>
                                    <div class="input-group">
                                        <i class="input-group-icon fas fa-id-card"></i>
                                        <input type="text" class="form-control" name="roll_number" 
                                               value="{{ old('roll_number', $student->roll_number) }}" required
                                               placeholder="e.g., 001, 002">
                                    </div>
                                    <p class="help-text">Class roll number for the student</p>
                                </div>

                                                <div class="form-group">
    <label class="form-label">Class <span class="required">*</span></label>
    <select class="form-control form-select" name="class_id" id="class_id" required>
        <option value="">Select Class</option>
        @if(isset($classes))
            @foreach($classes as $class)
                <option value="{{ $class->id }}" {{ old('class_id', $student->class_id) == $class->id ? 'selected' : '' }}>
                    {{ $class->name }} - {{ $class->section }}
                </option>
            @endforeach
        @else
            <!-- Fallback options -->
            @for($i = 1; $i <= 12; $i++)
                @foreach(['A', 'B'] as $section)
                    <option value="{{ $i }}{{ $section }}" {{ old('class_id', $student->class_id) == "$i$section" ? 'selected' : '' }}>
                        Class {{ $i }} - {{ $section }}
                    </option>
                @endforeach
            @endfor
        @endif
    </select>
</div>


                                <div class="form-group">
                                    <label class="form-label">Status <span class="required">*</span></label>
                                    <select class="form-control form-select" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="active" {{ old('status', $student->status) === 'active' ? 'selected' : '' }}>
                                            <i class="fas fa-check-circle"></i> Active
                                        </option>
                                        <option value="inactive" {{ old('status', $student->status) === 'inactive' ? 'selected' : '' }}>
                                            <i class="fas fa-pause-circle"></i> Inactive
                                        </option>
                                        <option value="suspended" {{ old('status', $student->status) === 'suspended' ? 'selected' : '' }}>
                                            <i class="fas fa-ban"></i> Suspended
                                        </option>
                                        <option value="graduated" {{ old('status', $student->status) === 'graduated' ? 'selected' : '' }}>
                                            <i class="fas fa-graduation-cap"></i> Graduated
                                        </option>
                                        <option value="transferred" {{ old('status', $student->status) === 'transferred' ? 'selected' : '' }}>
                                            <i class="fas fa-exchange-alt"></i> Transferred
                                        </option>
                                    </select>
                                </div>
                            </div>

                          
                                <div class="form-group">
                                    <label class="form-label">Admission Date</label>
                                    <div class="input-group">
                                        <i class="input-group-icon fas fa-calendar-plus"></i>
                                        <input type="date" class="form-control" name="admission_date" 
                                               value="{{ old('admission_date', $student->admission_date ? \Carbon\Carbon::parse($student->admission_date)->format('Y-m-d') : '') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Academic Year</label>
                                    <div class="input-group">
                                        <i class="input-group-icon fas fa-calendar-alt"></i>
                                        <input type="text" class="form-control" name="academic_year" 
                                               value="{{ old('academic_year', $student->academic_year) }}"
                                               placeholder="e.g., 2024-2025">
                                    </div>
                                </div>
                            </div>

                            <div class="status-info">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    <strong>Status Information:</strong>
                                    <ul style="margin: 5px 0 0 20px;">
                                        <li><strong>Active:</strong> Student is currently enrolled and attending classes</li>
                                        <li><strong>Inactive:</strong> Student is temporarily not attending (e.g., medical leave)</li>
                                        <li><strong>Suspended:</strong> Student is temporarily barred from attending</li>
                                        <li><strong>Graduated:</strong> Student has completed their studies</li>
                                        <li><strong>Transferred:</strong> Student has moved to another institution</li>
                                    </ul>
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
                                        <input type="text" class="form-control" name="guardian_name" 
                                               value="{{ old('guardian_name', $student->guardian_name) }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Relationship <span class="required">*</span></label>
                                    <select class="form-control form-select" name="guardian_relation" required>
                                        <option value="">Select Relationship</option>
                                        <option value="father" {{ old('guardian_relation', $student->guardian_relation) === 'father' ? 'selected' : '' }}>Father</option>
                                        <option value="mother" {{ old('guardian_relation', $student->guardian_relation) === 'mother' ? 'selected' : '' }}>Mother</option>
                                        <option value="grandfather" {{ old('guardian_relation', $student->guardian_relation) === 'grandfather' ? 'selected' : '' }}>Grandfather</option>
                                        <option value="grandmother" {{ old('guardian_relation', $student->guardian_relation) === 'grandmother' ? 'selected' : '' }}>Grandmother</option>
                                        <option value="uncle" {{ old('guardian_relation', $student->guardian_relation) === 'uncle' ? 'selected' : '' }}>Uncle</option>
                                        <option value="aunt" {{ old('guardian_relation', $student->guardian_relation) === 'aunt' ? 'selected' : '' }}>Aunt</option>
                                        <option value="other" {{ old('guardian_relation', $student->guardian_relation) === 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Guardian Phone <span class="required">*</span></label>
                                    <div class="input-group">
                                        <i class="input-group-icon fas fa-mobile-alt"></i>
                                        <input type="tel" class="form-control" name="guardian_phone" 
                                               value="{{ old('guardian_phone', $student->guardian_phone) }}" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Guardian Email</label>
                                    <div class="input-group">
                                        <i class="input-group-icon fas fa-envelope"></i>
                                        <input type="email" class="form-control" name="guardian_email" 
                                               value="{{ old('guardian_email', $student->guardian_email) }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Guardian Occupation</label>
                                    <div class="input-group">
                                        <i class="input-group-icon fas fa-briefcase"></i>
                                        <input type="text" class="form-control" name="guardian_occupation" 
                                               value="{{ old('guardian_occupation', $student->guardian_occupation) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Password Update Section -->
                        <div class="form-section">
                            <h5 class="section-title">
                                <i class="fas fa-key"></i>
                                Password & Security
                            </h5>

                            <div class="password-section">
                                <h6><i class="fas fa-info-circle"></i> Password Update (Optional)</h6>
                                <div class="password-help">
                                    <i class="fas fa-lightbulb"></i>
                                    <strong>Note:</strong> Leave password fields empty if you don't want to change the current password. 
                                    If you enter a new password, make sure it's at least 8 characters long.
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">New Password</label>
                                        <div class="input-group">
                                            <i class="input-group-icon fas fa-lock"></i>
                                            <input type="password" class="form-control" name="password" minlength="8" placeholder="Leave empty to keep current password">
                                        </div>
                                        <p class="help-text">Minimum 8 characters (only if changing password)</p>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Confirm New Password</label>
                                        <div class="input-group">
                                            <i class="input-group-icon fas fa-lock"></i>
                                            <input type="password" class="form-control" name="password_confirmation" minlength="8" placeholder="Confirm new password">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" style="display: flex; align-items: center; gap: 10px;">
                                        <input type="checkbox" name="send_password_notification" value="1" style="margin: 0;">
                                        Send password change notification via email
                                    </label>
                                    <p class="help-text">Student and guardian will be notified if password is updated</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                Update Student
                            </button>
                            <a href="{{ route('studentmanage') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i>
                                Back to Students
                            </a>
                            <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                                <i class="fas fa-trash"></i>
                                Delete Student
                            </button>
                        </div>
                    </form>

                    <!-- Delete Form (Hidden) -->
                    <form id="deleteForm" action="{{-- route('delete.student', $student->id) --}}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
let newPhotoFile = null;

// Enhanced photo preview with validation
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        if (!validateFileUpload(file)) {
            input.value = ''; // Clear the input
            return;
        }
        
        newPhotoFile = file;
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.querySelector('.photo-preview');
            const currentPhoto = document.querySelector('.current-photo');
            
            if (preview && currentPhoto) {
                preview.innerHTML = `<img src="${e.target.result}" alt="New Photo Preview">`;
                preview.style.display = 'flex';
                currentPhoto.style.opacity = '0.5';
                
                // Reset remove photo flag
                document.getElementById('remove_photo').value = '0';
            }
        };
        reader.readAsDataURL(file);
    }
}

// Remove current photo
function removeCurrentPhoto() {
    if (confirm('Are you sure you want to remove the current photo?')) {
        const currentPhoto = document.querySelector('.current-photo');
        const preview = document.querySelector('.photo-preview');
        const photoInput = document.getElementById('photo');
        
        if (currentPhoto) {
            currentPhoto.innerHTML = `
                <div class="no-photo">
                    <i class="fas fa-user"></i>
                </div>
            `;
        }
        
        if (preview) {
            preview.style.display = 'none';
            preview.innerHTML = `
                <div class="photo-placeholder">
                    <i class="fas fa-camera"></i>
                    <small>New photo preview</small>
                </div>
            `;
        }
        
        // Set remove photo flag
        document.getElementById('remove_photo').value = '1';
        
        // Clear file input
        if (photoInput) {
            photoInput.value = '';
        }
        
        newPhotoFile = null;
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

// Preview changes before submission

// Close preview modal
function closePreviewModal() {
    document.getElementById('previewModal').classList.remove('show');
}

// Submit form from preview modal
function submitForm() {
    document.getElementById('updateStudentForm').submit();
}

// Confirm delete action
function confirmDelete() {
    if (confirm('Are you sure you want to delete this student? This action cannot be undone and will remove all associated records.')) {
        if (confirm('This will permanently delete the student record. Are you absolutely sure?')) {
            document.getElementById('deleteForm').submit();
        }
    }
}

// Form validation function
function validateForm() {
    const form = document.getElementById('updateStudentForm');
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

    // Validate password confirmation if password is provided
    const password = document.querySelector('input[name="password"]');
    const confirmPassword = document.querySelector('input[name="password_confirmation"]');
    
    if (password && confirmPassword) {
        if (password.value && password.value !== confirmPassword.value) {
            confirmPassword.classList.add('is-invalid');
            showAlert('error', 'Passwords do not match!');
            isValid = false;
        } else if (password.value && password.value.length < 8) {
            password.classList.add('is-invalid');
            showAlert('error', 'Password must be at least 8 characters long!');
            isValid = false;
        }
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

    if (!isValid && firstInvalidField) {
        firstInvalidField.focus();
        firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    return isValid;
}

// Show alert messages
function showAlert(type, message) {
    // Create alert element if it doesn't exist
    let alertElement = document.querySelector('.alert');
    if (!alertElement) {
        alertElement = document.createElement('div');
        alertElement.className = `alert alert-${type === 'error' ? 'danger' : type}`;
        document.querySelector('.form-container').prepend(alertElement);
    } else {
        alertElement.className = `alert alert-${type === 'error' ? 'danger' : type}`;
    }
    
    alertElement.innerHTML = `
        <i class="fas fa-${type === 'error' ? 'exclamation-circle' : type === 'success' ? 'check-circle' : 'exclamation-triangle'}"></i>
        ${message}
        <button class="close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
    `;
    alertElement.style.display = 'flex';
    
    // Auto-hide success messages after 5 seconds
    if (type === 'success') {
        setTimeout(() => {
            alertElement.style.display = 'none';
        }, 5000);
    }
    
    // Scroll to top to show alert
    alertElement.scrollIntoView({ behavior: 'smooth' });
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
            
            if (password.length === 0) {
                this.classList.remove('is-invalid', 'is-valid');
                return;
            }
            
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            this.classList.remove('is-invalid', 'is-valid');
            if (strength >= 3) {
                this.classList.add('is-valid');
            } else {
                this.classList.add('is-invalid');
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
            if (passwordField.value && this.value && this.value !== passwordField.value) {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    }
    
    // Setup real-time validation
    setupRealTimeValidation();
    
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
    
    // Handle form submission
    document.getElementById('updateStudentForm').addEventListener('submit', function(e) {
        if (!validateForm()) {
            e.preventDefault();
            return false;
        }
        
        // Show loading state
        const submitBtn = document.querySelector('.btn-primary');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
        }
    });
    
    // Close modal when clicking outside
    document.getElementById('previewModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closePreviewModal();
        }
    });
});
</script>
@endsection