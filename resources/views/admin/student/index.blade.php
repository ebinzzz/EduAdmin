@extends('layouts.app')

@section('title', 'Student Management')

@section('page_title')
Students
@endsection

@section('breadcrumb')
Home / User Management / Students
@endsection

<style>
/* Student Management System CSS */

/* Reset and Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f8fafc;
    color: #334155;
    line-height: 1.6;
}

/* Container */
.container {
    width: 100%;
    margin: 0 auto;
    padding: 2rem;
}

/* Header Section */
.page-header {
    margin-bottom: 2rem;
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border-left: 4px solid #3b82f6;
}

.page-title {
    display: flex;
    align-items: center;
    font-size: 2rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.5rem;
}

.page-title i {
    margin-right: 1rem;
    color: #3b82f6;
    font-size: 1.8rem;
}

.page-subtitle {
    color: #64748b;
    font-size: 1rem;
    margin-bottom: 1rem;
}

.breadcrumb {
    font-size: 0.875rem;
    color: #64748b;
}

.breadcrumb a {
    color: #3b82f6;
    text-decoration: none;
}

.breadcrumb a:hover {
    text-decoration: underline;
}

/* Filter Section */
.filter-section {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
}

.filter-title {
    display: flex;
    align-items: center;
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 1.5rem;
}

.filter-title i {
    margin-right: 0.5rem;
    color: #64748b;
}

.filter-form {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    align-items: end;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.5rem;
}

.form-select {
    padding: 0.75rem 1rem;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    font-size: 0.875rem;
    background: white;
    transition: all 0.2s ease;
    appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 1rem;
    padding-right: 2.5rem;
}

.form-select:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.filter-button {
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.filter-button:hover {
    background: linear-gradient(135deg, #1d4ed8, #1e40af);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

/* Classes Grid */
.classes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.class-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    cursor: pointer;
    border: 2px solid transparent;
    overflow: hidden;
    position: relative;
}

.class-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    border-color: #3b82f6;
}

.class-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #3b82f6, #8b5cf6);
}

.class-header {
    padding: 2rem;
    border-bottom: 1px solid #f1f5f9;
}

.class-title-section {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.5rem;
}

.class-info {
    display: flex;
    align-items: center;
}

.class-icon {
    width: 3rem;
    height: 3rem;
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 1.25rem;
    margin-right: 1rem;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.class-details h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.5rem;
}

.grade-badge {
    background: #dbeafe;
    color: #1d4ed8;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
}

.chevron-icon {
    color: #cbd5e1;
    font-size: 1rem;
    transition: transform 0.2s ease;
}

.class-card:hover .chevron-icon {
    transform: translateX(4px);
    color: #3b82f6;
}

/* Statistics */
.class-stats {
    padding: 0 2rem 2rem;
}

.stat-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f8fafc;
}

.stat-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.stat-label {
    display: flex;
    align-items: center;
    font-size: 0.875rem;
    color: #64748b;
}

.stat-label i {
    margin-right: 0.5rem;
    width: 1rem;
}

.stat-value {
    font-weight: 600;
    color: #1e293b;
}

.academic-year {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    font-size: 0.75rem;
    color: #64748b;
}

.academic-year i {
    margin-right: 0.5rem;
}

/* Click to view sections */
.class-footer {
    padding: 0 2rem 1.5rem;
    text-align: center;
}

.view-sections-text {
    font-size: 0.75rem;
    color: #3b82f6;
    font-weight: 500;
    opacity: 0.8;
    transition: opacity 0.2s ease;
}

.class-card:hover .view-sections-text {
    opacity: 1;
}

/* No Classes Found */
.no-classes {
    text-align: center;
    background: white;
    padding: 4rem 2rem;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.no-classes-icon {
    width: 4rem;
    height: 4rem;
    background: #f1f5f9;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
}

.no-classes-icon i {
    font-size: 1.5rem;
    color: #94a3b8;
}

.no-classes h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.5rem;
}

