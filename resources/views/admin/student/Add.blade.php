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
    }

    .form-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px 30px;
        margin: 0;
    }

    .form-header h4 {
        margin: 0;
        font-weight: 600;
        font-size: 24px;
    }

    .form-header p {
        margin: 5px 0 0 0;
        opacity: 0.9;
        font-size: 14px;
    }

    .form-body {
        padding: 30px;
    }

    .form-section {
        margin-bottom: 35px;
        display: none;
    }

    .form-section.active {
        display: block;
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
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

    .form-control:invalid {
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
        justify-content: space-between;
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

    .btn-outline {
        background: transparent;
        color: #6b7280;
        border: 2px solid #d1d5db;
    }

    .btn-outline:hover {
        background: #f9fafb;
        border-color: #9ca3af;
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
    }

    .input-group .form-control {
        padding-left: 45px;
    }

    .progress-bar {
        width: 100%;
        height: 6px;
        background: #e5e7eb;
        border-radius: 3px;
        overflow: hidden;
        margin-bottom: 30px;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #667eea, #764ba2);
        width: 25%;
        transition: width 0.5s ease;
    }

    .form-steps {
        display: flex;
        justify-content: center;
        margin-bottom: 30px;
        gap: 20px;
        flex-wrap: wrap;
    }

    .step {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        border-radius: 25px;
        background: #f3f4f6;
        color: #6b7280;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .step.active {
        background: #667eea;
        color: white;
        transform: scale(1.05);
    }

    .step.completed {
        background: #10b981;
        color: white;
    }

    .step::after {
        content: '';
        position: absolute;
        right: -25px;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 2px;
        background: #d1d5db;
        z-index: -1;
    }

    .step:last-child::after {
        display: none;
    }

    .step-navigation {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .step-nav-left {
        display: flex;
        gap: 10px;
    }

    .step-nav-right {
        display: flex;
        gap: 10px;
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

        .step-navigation {
            flex-direction: column;
            gap: 15px;
        }

        .step-nav-left,
        .step-nav-right {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <!-- Progress Steps -->
            <div class="form-steps">
                <div class="step active" data-step="1">
                    <i class="fas fa-user"></i>
                    <span>Basic Info</span>
                </div>
                <div class="step" data-step="2">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Academic</span>
                </div>
                <div class="step" data-step="3">
                    <i class="fas fa-users"></i>
                    <span>Guardian</span>
                </div>
                <div class="step" data-step="4">
                    <i class="fas fa-check"></i>
                    <span>Review</span>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="progress-bar">
                <div class="progress-fill" id="progressFill"></div>
            </div>

            <!-- Success/Error Messages -->
            <div class="alert alert-success" id="successAlert" style="display: none;">
                <i class="fas fa-check-circle"></i>
                <span id="successMessage"></span>
            </div>

            <div class="alert alert-error" id="errorAlert" style="display: none;">
                <i class="fas fa-exclamation-triangle"></i>
                <span id="errorMessage">Please correct the errors below.</span>
            </div>

            <!-- Main Form -->
            <div class="form-container">
                <div class="form-header">
                    <h4><i class="fas fa-user-plus"></i> Add New Student</h4>
                    <p>Enter student information to create a new account</p>
                </div>

                <div class="form-body">
                    <form action="#" method="POST" enctype="multipart/form-data" id="addStudentForm">
                        <!-- Step 1: Basic Information -->
                        <div class="form-section active" id="step-1">
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

                        <!-- Step 2: Academic Information -->
                        <div class="form-section" id="step-2">
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
                                        <option value="">Select Class</option>
                                        <option value="1">Class 1A</option>
                                        <option value="2">Class 2A</option>
                                        <option value="3">Class 3A</option>
                                        <option value="4">Class 4A</option>
                                        <option value="5">Class 5A</option>
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

                        <!-- Step 3: Guardian Information -->
                        <div class="form-section" id="step-3">
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

                        <!-- Step 4: Review and Account Settings -->
                        <div class="form-section" id="step-4">
                            <h5 class="section-title">
                                <i class="fas fa-eye"></i>
                                Review Information
                            </h5>

                            <div id="reviewContent">
                                <!-- Review content will be populated by JavaScript -->
                            </div>

                            <h5 class="section-title" style="margin-top: 35px;">
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
                            <div class="step-nav-left">
                                <button type="button" class="btn btn-outline" id="prevBtn" onclick="previousStep()" style="display: none;">
                                    <i class="fas fa-arrow-left"></i>
                                    Previous
                                </button>
                            </div>
                            
                            <div class="step-nav-right">
                                <button type="button" class="btn btn-secondary" onclick="saveDraft()">
                                    <i class="fas fa-save"></i>
                                    Save Draft
                                </button>
                                <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextStep()">
                                    Next
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                                <button type="submit" class="btn btn-primary" id="submitBtn" style="display: none;">
                                    <i class="fas fa-user-plus"></i>
                                    Add Student
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
   let currentStep = 1;
const totalSteps = 4;

// Auto-generate student ID based on name and DOB
// Replace your existing generateStudentID function and event listeners with:

function generateStudentID() {
    const firstNameElement = document.getElementById('first_name');
    const lastNameElement = document.getElementById('last_name');
    const dobElement = document.getElementById('date_of_birth');
    const studentIdElement = document.getElementById('student_id');

    // Check if elements exist
    if (!firstNameElement || !lastNameElement || !dobElement || !studentIdElement) {
        console.error('Required elements not found');
        return;
    }

    const firstName = firstNameElement.value.trim();
    const lastName = lastNameElement.value.trim();
    const dob = dobElement.value;

    if (firstName && lastName && dob) {
        const firstInitial = firstName.charAt(0).toUpperCase();
        const lastInitial = lastName.charAt(0).toUpperCase();
        const dobDate = new Date(dob);
        const year = dobDate.getFullYear().toString().slice(-2);
        const month = (dobDate.getMonth() + 1).toString().padStart(2, '0');
        const day = dobDate.getDate().toString().padStart(2, '0');
        
        const randomNum = Math.floor(Math.random() * 900) + 100;
        const studentId = `${firstInitial}${lastInitial}${year}${month}${day}${randomNum}`;
        
        studentIdElement.value = studentId;
    }
}

// Update your DOMContentLoaded event listener:
document.addEventListener('DOMContentLoaded', function() {
    // Set default admission date to today
    const today = new Date().toISOString().split('T')[0];
    document.querySelector('input[name="admission_date"]').value = today;
    
    // Setup Student ID generation with a small delay
    setTimeout(() => {
        const firstNameInput = document.getElementById('first_name');
        const lastNameInput = document.getElementById('last_name');
        const dobInput = document.getElementById('date_of_birth');
        
        if (firstNameInput && lastNameInput && dobInput) {
            firstNameInput.addEventListener('input', generateStudentID);
            lastNameInput.addEventListener('input', generateStudentID);
            dobInput.addEventListener('change', generateStudentID);
            console.log('Student ID generation setup complete');
        }
    }, 100);
    
    // Check for draft data
    if (localStorage.getItem('studentDraft')) {
        if (confirm('A draft was found. Would you like to load it?')) {
            loadDraft();
        }
    }
    
    // Initialize first step
    showStep(1);
});

// Photo preview functionality
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.querySelector('.photo-preview');
            preview.innerHTML = `<img src="${e.target.result}" alt="Student Photo">`;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Step navigation functions
function updateProgressBar() {
    const progress = (currentStep / totalSteps) * 100;
    document.getElementById('progressFill').style.width = progress + '%';
}

function updateStepIndicators() {
    const steps = document.querySelectorAll('.step');
    steps.forEach((step, index) => {
        const stepNumber = index + 1;
        step.classList.remove('active', 'completed');
        
        if (stepNumber < currentStep) {
            step.classList.add('completed');
        } else if (stepNumber === currentStep) {
            step.classList.add('active');
        }
    });
}

function showStep(stepNumber) {
    // Hide all sections
    document.querySelectorAll('.form-section').forEach(section => {
        section.classList.remove('active');
    });
    
    // Show current section
    document.getElementById(`step-${stepNumber}`).classList.add('active');
    
    // Update navigation buttons
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');
    
    if (stepNumber === 1) {
        prevBtn.style.display = 'none';
    } else {
        prevBtn.style.display = 'inline-flex';
    }
    
    if (stepNumber === totalSteps) {
        nextBtn.style.display = 'none';
        submitBtn.style.display = 'inline-flex';
    } else {
        nextBtn.style.display = 'inline-flex';
        submitBtn.style.display = 'none';
    }
    
    // Update progress and indicators
    updateProgressBar();
    updateStepIndicators();
    
    // If step 4, populate review content
    if (stepNumber === 4) {
        populateReviewContent();
    }
}

function validateCurrentStep() {
    const currentSection = document.getElementById(`step-${currentStep}`);
    const requiredFields = currentSection.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            isValid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    });
    
    // Additional validation for step 4 (password confirmation)
    if (currentStep === 4) {
        const password = document.querySelector('input[name="password"]').value;
        const confirmPassword = document.querySelector('input[name="password_confirmation"]').value;
        
        if (password !== confirmPassword) {
            document.querySelector('input[name="password_confirmation"]').classList.add('is-invalid');
            showAlert('error', 'Passwords do not match!');
            isValid = false;
        }
    }
    
    if (!isValid) {
        showAlert('error', 'Please fill in all required fields correctly.');
    }
    
    return isValid;
}

function nextStep() {
    if (validateCurrentStep() && currentStep < totalSteps) {
        currentStep++;
        showStep(currentStep);
        hideAlerts();
    }
}

function previousStep() {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
        hideAlerts();
    }
}

function populateReviewContent() {
    const formData = new FormData(document.getElementById('addStudentForm'));
    const reviewContent = document.getElementById('reviewContent');
    
    const basicInfo = {
        'First Name': formData.get('first_name'),
        'Last Name': formData.get('last_name'),
        'Email': formData.get('email'),
        'Phone': formData.get('phone') || 'Not provided',
        'Date of Birth': formData.get('date_of_birth'),
        'Gender': formData.get('gender'),
        'Blood Group': formData.get('blood_group') || 'Not provided',
        'Address': formData.get('address') || 'Not provided'
    };
    
    const academicInfo = {
        'Student ID': formData.get('student_id'),
        'Class': getSelectText('class_id'),
        'Roll Number': formData.get('roll_number'),
        'Admission Date': formData.get('admission_date'),
        'Academic Year': formData.get('academic_year'),
        'Status': formData.get('status')
    };
    
    const guardianInfo = {
        'Guardian Name': formData.get('guardian_name'),
        'Relationship': formData.get('guardian_relationship'),
        'Guardian Phone': formData.get('guardian_phone'),
        'Guardian Email': formData.get('guardian_email') || 'Not provided',
        'Guardian Occupation': formData.get('guardian_occupation') || 'Not provided'
    };
    
    let reviewHTML = `
        <div class="review-section">
            <h6 style="color: #667eea; font-weight: 600; margin-bottom: 15px;">
                <i class="fas fa-user"></i> Basic Information
            </h6>
            <div class="review-grid">
    `;
    
    Object.entries(basicInfo).forEach(([key, value]) => {
        reviewHTML += `
            <div class="review-item">
                <strong>${key}:</strong> <span>${value || 'Not provided'}</span>
            </div>
        `;
    });
    
    reviewHTML += `
            </div>
        </div>
        
        <div class="review-section">
            <h6 style="color: #667eea; font-weight: 600; margin-bottom: 15px;">
                <i class="fas fa-graduation-cap"></i> Academic Information
            </h6>
            <div class="review-grid">
    `;
    
    Object.entries(academicInfo).forEach(([key, value]) => {
        reviewHTML += `
            <div class="review-item">
                <strong>${key}:</strong> <span>${value || 'Not provided'}</span>
            </div>
        `;
    });
    
    reviewHTML += `
            </div>
        </div>
        
        <div class="review-section">
            <h6 style="color: #667eea; font-weight: 600; margin-bottom: 15px;">
                <i class="fas fa-users"></i> Guardian Information
            </h6>
            <div class="review-grid">
    `;
    
    Object.entries(guardianInfo).forEach(([key, value]) => {
        reviewHTML += `
            <div class="review-item">
                <strong>${key}:</strong> <span>${value || 'Not provided'}</span>
            </div>
        `;
    });
    
    reviewHTML += `
            </div>
        </div>
    `;
    
    reviewContent.innerHTML = reviewHTML;
}

function getSelectText(selectName) {
    const select = document.querySelector(`select[name="${selectName}"]`);
    return select.options[select.selectedIndex]?.text || '';
}

function showAlert(type, message) {
    hideAlerts();
    const alertElement = document.getElementById(type === 'success' ? 'successAlert' : 'errorAlert');
    const messageElement = document.getElementById(type === 'success' ? 'successMessage' : 'errorMessage');
    
    messageElement.textContent = message;
    alertElement.style.display = 'flex';
    
    // Auto-hide after 5 seconds
    setTimeout(() => {
        hideAlerts();
    }, 5000);
}

function hideAlerts() {
    document.getElementById('successAlert').style.display = 'none';
    document.getElementById('errorAlert').style.display = 'none';
}

function saveDraft() {
    const formData = new FormData(document.getElementById('addStudentForm'));
    
    // Convert FormData to JSON
    const draftData = {};
    for (let [key, value] of formData.entries()) {
        draftData[key] = value;
    }
    
    // Save to localStorage (in a real application, this would be sent to the server)
    localStorage.setItem('studentDraft', JSON.stringify(draftData));
    showAlert('success', 'Draft saved successfully!');
}

function loadDraft() {
    const draftData = localStorage.getItem('studentDraft');
    if (draftData) {
        const data = JSON.parse(draftData);
        const form = document.getElementById('addStudentForm');
        
        Object.entries(data).forEach(([key, value]) => {
            const field = form.querySelector(`[name="${key}"]`);
            if (field) {
                if (field.type === 'checkbox') {
                    field.checked = value === '1';
                } else {
                    field.value = value;
                }
            }
        });
        
        // Regenerate student ID if needed
        generateStudentID();
        showAlert('success', 'Draft loaded successfully!');
    }
}

// Step click navigation
document.querySelectorAll('.step').forEach(step => {
    step.addEventListener('click', function() {
        const stepNumber = parseInt(this.dataset.step);
        if (stepNumber < currentStep || (stepNumber === currentStep + 1 && validateCurrentStep())) {
            currentStep = stepNumber;
            showStep(currentStep);
        }
    });
});

// Form submission
document.getElementById('addStudentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (!validateCurrentStep()) {
        return;
    }
    
    // Show loading state
    const submitBtn = document.getElementById('submitBtn');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding Student...';
    submitBtn.disabled = true;
    
    // Simulate form submission (replace with actual AJAX call)
    setTimeout(() => {
        // Clear draft from localStorage
        localStorage.removeItem('studentDraft');
        
        showAlert('success', 'Student added successfully! Redirecting...');
        
        // Reset button
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        
        // Redirect after success (uncomment in real application)
        // setTimeout(() => {
        //     window.location.href = '/students';
        // }, 2000);
    }, 2000);
});

