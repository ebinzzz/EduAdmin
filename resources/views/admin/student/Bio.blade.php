@extends('layouts.app')

@section('title', 'Student Biodata - ' . $student->first_name . ' ' . $student->last_name)

@push('styles')
<style>
:root {
    --primary-color: #3b82f6;
    --secondary-color: #64748b;
    --success-color: #10b981;
    --info-color: #0ea5e9;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --light-bg: #f8fafc;
    --white: #ffffff;
    --border-color: #e2e8f0;
    --text-primary: #1e293b;
    --text-secondary: #64748b;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    --border-radius: 12px;
    --border-radius-sm: 8px;
}

body {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    min-height: 100vh;
}

.biodata-container {
    padding: 2rem 0;
    min-height: 100vh;
}

/* Header Section */
.biodata-header {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: var(--border-radius);
    padding: 1.5rem 2rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-lg);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.biodata-header h1 {
    color: var(--text-primary);
    font-weight: 700;
    font-size: 1.75rem;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.header-actions {
    display: flex;
    gap: 0.75rem;
    align-items: center;
}

.btn-custom {
    padding: 0.625rem 1.25rem;
    border-radius: var(--border-radius-sm);
    font-weight: 500;
    font-size: 0.875rem;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
}

.btn-primary-custom {
    background: var(--primary-color);
    color: white;
}

.btn-primary-custom:hover {
    background: #2563eb;
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

.btn-secondary-custom {
    background: var(--secondary-color);
    color: white;
}

.btn-secondary-custom:hover {
    background: #475569;
    transform: translateY(-1px);
}

.btn-success-custom {
    background: var(--success-color);
    color: white;
}

.btn-success-custom:hover {
    background: #059669;
    transform: translateY(-1px);
}

/* Main Content */
.biodata-content {
    display: grid;
    grid-template-columns: 350px 1fr;
    gap: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

/* Profile Card */
.profile-section {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: var(--border-radius);
    padding: 2rem;
    box-shadow: var(--shadow-lg);
    border: 1px solid rgba(255, 255, 255, 0.2);
    height: fit-content;
    position: sticky;
    top: 2rem;
}

.profile-header {
    text-align: center;
    margin-bottom: 2rem;
}

.profile-image {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid white;
    box-shadow: var(--shadow-md);
    margin-bottom: 1rem;
    transition: transform 0.3s ease;
}

.profile-image:hover {
    transform: scale(1.05);
}

.profile-name {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.profile-class {
    font-size: 1rem;
    color: var(--text-secondary);
    margin-bottom: 1rem;
}

.profile-badges {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-bottom: 2rem;
}

.badge-custom {
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-size: 0.875rem;
    font-weight: 500;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.badge-primary {
    background: linear-gradient(135deg, var(--primary-color), #2563eb);
    color: white;
}

.badge-success {
    background: linear-gradient(135deg, var(--success-color), #059669);
    color: white;
}

.badge-warning {
    background: linear-gradient(135deg, var(--warning-color), #d97706);
    color: white;
}

.badge-danger {
    background: linear-gradient(135deg, var(--danger-color), #dc2626);
    color: white;
}

.profile-stats {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    padding-top: 1.5rem;
    border-top: 2px solid var(--border-color);
}

.stat-item {
    text-align: center;
    padding: 1rem;
    background: rgba(59, 130, 246, 0.05);
    border-radius: var(--border-radius-sm);
}

.stat-number {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--primary-color);
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.75rem;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
}

/* Details Section */
.details-section {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.info-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-lg);
    border: 1px solid rgba(255, 255, 255, 0.2);
    overflow: hidden;
    transition: transform 0.2s ease;
}

.info-card:hover {
    transform: translateY(-2px);
}

.card-header {
    padding: 1.25rem 1.5rem;
    background: linear-gradient(135deg, var(--primary-color), #2563eb);
    color: white;
    font-weight: 600;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.card-header.academic {
    background: linear-gradient(135deg, var(--success-color), #059669);
}

.card-header.contact {
    background: linear-gradient(135deg, var(--info-color), #0284c7);
}

.card-header.guardian {
    background: linear-gradient(135deg, var(--warning-color), #d97706);
}

.card-header.system {
    background: linear-gradient(135deg, var(--secondary-color), #475569);
}

.card-body {
    padding: 1.5rem;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.info-label {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.info-value {
    font-size: 1rem;
    font-weight: 500;
    color: var(--text-primary);
    padding: 0.75rem;
    background: rgba(59, 130, 246, 0.05);
    border-radius: var(--border-radius-sm);
    border-left: 3px solid var(--primary-color);
    transition: all 0.2s ease;
}

.info-value:hover {
    background: rgba(59, 130, 246, 0.1);
    transform: translateX(3px);
}

.info-value a {
    color: inherit;
    text-decoration: none;
}

.info-value a:hover {
    color: var(--primary-color);
}

/* QR Code Section */
.qr-section {
    text-align: center;
    margin-bottom: 2rem;
    padding: 1rem;
    background: rgba(250, 242, 242, 0);
    border-radius: var(--border-radius-sm);
    border: 2px dashed var(--border-color);
}

.qr-code,img {
    width: 120px;
    height: 120px;
    background: #ffff;
    border-radius: var(--border-radius-sm);
    margin: 0 auto 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.75rem;
}

.qr-label {
    font-size: 0.875rem;
    color: var(--text-secondary);
    font-weight: 500;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .biodata-content {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .profile-section {
        position: static;
    }
}

@media (max-width: 768px) {
    .biodata-container {
        padding: 1rem;
    }
    
    .biodata-header {
        padding: 1rem;
        text-align: center;
    }
    
    .biodata-header h1 {
        font-size: 1.5rem;
        justify-content: center;
        margin-bottom: 1rem;
    }
    
    .header-actions {
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .profile-section,
    .info-card {
        margin: 0 1rem;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .profile-stats {
        grid-template-columns: 1fr;
    }
}

/* Print Styles */
@media print {
    body {
        background: white !important;
    }
    
    .biodata-container {
        padding: 0;
    }
    
    .header-actions {
        display: none !important;
    }
    
    .profile-section,
    .info-card {
        background: white !important;
        box-shadow: none !important;
        border: 1px solid #ddd !important;
        break-inside: avoid;
    }
    
    .biodata-content {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
}

/* Animation */
.fade-in {
    animation: fadeIn 0.6s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endpush

@section('content')
<div class="biodata-container">
    <div class="container-fluid px-4">
        <!-- Header -->
        <div class="biodata-header fade-in">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h1>
                    <i class="fas fa-user-graduate"></i>
                    Student Biodata
                </h1>
                <div class="header-actions">
                    <a href="{{ route('studentmanage') }}" class="btn-custom btn-secondary-custom">
                        <i class="fas fa-arrow-left"></i>
                        Back to Students
                    </a>
                    <button onclick="window.print()" class="btn-custom btn-success-custom">
                        <i class="fas fa-print"></i>
                        Print
                    </button>
                </div>
            </div>
        </div>
@php
    $fullName = $student->first_name . ' ' . $student->last_name;
   
    $qrData = http_build_query([
        'name' => $fullName,
        'class' => $student->schoolClass->name . '-' . $student->schoolClass->section,
        'admission_no' => $student->admission_number,
        'roll_no' => $student->roll_number ?? '',
        'status' => $student->status,
    ]);

    $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($qrData);
@endphp
        <!-- Main Content -->
        <div class="biodata-content">
            <!-- Profile Section -->
            <div class="profile-section fade-in">
                <!-- QR Code -->
                <div class="qr-section">
                    <div class="qr-code">
                      <img src="{{ $qrUrl }}" alt="Student QR Code" />
                    </div>
                    <div class="qr-label">Student QR Code</div>
                </div>

                <!-- Profile Header -->
                <div class="profile-header">
                    <img src="{{ $student->photo ? asset('storage/' . $student->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($student->first_name . ' ' . $student->last_name) . '&color=3b82f6&background=dbeafe&size=140' }}" 
                         alt="{{ $student->first_name }} {{ $student->last_name }}" 
                         class="profile-image">
                    
                    <div class="profile-name">{{ $student->first_name }} {{ $student->last_name }}</div>
                    <div class="profile-class">Class {{ $student->schoolClass->name }}-{{ $student->schoolClass->section }}</div>
                </div>

                <!-- Profile Badges -->
                <div class="profile-badges">
                    <div class="badge-custom badge-primary">
                        <i class="fas fa-id-card"></i>
                        {{ $student->admission_number }}
                    </div>
                    @if($student->roll_number)
                    <div class="badge-custom badge-success">
                        <i class="fas fa-hashtag"></i>
                        Roll: {{ $student->roll_number }}
                    </div>
                    @endif
                    <div class="badge-custom badge-{{ $student->status === 'active' ? 'success' : ($student->status === 'inactive' ? 'warning' : 'danger') }}">
                        <i class="fas fa-{{ $student->status === 'active' ? 'check-circle' : ($student->status === 'inactive' ? 'pause-circle' : 'times-circle') }}"></i>
                        {{ ucfirst($student->status) }}
                    </div>
                </div>

                <!-- Profile Stats -->
                <div class="profile-stats">
                    <div class="stat-item">
                        <div class="stat-number">{{ \Carbon\Carbon::parse($student->date_of_birth)->age }}</div>
                        <div class="stat-label">Years Old</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">{{ \Carbon\Carbon::parse($student->admission_date)->format('Y') }}</div>
                        <div class="stat-label">Admission Year</div>
                    </div>
                </div>
            </div>

            <!-- Details Section -->
            <div class="details-section">
                <!-- Personal Information -->
                <div class="info-card fade-in">
                    <div class="card-header">
                        <i class="fas fa-user"></i>
                        Personal Information
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-signature"></i>
                                    First Name
                                </div>
                                <div class="info-value">{{ $student->first_name }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-signature"></i>
                                    Last Name
                                </div>
                                <div class="info-value">{{ $student->last_name ?: 'Not provided' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-calendar"></i>
                                    Date of Birth
                                </div>
                                <div class="info-value">{{ \Carbon\Carbon::parse($student->date_of_birth)->format('F j, Y') }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-venus-mars"></i>
                                    Gender
                                </div>
                                <div class="info-value">{{ ucfirst($student->gender) }}</div>
                            </div>
                            @if($student->blood_group)
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-tint"></i>
                                    Blood Group
                                </div>
                                <div class="info-value">{{ $student->blood_group }}</div>
                            </div>
                            @endif
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-calendar-alt"></i>
                                    Academic Year
                                </div>
                                <div class="info-value">{{ $student->academic_year }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Academic Information -->
                <div class="info-card fade-in">
                    <div class="card-header academic">
                        <i class="fas fa-graduation-cap"></i>
                        Academic Information
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-chalkboard"></i>
                                    Class & Section
                                </div>
                                <div class="info-value">{{ $student->schoolClass->name }}-{{ $student->schoolClass->section }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-user-tie"></i>
                                    Class Teacher
                                </div>
                                <div class="info-value">
                                    {{ $student->schoolClass->classTeacher ? $student->schoolClass->classTeacher->first_name . ' ' . $student->schoolClass->classTeacher->last_name : 'Not Assigned' }}
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-id-badge"></i>
                                    Admission Number
                                </div>
                                <div class="info-value">{{ $student->admission_number }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-calendar-plus"></i>
                                    Admission Date
                                </div>
                                <div class="info-value">{{ \Carbon\Carbon::parse($student->admission_date)->format('F j, Y') }}</div>
                            </div>
                            @if($student->roll_number)
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-hashtag"></i>
                                    Roll Number
                                </div>
                                <div class="info-value">{{ $student->roll_number }}</div>
                            </div>
                            @endif
                            @if($student->schoolClass->room_number)
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-door-open"></i>
                                    Classroom
                                </div>
                                <div class="info-value">
                                    Room {{ $student->schoolClass->room_number }}
                                    @if($student->schoolClass->building)
                                        ({{ $student->schoolClass->building }})
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="info-card fade-in">
                    <div class="card-header contact">
                        <i class="fas fa-address-book"></i>
                        Contact Information
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            @if($student->phone)
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-mobile-alt"></i>
                                    Student Phone
                                </div>
                                <div class="info-value">
                                    <a href="tel:{{ $student->phone }}">{{ $student->phone }}</a>
                                </div>
                            </div>
                            @endif
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-envelope"></i>
                                    Student Email
                                </div>
                                <div class="info-value">
                                    <a href="mailto:{{ $student->email }}">{{ $student->email }}</a>
                                </div>
                            </div>
                            @if($student->address)
                            <div class="info-item" style="grid-column: 1 / -1;">
                                <div class="info-label">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Address
                                </div>
                                <div class="info-value">{{ $student->address }}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Guardian Information -->
                <div class="info-card fade-in">
                    <div class="card-header guardian">
                        <i class="fas fa-users"></i>
                        Guardian Information
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-user-friends"></i>
                                    Guardian Name
                                </div>
                                <div class="info-value">{{ $student->guardian_name }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-heart"></i>
                                    Relationship
                                </div>
                                <div class="info-value">{{ ucfirst($student->guardian_relation) }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-phone"></i>
                                    Guardian Phone
                                </div>
                                <div class="info-value">
                                    <a href="tel:{{ $student->guardian_phone }}">{{ $student->guardian_phone }}</a>
                                </div>
                            </div>
                            @if($student->guardian_email)
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-envelope"></i>
                                    Guardian Email
                                </div>
                                <div class="info-value">
                                    <a href="mailto:{{ $student->guardian_email }}">{{ $student->guardian_email }}</a>
                                </div>
                            </div>
                            @endif
                            @if($student->guardian_occupation)
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-briefcase"></i>
                                    Guardian Occupation
                                </div>
                                <div class="info-value">{{ $student->guardian_occupation }}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- System Information -->
                <div class="info-card fade-in">
                    <div class="card-header system">
                        <i class="fas fa-cog"></i>
                        System Information
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-calendar-plus"></i>
                                    Account Created
                                </div>
                                <div class="info-value">{{ $student->created_at->format('F j, Y g:i A') }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-sync-alt"></i>
                                    Last Updated
                                </div>
                                <div class="info-value">{{ $student->updated_at->format('F j, Y g:i A') }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-id-card"></i>
                                    Student ID
                                </div>
                                <div class="info-value">{{ $student->student_id }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-database"></i>
                                    User ID
                                </div>
                                <div class="info-value">{{ $student->user_id }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add fade-in animation to cards
    const cards = document.querySelectorAll('.info-card, .profile-section');
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.classList.add('fade-in');
        }, index * 100);
    });

    // Enhanced hover effects
    const infoValues = document.querySelectorAll('.info-value');
    infoValues.forEach(value => {
        value.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(5px)';
            this.style.background = 'rgba(59, 130, 246, 0.1)';
        });
        
        value.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
            this.style.background = 'rgba(59, 130, 246, 0.05)';
        });
    });

    // Print functionality
    window.addEventListener('beforeprint', function() {
        document.body.style.background = 'white';
    });

    window.addEventListener('afterprint', function() {
        document.body.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
    });

    // Profile image hover effect
    const profileImage = document.querySelector('.profile-image');
    if (profileImage) {
        profileImage.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05) rotate(2deg)';
        });
        
        profileImage.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotate(0deg)';
        });
    }

    console.log('Student Biodata page loaded successfully');
});
</script>
@endpush