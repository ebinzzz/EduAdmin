@extends('layouts.app')

@section('title', 'Student Management')

@section('page_title')
Students
@endsection

@section('breadcrumb')
Home / User Management / Students
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/student-management.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container main-container">
    <!-- Header with Breadcrumb -->
    <div style="margin-bottom: 1.5rem; padding: 1rem; background-color: #ffffffff; border-radius: 0.5rem; border-left: 4px solid #3b82f6;">
        <nav class="breadcrumb">
            <a href="{{ route('index') }}">
                <i class="fas fa-users"  style="color: #3b82f6; margin-right: 0.75rem;"></i>
                View Students
            </a>
            <i class="fas fa-chevron-right separator" style="color: #3b82f6; margin-right: 0.75rem;"></i>
            <a href="{{ route('sections', ['className' => $class->name, 'academic_year' => $class->academic_year]) }}">
                Class {{ $class->name }}
            </a>
            <i class="fas fa-chevron-right separator"></i>
            <span class="current">Section {{ $class->section }}</span>
        </nav>

        <div class="header-content">
            <div>
                <h1 style="font-size: 2rem;  margin: 0;">
                    <i class="fas fa-graduation-cap"></i>
                    {{ $class->name }}-{{ $class->section }} Students
                </h1>
                <div class="page-meta">
                    <span>
                        <i class="fas fa-calendar"></i>
                        {{ $class->academic_year }}
                    </span>
                    <span>
                        <i class="fas fa-user-tie"></i>
                        {{ $teacherName }}
                    </span>
                    <span>
                        <i class="fas fa-users"></i>
                        {{ $students->count() }} Students
                    </span>
                </div>
            </div>
            <a href="{{ route('sections', ['className' => $class->name, 'academic_year' => $class->academic_year]) }}" 
               class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Back to Sections
            </a>
        </div>
    </div>

    <!-- Class Info Card -->
    <div class="card mb-8">
        <div class="card-body">
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-icon blue">
                        <i class="fas fa-school"></i>
                    </div>
                    <div class="info-content">
                        <p class="label">Class</p>
                        <p class="value">{{ $class->name }}-{{ $class->section }}</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon green">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="info-content">
                        <p class="label">Enrollment</p>
                        <p class="value">{{ $students->count() }}/{{ $class->student_capacity }}</p>
                    </div>
                </div>

                @if($class->room_number)
                <div class="info-item">
                    <div class="info-icon purple">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <div class="info-content">
                        <p class="label">Room</p>
                        <p class="value">{{ $class->room_number }}</p>
                    </div>
                </div>
                @endif

                <div class="info-item">
                    <div class="info-icon orange">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="info-content">
                        <p class="label">Class Teacher</p>
                        <p class="value">{{ $teacherName }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="search-filter-section">
        <div class="search-filter-content">
            <div class="search-wrapper">
                <input type="text" id="searchInput" placeholder="Search students by name or admission number..." 
                       class="search-input">
                <i class="fas fa-search search-icon"></i>
            </div>
            <div class="filter-controls">
                <span class="filter-label">Sort by:</span>
                <select id="sortSelect" class="select-input">
                    <option value="name">Name (A-Z)</option>
                    <option value="name_desc">Name (Z-A)</option>
                    <option value="admission">Admission Number</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Students Grid -->
    @if($students->count() > 0)
        <div id="studentsGrid" class="students-grid">
            @foreach($students as $student)
                <div class="student-card"
                     data-name="{{ strtolower($student->full_name) }}" 
                     data-admission="{{ strtolower($student->admission_number) }}">
                    
                    <!-- Student Card Body -->
                    <div class="student-card-body">
                        <!-- Profile Picture -->
                        <div class="student-profile">
                            <div class="profile-image-wrapper">
                                <img src="{{ $student->photo }}" 
                                     alt="{{ $student->full_name }}"
                                     class="profile-image">
                                
                                <!-- Status Indicator -->
                                <div class="status-indicator">
                                    <i class="fas fa-check"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Student Info -->
                        <div class="text-center mb-4">
                            <h3 class="student-name">{{ $student->full_name }}</h3>
                            <p class="student-admission">
                                <i class="fas fa-id-card"></i>
                                {{ $student->admission_number }}
                            </p>
                            
                            @if($student->roll_number)
                                <span class="roll-number-badge">
                                    Roll No: {{ $student->roll_number }}
                                </span>
                            @endif
                        </div>

                        <!-- Additional Info -->
                        <div class="student-details">
                            @if($student->date_of_birth)
                                <div class="detail-row">
                                    <span class="detail-label">
                                        <i class="fas fa-birthday-cake"></i>
                                        Age
                                    </span>
                                    <span class="detail-value">
                                        {{ \Carbon\Carbon::parse($student->date_of_birth)->age }} years
                                    </span>
                                </div>
                            @endif

                            @if($student->gender)
                                <div class="detail-row">
                                    <span class="detail-label">
                                        <i class="fas fa-user"></i>
                                        Gender
                                    </span>
                                    <span class="detail-value">{{ ucfirst($student->gender) }}</span>
                                </div>
                            @endif

                            @if($student->parent_phone)
                                <div class="detail-row">
                                    <span class="detail-label">
                                        <i class="fas fa-phone"></i>
                                        Contact
                                    </span>
                                    <span class="detail-value">{{ $student->parent_phone }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Action Button -->
                        <div class="student-actions">
                            <a href="{{ route('students.edit', $student->id) }}" 
                               class="btn-edit">
                                <i class="fas fa-edit"></i>
                                Edit Student
                            </a>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="student-card-footer">
                        <span class="join-date">
                            <i class="fas fa-calendar-plus"></i>
                            Joined {{ \Carbon\Carbon::parse($student->admission_date ?? $student->created_at)->format('M Y') }}
                        </span>
                        <span class="status-badge">
                            {{ ucfirst($student->status) }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- No Results Message (Hidden by default) -->
        <div id="noResults" class="no-results hidden">
            <div class="empty-icon">
                <i class="fas fa-search"></i>
            </div>
            <h3 class="empty-title">No Students Found</h3>
            <p class="empty-description">No students match your search criteria.</p>
        </div>
    @else
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <h3 class="empty-title">No Students Enrolled</h3>
            <p class="empty-description">This class section doesn't have any students enrolled yet.</p>
            <a href="{{-- route('students.create') --}}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Add Students
            </a>
        </div>
    @endif
</div>

<!-- Success/Error Messages -->
@if(session('success'))
    <div class="notification success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="notification error">
        <i class="fas fa-exclamation-circle"></i>
        {{ session('error') }}
    </div>
@endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const sortSelect = document.getElementById('sortSelect');
    const studentsGrid = document.getElementById('studentsGrid');
    const noResults = document.getElementById('noResults');
    const studentCards = document.querySelectorAll('.student-card');

    // Search functionality
    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        let visibleCount = 0;

        studentCards.forEach(card => {
            const name = card.dataset.name;
            const admission = card.dataset.admission;
            
            if (name.includes(query) || admission.includes(query)) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Show/hide no results message
        if (visibleCount === 0 && query !== '') {
            noResults.classList.remove('hidden');
            studentsGrid.classList.add('hidden');
        } else {
            noResults.classList.add('hidden');
            studentsGrid.classList.remove('hidden');
        }
    });

    // Sort functionality
    sortSelect.addEventListener('change', function() {
        const sortBy = this.value;
        const cardsArray = Array.from(studentCards);
        
        cardsArray.sort((a, b) => {
            let aValue, bValue;
            
            switch(sortBy) {
                case 'name':
                    aValue = a.dataset.name;
                    bValue = b.dataset.name;
                    return aValue.localeCompare(bValue);
                case 'name_desc':
                    aValue = a.dataset.name;
                    bValue = b.dataset.name;
                    return bValue.localeCompare(aValue);
                case 'admission':
                    aValue = a.dataset.admission;
                    bValue = b.dataset.admission;
                    return aValue.localeCompare(bValue);
                default:
                    return 0;
            }
        });

        // Reorder the cards in the DOM
        cardsArray.forEach(card => {
            studentsGrid.appendChild(card);
        });
    });

    // Auto-hide success/error messages
    const messages = document.querySelectorAll('.notification');
    messages.forEach(message => {
        setTimeout(() => {
            message.style.opacity = '0';
            message.style.transform = 'translateX(100%)';
            setTimeout(() => {
                message.remove();
            }, 300);
        }, 5000);
    });
});
</script>
@endpush

<style>
/* Professional Student Management Dashboard CSS */

/* Reset and Base Styles */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    line-height: 1.6;
    color: #1f2937;
    background-color: #f9fafb;
}