.no-classes p {
    color: #64748b;
    margin-bottom: 1.5rem;
}

.clear-filters-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.clear-filters-btn:hover {
    background: linear-gradient(135deg, #1d4ed8, #1e40af);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

/* Summary Cards */
.summary-section {
    margin-top: 3rem;
}

.summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.summary-card {
    padding: 2rem;
    border-radius: 12px;
    color: white;
    position: relative;
    overflow: hidden;
}

.summary-card::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    transform: scale(0);
    transition: transform 0.3s ease;
}

.summary-card:hover::before {
    transform: scale(1);
}

.summary-card.blue {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
}

.summary-card.green {
    background: linear-gradient(135deg, #10b981, #059669);
}

.summary-card.purple {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
}

.summary-content {
    display: flex;
    align-items: center;
    position: relative;
    z-index: 1;
}

.summary-icon {
    width: 3rem;
    height: 3rem;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1.5rem;
}

.summary-icon i {
    font-size: 1.25rem;
}

.summary-text h4 {
    font-size: 0.875rem;
    opacity: 0.9;
    margin-bottom: 0.25rem;
    font-weight: 500;
}

.summary-text .number {
    font-size: 2rem;
    font-weight: 700;
}

/* Flash Messages */
.flash-message {
    position: fixed;
    top: 2rem;
    right: 2rem;
    padding: 1rem 1.5rem;
    border-radius: 8px;
    color: white;
    font-weight: 500;
    z-index: 1000;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    transition: opacity 0.3s ease;
}

.flash-message.success {
    background: linear-gradient(135deg, #10b981, #059669);
}

.flash-message.error {
    background: linear-gradient(135deg, #ef4444, #dc2626);
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 1rem;
    }
    
    .page-header {
        padding: 1.5rem;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
    
    .filter-form {
        grid-template-columns: 1fr;
    }
    
    .classes-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .summary-grid {
        grid-template-columns: 1fr;
    }
    
    .class-header {
        padding: 1.5rem;
    }
    
    .class-stats {
        padding: 0 1.5rem 1.5rem;
    }
    
    .class-footer {
        padding: 0 1.5rem 1rem;
    }
}

@media (max-width: 480px) {
    .class-title-section {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .class-info {
        width: 100%;
    }
    
    .chevron-icon {
        align-self: flex-end;
    }
}
</style>

@section('content')
<div class="container">
    
    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">
            <i class="fas fa-users"></i>
            View Students
        </h1>
        <p class="page-subtitle">Select a class to view students</p>
        <div class="breadcrumb">
            <a href="#" onclick="history.back()">Home</a> / User Management / Students
        </div>
    </div>

         @if($classes->count() > 0)
        <div class="summary-section">
            <div class="summary-grid">
                <div class="summary-card blue">
                    <div class="summary-content">
                        <div class="summary-icon">
                            <i class="fas fa-school"></i>
                        </div>
                        <div class="summary-text">
                            <h4>Total Classes</h4>
                            <div class="number">{{ number_format($classes->count()) }}</div>
                        </div>
                    </div>
                </div>

                <div class="summary-card green">
                    <div class="summary-content">
                        <div class="summary-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="summary-text">
                            <h4>Total Students</h4>
                            <div class="number">{{ number_format($classes->sum('total_students')) }}</div>
                        </div>
                    </div>
                </div>

                <div class="summary-card purple">
                    <div class="summary-content">
                        <div class="summary-icon">
                            <i class="fas fa-door-open"></i>
                        </div>
                        <div class="summary-text">
                            <h4>Total Sections</h4>
                            <div class="number">{{ number_format($classes->sum('sections_count')) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Filters -->
    <div class="filter-section">
        <h3 class="filter-title">
            <i class="fas fa-filter"></i>
            Filter Classes
        </h3>
        
        <form method="GET" class="filter-form">
            <!-- Academic Year Filter -->
            <div class="form-group">
                <label for="academic_year" class="form-label">Academic Year</label>
                <select name="academic_year" id="academic_year" class="form-select">
                    <option value="">All Academic Years</option>
                    @foreach($academicYears as $year)
                        <option value="{{ $year }}" {{ request('academic_year') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Grade Type Filter -->
            <div class="form-group">
                <label for="grade_type" class="form-label">Grade Type</label>
                <select name="grade_type" id="grade_type" class="form-select">
                    <option value="">All Grade Types</option>
                    @foreach($gradeTypes as $key => $label)
                        <option value="{{ $key }}" {{ request('grade_type') == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Button -->
            <div class="form-group">
                <button type="submit" class="filter-button">
                    <i class="fas fa-search"></i>
                    Apply Filters
                </button>
            </div>
        </form>
    </div>

    <!-- Classes Grid -->
    @if($classes->count() > 0)
        <div class="classes-grid">
            @foreach($classes as $class)
                <div class="class-card"
                     onclick="navigateToSections('{{ $class->name }}', '{{ request('academic_year', '2024-2025') }}')"
                     tabindex="0" 
                     role="button"
                     onkeydown="handleKeyNavigation(event, '{{ $class->name }}', '{{ request('academic_year', '2024-2025') }}')">
                    
                    <!-- Class Header -->
                    <div class="class-header">
                        <div class="class-title-section">
                            <div class="class-info">
                                <div class="class-icon">
                                    {{ $class->name }}
                                </div>
                                <div class="class-details">
                                    <h3>Class {{ $class->name }}</h3>
                                    <span class="grade-badge">
                                        {{ ucfirst(str_replace('_', ' ', $class->grade_type)) }}
                                    </span>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right chevron-icon"></i>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="class-stats">
                        <div class="stat-item">
                            <span class="stat-label">
                                <i class="fas fa-users"></i>
                                Total Students
                            </span>
                            <span class="stat-value">{{ number_format($class->total_students) }}</span>
                        </div>
                        
                        <div class="stat-item">
                            <span class="stat-label">
                                <i class="fas fa-door-open"></i>
                                Sections
                            </span>
                            <span class="stat-value">{{ $class->sections_count }}</span>
                        </div>

                        <div class="academic-year">
                            <i class="fas fa-calendar"></i>
                            {{ request('academic_year', '2024-2025') }}
                        </div>
                    </div>

                    <!-- Hover Effect -->
                    <div class="class-footer">
                        <span class="view-sections-text">
                            Click to view sections →
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- No Classes Found -->
        <div class="no-classes">
            <div class="no-classes-icon">
                <i class="fas fa-search"></i>
            </div>
            <h3>No Classes Found</h3>
            <p>No classes match your current filter criteria.</p>
            <a href="{{ route('index') }}" class="clear-filters-btn">
                <i class="fas fa-refresh"></i>
                Clear Filters
            </a>
        </div>
    @endif

    <!-- Summary Cards -->
   
</div>

<!-- Success/Error Messages -->
@if(session('success'))
    <div class="flash-message success">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="flash-message error">
        <i class="fas fa-exclamation-circle"></i>
        {{ session('error') }}
    </div>
@endif

@push('scripts')
<script>
    // Navigation functions
    function navigateToSections(className, academicYear) {
        window.location.href = "{{ route('sections', ['className' => ':className', 'academic_year' => ':academic_year']) }}"
            .replace(':className', className)
            .replace(':academic_year', academicYear);
    }

    function handleKeyNavigation(event, className, academicYear) {
        if (event.key === 'Enter' || event.key === ' ') {
            event.preventDefault();
            navigateToSections(className, academicYear);
        }
    }

    // Auto-hide flash messages
    document.addEventListener('DOMContentLoaded', function() {
        const messages = document.querySelectorAll('.flash-message');
        messages.forEach(message => {
            setTimeout(() => {
                message.style.opacity = '0';
                setTimeout(() => message.remove(), 300);
            }, 3000);
        });
    });
</script>
@endpush
@endsection