// Load draft on page load
document.addEventListener('DOMContentLoaded', function() {
    // Set default admission date to today
    const today = new Date().toISOString().split('T')[0];
    document.querySelector('input[name="admission_date"]').value = today;
    
    // Check for draft data
    if (localStorage.getItem('studentDraft')) {
        if (confirm('A draft was found. Would you like to load it?')) {
            loadDraft();
        }
    }
    
    // Initialize first step
    showStep(1);
});

// Add CSS for review section (inject into head)
const reviewStyles = `
<style>
/* Add these additional CSS styles to your @section('styles') in the Blade template */

/* Review Section Styles - Already included via JavaScript, but add here for consistency */
.review-section {
    margin-bottom: 25px;
    padding: 20px;
    background: #f8fafc;
    border-radius: 10px;
    border-left: 4px solid #667eea;
}

.review-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 15px;
}

.review-item {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.review-item strong {
    color: #374151;
    font-size: 13px;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.review-item span {
    color: #1f2937;
    font-size: 14px;
    padding: 8px 12px;
    background: white;
    border-radius: 6px;
    border: 1px solid #e5e7eb;
}

/* Invalid form field styles */
.form-control.is-invalid {
    border-color: #ef4444 !important;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
    background: #fef2f2 !important;
}

.form-control.is-invalid:focus {
    border-color: #ef4444 !important;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2) !important;
}

/* Loading button animation */
.btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none !important;
}

.btn .fa-spinner {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Enhanced step indicators */
.step.completed i {
    display: none;
}

.step.completed::before {
    content: '\f00c';
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    font-size: 14px;
}

/* Step hover effects */
.step:not(.active):not(.completed):hover {
    background: #e5e7eb;
    transform: translateY(-2px);
}

/* Enhanced form animations */
.form-control:focus {
    transform: translateY(-1px);
}

.form-control.is-invalid {
    animation: shake 0.5s ease-in-out;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

/* Photo upload enhancements */
.photo-preview.has-image {
    border-style: solid;
    border-color: #10b981;
}

.photo-preview.has-image:hover {
    transform: scale(1.05);
}

/* Checkbox styling */
input[type="checkbox"] {
    width: 16px;
    height: 16px;
    accent-color: #667eea;
    cursor: pointer;
}

/* Enhanced alert animations */
.alert {
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Textarea styling */
.form-control[rows] {
    resize: vertical;
    min-height: 80px;
}

/* Enhanced button states */
.btn:active {
    transform: translateY(0) !important;
}

.btn-primary:disabled {
    background: #9ca3af;
    cursor: not-allowed;
}

/* Step connector line animation */
.step.completed::after {
    background: #10b981;
    animation: fillLine 0.3s ease;
}

@keyframes fillLine {
    from {
        width: 0;
    }
    to {
        width: 20px;
    }
}

/* Mobile enhancements */
@media (max-width: 576px) {
    .form-steps {
        gap: 10px;
    }
    
    .step {
        padding: 8px 12px;
        font-size: 12px;
    }
    
    .step span {
        display: none;
    }
    
    .step::after {
        display: none;
    }
    
    .form-header h4 {
        font-size: 20px;
    }
    
    .photo-preview {
        width: 100px;
        height: 100px;
    }
}

/* Print styles */
@media print {
    .form-steps,
    .progress-bar,
    .form-actions,
    .alert {
        display: none !important;
    }
    
    .form-section {
        display: block !important;
        page-break-inside: avoid;
    }
    
    .form-container {
        box-shadow: none;
        border: 1px solid #ccc;
    }
}
</style>
`;

document.head.insertAdjacentHTML('beforeend', reviewStyles);
</script>