/* Container and Layout */
.container {
    width: 100%;
    margin: 0 auto;
    padding: 0 20px;
}

.main-container {
    padding: 32px 20px;
}

/* Header Section */
.page-header {
    margin-bottom: 32px;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
}

.page-title {
    font-size: 30px;
    font-weight: 700;
    color: #1f2937;
    display: flex;
    align-items: center;
    margin: 0;
}

.page-title i {
    margin-right: 12px;
    color: #3b82f6;
}

.page-meta {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-top: 8px;
    font-size: 14px;
    color: #4b5563;
}

.page-meta span {
    display: flex;
    align-items: center;
}

.page-meta i {
    margin-right: 4px;
}

/* Breadcrumb Navigation */
.breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #4b5563;
    margin-bottom: 16px;
}

.breadcrumb a {
    color: #4b5563;
    text-decoration: none;
    transition: color 0.2s ease;
}

.breadcrumb a:hover {
    color: #3b82f6;
}

.breadcrumb i.separator {
    color: #9ca3af;
}

.breadcrumb .current {
    color: #1f2937;
    font-weight: 500;
}

/* Buttons */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-primary {
    background-color: #3b82f6;
    color: white;
}

.btn-primary:hover {
    background-color: #2563eb;
    color: white;
}

.btn-secondary {
    background-color: #6b7280;
    color: white;
}

.btn-secondary:hover {
    background-color: #4b5563;
    color: white;
}

.btn i {
    margin-right: 8px;
}

/* Cards and Panels */
.card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    border: 1px solid #e5e7eb;
}

.card-body {
    padding: 24px;
}

.card-small {
    padding: 16px;
}

/* Class Info Grid */
.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 24px;
    margin-bottom: 32px;
}

.info-item {
    display: flex;
    align-items: center;
}

.info-icon {
    width: 48px;
    height: 48px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
}

.info-icon.blue {
    background-color: #dbeafe;
}

.info-icon.green {
    background-color: #d1fae5;
}

.info-icon.purple {
    background-color: #e9d5ff;
}

.info-icon.orange {
    background-color: #fed7aa;
}

.info-icon i {
    font-size: 20px;
}

.info-icon.blue i {
    color: #3b82f6;
}

.info-icon.green i {
    color: #10b981;
}

.info-icon.purple i {
    color: #8b5cf6;
}

.info-icon.orange i {
    color: #f59e0b;
}

.info-content .label {
    font-size: 14px;
    color: #4b5563;
    margin-bottom: 2px;
}

.info-content .value {
    font-weight: 600;
    color: #1f2937;
    font-size: 16px;
}

/* Search and Filter Section */
.search-filter-section {
    background: white;
    border-radius: 8px;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    padding: 24px;
    margin-bottom: 32px;
}

.search-filter-content {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

@media (min-width: 768px) {
    .search-filter-content {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }
}

.search-wrapper {
    flex: 1;
    position: relative;
}

.search-input {
    width: 100%;
    padding: 12px 16px 12px 40px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 14px;
    transition: all 0.2s ease;
}

.search-input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
}

.filter-controls {
    display: flex;
    align-items: center;
    gap: 8px;
}

.filter-label {
    font-size: 14px;
    color: #4b5563;
}

.select-input {
    padding: 8px 12px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 14px;
    background: white;
    transition: all 0.2s ease;
}

.select-input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Students Grid */
.students-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 24px;
}

@media (min-width: 768px) {
    .students-grid {
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    }
}

/* Student Card */
.student-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
    overflow: hidden;
}

.student-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px 0 rgba(0, 0, 0, 0.15);
    border-color: #3b82f6;
}

.student-card-body {
    padding: 24px;
}

.student-profile {
    text-align: center;
    margin-bottom: 16px;
}

.profile-image-wrapper {
    position: relative;
    display: inline-block;
    margin-bottom: 16px;
}

.profile-image {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #f3f4f6;
}

.status-indicator {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 24px;
    height: 24px;
    background-color: #10b981;
    border-radius: 50%;
    border: 2px solid white;
    display: flex;
    align-items: center;
    justify-content: center;
}

.status-indicator i {
    color: white;
    font-size: 10px;
}

.student-name {
    font-size: 18px;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 4px;
}

.student-admission {
    font-size: 14px;
    color: #4b5563;
    margin-bottom: 8px;
}

.student-admission i {
    margin-right: 4px;
}

.roll-number-badge {
    display: inline-block;
    padding: 4px 8px;
    background-color: #dbeafe;
    color: #1d4ed8;
    font-size: 12px;
    border-radius: 16px;
    font-weight: 500;
}

.student-details {
    margin-bottom: 16px;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
    font-size: 14px;
}

.detail-label {
    color: #4b5563;
}

.detail-label i {
    margin-right: 4px;
}

.detail-value {
    color: #1f2937;
    font-weight: 500;
}

.student-actions {
    text-align: center;
    margin-bottom: 16px;
}

.btn-edit {
    width: 100%;
    background-color: #3b82f6;
    color: white;
    padding: 10px 16px;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.2s ease;
}

.btn-edit:hover {
    background-color: #2563eb;
    color: white;
}

.btn-edit i {
    margin-right: 8px;
}

.student-card-footer {
    padding: 16px 24px;
    background-color: #f9fafb;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 12px;
    color: #6b7280;
}

.join-date i {
    margin-right: 4px;
}

.status-badge {
    padding: 4px 8px;
    background-color: #d1fae5;
    color: #065f46;
    border-radius: 16px;
    font-weight: 500;
}

/* Empty States and Messages */
.empty-state, .no-results {
    background: white;
    border-radius: 8px;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    border: 1px solid #e5e7eb;
    padding: 48px;
    text-align: center;
}

.empty-icon {
    width: 64px;
    height: 64px;
    background-color: #f3f4f6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px;
}

.empty-icon i {
    font-size: 28px;
    color: #9ca3af;
}

.empty-title {
    font-size: 18px;
    font-weight: 500;
    color: #1f2937;
    margin-bottom: 8px;
}

.empty-description {
    color: #4b5563;
    margin-bottom: 16px;
}

/* Notifications */
.notification {
    position: fixed;
    top: 16px;
    right: 16px;
    z-index: 9999;
    padding: 12px 16px;
    border-radius: 8px;
    box-shadow: 0 4px 12px 0 rgba(0, 0, 0, 0.15);
    animation: slideIn 0.3s ease-out;
    display: flex;
    align-items: center;
    max-width: 400px;
}

.notification i {
    margin-right: 8px;
}

.notification.success {
    background-color: #10b981;
    color: white;
}

.notification.error {
    background-color: #ef4444;
    color: white;
}

@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

/* Utility Classes */
.hidden {
    display: none !important;
}

.text-center {
    text-align: center;
}

.flex {
    display: flex;
}

.items-center {
    align-items: center;
}

.justify-between {
    justify-content: space-between;
}

.space-y-2 > * + * {
    margin-top: 8px;
}

.mb-4 {
    margin-bottom: 16px;
}

.mb-8 {
    margin-bottom: 32px;
}

/* Responsive Design */
@media (max-width: 640px) {
    .container {
        padding-left: 16px;
        padding-right: 16px;
    }
    
    .main-container {
        padding: 16px;
    }
    
    .header-content {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .students-grid {
        grid-template-columns: 1fr;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .search-filter-content {
        flex-direction: column;
        align-items: stretch;
    }
    
    .filter-controls {
        justify-content: space-between;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 24px;
    }
    
    .card-body {
        padding: 16px;
    }
    
    .search-filter-section {
        padding: 16px;
    }
    
    .students-grid {
        gap: 16px;
    }
    
    .student-card-body {
        padding: 16px;
    }
    
    .student-card-footer {
        padding: 12px 16px;
        flex-direction: column;
        gap: 8px;
        align-items: flex-start;
    }
}
    </style>
