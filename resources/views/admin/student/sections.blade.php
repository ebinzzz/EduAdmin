@extends('layouts.app')

@section('title', 'Class ' . $className . ' Sections')

<style>
/* Enhanced Sections Dashboard CSS */

/* Base Styles */
.glass-effect {
    backdrop-filter: blur(10px) !important;
    background: rgba(255, 255, 255, 0.9) !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
}

.gradient-bg {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}

/* Section Card Animations */
.section-card {
    transition: all 0.3s ease !important;
    position: relative !important;
    overflow: hidden !important;
    background: white !important;
    border-radius: 0.5rem !important;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06) !important;
    border: 1px solid #e5e7eb !important;
}

.section-card:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    border-color: #3b82f6 !important;
}

.section-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    transition: left 0.5s;
    z-index: 1;
}

.section-card:hover::before {
    left: 100%;
}

/* Ensure content stays above the shine effect */
.section-card > * {
    position: relative;
    z-index: 2;
}

/* Dropdown Menu Styles */
.dropdown-menu {
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    border-radius: 8px !important;
    overflow: hidden !important;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    background: white !important;
    border: 1px solid #e5e7eb !important;
}

.dropdown-menu.show {
    opacity: 1 !important;
    visibility: visible !important;
    transform: translateY(0) !important;
}

.dropdown-menu a {
    transition: all 0.2s ease !important;
    display: block !important;
    padding: 0.5rem 1rem !important;
    color: #374151 !important;
    text-decoration: none !important;
}

.dropdown-menu a:hover {
    background-color: #f8fafc !important;
    padding-left: 1.2rem !important;
    color: #1f2937 !important;
}

/* Progress Bar Animations */
.progress-bar {
    background: linear-gradient(90deg, #3b82f6, #1d4ed8) !important;
    position: relative !important;
    overflow: hidden !important;
    border-radius: 9999px !important;
    height: 0.5rem !important;
}

.progress-bar::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background-image: linear-gradient(
        -45deg,
        rgba(255, 255, 255, 0.2) 25%,
        transparent 25%,
        transparent 50%,
        rgba(255, 255, 255, 0.2) 50%,
        rgba(255, 255, 255, 0.2) 75%,
        transparent 75%,
        transparent
    );
    background-size: 1rem 1rem;
    animation: move 1s linear infinite;
}

@keyframes move {
    0% {
        background-position: 0 0;
    }
    100% {
        background-position: 1rem 0;
    }
}

/* Button Styles */
.btn-primary {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%) !important;
    transition: all 0.3s ease !important;
    position: relative !important;
    overflow: hidden !important;
    color: white !important;
    border: none !important;
    padding: 0.5rem 1rem !important;
    border-radius: 0.375rem !important;
    font-weight: 500 !important;
    text-decoration: none !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%) !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3) !important;
    color: white !important;
    text-decoration: none !important;
}

.btn-secondary {
    background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%) !important;
    transition: all 0.3s ease !important;
    color: white !important;
    border: none !important;
    padding: 0.5rem 1rem !important;
    border-radius: 0.375rem !important;
    font-weight: 500 !important;
}

.btn-secondary:hover {
    background: linear-gradient(135deg, #4b5563 0%, #374151 100%) !important;
    transform: translateY(-1px) !important;
    color: white !important;
}

.btn-disabled {
    background: #d1d5db !important;
    color: #6b7280 !important;
    cursor: not-allowed !important;
    border: none !important;
    padding: 0.5rem 1rem !important;
    border-radius: 0.375rem !important;
    font-weight: 500 !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
}

/* Filter Button Styles */
.filter-btn {
    transition: all 0.3s ease !important;
    position: relative !important;
    padding: 0.5rem !important;
    border-radius: 0.375rem !important;
    color: #374151 !important;
    background: transparent !important;
    border: none !important;
    width: 100% !important;
    text-align: left !important;
}

.filter-btn:hover {
    transform: translateX(4px) !important;
    background-color: #eff6ff !important;
    color: #1d4ed8 !important;
}

.filter-btn.active {
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%) !important;
    border-left: 3px solid #3b82f6 !important;
    color: #1d4ed8 !important;
}

.grade-filter-btn {
    transition: all 0.3s ease !important;
    position: relative !important;
    padding: 0.5rem !important;
    border-radius: 0.375rem !important;
    color: #374151 !important;
    background: transparent !important;
    border: none !important;
    width: 100% !important;
    text-align: left !important;
}

.grade-filter-btn:hover {
    transform: translateX(4px) !important;
    background-color: #f0fdf4 !important;
    color: #059669 !important;
}

.grade-filter-btn.active {
    background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%) !important;
    border-left: 3px solid #10b981 !important;
    color: #059669 !important;
}

/* Search Input Styles */
#search-sections {
    transition: all 0.3s ease !important;
    border: 2px solid #e5e7eb !important;
    padding: 0.5rem 1rem !important;
    padding-left: 2.5rem !important;
    border-radius: 0.375rem !important;
    width: 100% !important;
}

#search-sections:focus {
    border-color: #3b82f6 !important;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
    transform: scale(1.02) !important;
    outline: none !important;
}

/* Status Badge Styles */
.status-badge-active {
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%) !important;
    color: #065f46 !important;
    animation: pulse 2s infinite;
    padding: 0.25rem 0.5rem !important;
    border-radius: 9999px !important;
    font-size: 0.75rem !important;
    font-weight: 500 !important;
}

.status-badge-inactive {
    background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%) !important;
    color: #374151 !important;
    padding: 0.25rem 0.5rem !important;
    border-radius: 9999px !important;
    font-size: 0.75rem !important;
    font-weight: 500 !important;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.8;
    }
}

/* Section Letter Icons */
.section-icon {
    width: 3.5rem !important;
    height: 3.5rem !important;
    border-radius: 0.5rem !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    color: white !important;
    font-weight: bold !important;
    font-size: 1.125rem !important;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
}

.section-icon-a {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%) !important;
}

.section-icon-b {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
}

.section-icon-c {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%) !important;
}

.section-icon-d {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
}

/* Analytics Cards */
.analytics-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%) !important;
    border: 1px solid #e2e8f0 !important;
    transition: all 0.3s ease !important;
    position: relative !important;
    overflow: hidden !important;
    border-radius: 0.5rem !important;
    padding: 1.5rem !important;
}

.analytics-card:hover {
    transform: translateY(-3px) !important;
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12) !important;
}

.analytics-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #3b82f6, #8b5cf6, #10b981, #f59e0b);
}

/* Capacity Progress Bars */
.capacity-progress {
    background: #e5e7eb !important;
    border-radius: 9999px !important;
    overflow: hidden !important;
    position: relative !important;
    height: 0.5rem !important;
    width: 100% !important;
}

.capacity-fill {
    background: linear-gradient(90deg, #3b82f6 0%, #1d4ed8 100%) !important;
    border-radius: 9999px !important;
    transition: width 1s ease-in-out !important;
    position: relative !important;
    height: 100% !important;
}

.capacity-fill::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% {
        transform: translateX(-100%);
    }
    100% {
        transform: translateX(100%);
    }
}

/* Distribution Charts */
.distribution-bar {
    background: #e5e7eb !important;
    border-radius: 9999px !important;
    overflow: hidden !important;
    height: 0.5rem !important;
    width: 5rem !important;
}

.distribution-fill-blue {
    background: linear-gradient(90deg, #3b82f6 0%, #1d4ed8 100%) !important;
    border-radius: 9999px !important;
    transition: width 0.8s ease-in-out !important;
    height: 100% !important;
}

.distribution-fill-green {
    background: linear-gradient(90deg, #10b981 0%, #059669 100%) !important;
    border-radius: 9999px !important;
    transition: width 0.8s ease-in-out !important;
    height: 100% !important;
}

/* Loading Animations */
.loading-pulse {
    animation: pulse 1.5s ease-in-out infinite;
}

/* Breadcrumb Styles */
.breadcrumb a {
    transition: all 0.2s ease !important;
    color: #6b7280 !important;
    text-decoration: none !important;
}

.breadcrumb a:hover {
    color: #3b82f6 !important;
    transform: translateX(2px) !important;
}

/* Layout Styles */
.sections-grid {
    display: grid !important;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)) !important;
    gap: 1.5rem !important;
}

.sections-list {
    display: flex !important;
    flex-direction: column !important;
    gap: 1rem !important;
}

.main-container {
    width:100%;
    margin: 0 auto !important;
    padding: 1.5rem !important;
}

.sidebar-container {
    width: 100%;
    min-height: 100vh !important;
    background: white !important;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
}

/* No Results Animation */
#no-results {
    animation: fadeIn 0.5s ease-in-out;
    text-align: center !important;
    padding: 3rem !important;
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

/* Utility Classes */
.flex {
    display: flex !important;
}

.items-center {
    align-items: center !important;
}

.justify-between {
    justify-content: space-between !important;
}

.mb-4 {
    margin-bottom: 1rem !important;
}

.mb-6 {
    margin-bottom: 1.5rem !important;
}

.p-6 {
    padding: 1.5rem !important;
}

.text-xl {
    font-size: 1.25rem !important;
    line-height: 1.75rem !important;
}

.font-semibold {
    font-weight: 600 !important;
}

.text-gray-800 {
    color: #1f2937 !important;
}

.text-gray-600 {
    color: #4b5563 !important;
}

.text-sm {
    font-size: 0.875rem !important;
    line-height: 1.25rem !important;
}

.bg-blue-100 {
    background-color: #dbeafe !important;
}

.text-blue-700 {
    color: #1d4ed8 !important;
}

.rounded-full {
    border-radius: 9999px !important;
}

.px-2 {
    padding-left: 0.5rem !important;
    padding-right: 0.5rem !important;
}

.py-1 {
    padding-top: 0.25rem !important;
    padding-bottom: 0.25rem !important;
}

.space-y-3 > * + * {
    margin-top: 0.75rem !important;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .sections-grid {
        grid-template-columns: 1fr !important;
    }
    
    .main-container {
        padding: 1rem !important;
    }
    
    .sidebar-container {
        width: 100% !important;
        min-height: auto !important;
    }
}
</style>

@section('sidebar')
<!-- Extended Sidebar Content -->
<div class="sidebar-container">
    <div style="padding: 1rem 0.75rem;">
        <!-- Current Class Indicator -->
         
        <div style="margin-bottom: 1.5rem; padding: 1rem; background-color: #eff6ff; border-radius: 0.5rem; border-left: 4px solid #3b82f6;">
            <div class="flex items-center">
                <i class="fas fa-school" style="color: #3b82f6; margin-right: 0.75rem;"></i>
                <div>
                    <h3 style="font-weight: 600; color: #1f2937; margin: 0;">Current Class</h3>
                    <p style="font-size: 0.875rem; color: #4b5563; margin: 0;">Class {{ $className }}</p>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div style="margin-bottom: 1.5rem;">
            <h4 style="font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.75rem;">Quick Stats</h4>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.5rem; background-color: #f9fafb; border-radius: 0.375rem;">
                    <span style="font-size: 0.875rem; color: #4b5563;">Total Sections</span>
                    <span style="font-size: 0.875rem; font-weight: bold; color: #3b82f6;">{{ $sections->count() }}</span>
                </div>
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.5rem; background-color: #f9fafb; border-radius: 0.375rem;">
                    <span style="font-size: 0.875rem; color: #4b5563;">Total Students</span>
                    <span style="font-size: 0.875rem; font-weight: bold; color: #10b981;">{{ $sections->sum('student_count') }}</span>
                </div>
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.5rem; background-color: #f9fafb; border-radius: 0.375rem;">
                    <span style="font-size: 0.875rem; color: #4b5563;">Capacity</span>
                    <span style="font-size: 0.875rem; font-weight: bold; color: #8b5cf6;">{{ $sections->sum('student_capacity') }}</span>
                </div>
            </div>
        </div>

        <!-- Section Filter -->
        <div style="margin-bottom: 1.5rem;">
            <h4 style="font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.75rem;">Filter Sections</h4>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <button class="filter-btn" data-filter="all">
                    <i class="fas fa-list" style="margin-right: 0.5rem;"></i>All Sections
                </button>
                @foreach($sections->unique('section') as $section)
                <button class="filter-btn" data-filter="section-{{ $section->section }}">
                    <i class="fas fa-filter" style="margin-right: 0.5rem;"></i>Section {{ $section->section }}
                </button>
                @endforeach
            </div>
        </div>

        <!-- Grade Type Filter -->
        <div style="margin-bottom: 1.5rem;">
            <h4 style="font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.75rem;">Grade Types</h4>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                @foreach($sections->unique('grade_type') as $section)
                <button class="grade-filter-btn" data-grade="{{ $section->grade_type }}">
                    <i class="fas fa-tag" style="margin-right: 0.5rem;"></i>{{ ucfirst(str_replace('_', ' ', $section->grade_type)) }}
                </button>
                @endforeach
            </div>
        </div>

        <!-- Quick Actions -->
        <div style="margin-bottom: 1.5rem;">
            <h4 style="font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.75rem;">Quick Actions</h4>
            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <a href="{{ route('index') }}" style="display: flex; align-items: center; padding: 0.5rem; font-size: 0.875rem; color: #374151; text-decoration: none; border-radius: 0.375rem; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'">
                    <i class="fas fa-arrow-left" style="margin-right: 0.5rem;"></i>Back to Classes
                </a>
                <button style="display: flex; align-items: center; padding: 0.5rem; font-size: 0.875rem; color: #374151; background: transparent; border: none; border-radius: 0.375rem; transition: background-color 0.2s; width: 100%; text-align: left;" onclick="window.print()" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'">
                    <i class="fas fa-print" style="margin-right: 0.5rem;"></i>Print Report
                </button>
                <button style="display: flex; align-items: center; padding: 0.5rem; font-size: 0.875rem; color: #374151; background: transparent; border: none; border-radius: 0.375rem; transition: background-color 0.2s; width: 100%; text-align: left;" onclick="exportData()" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'">
                    <i class="fas fa-download" style="margin-right: 0.5rem;"></i>Export Data
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="main-container">
    <!-- Header Section -->
    <div class="glass-effect" style="border-radius: 0.5rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06); padding: 1.5rem; border: 1px solid #e5e7eb; margin-bottom: 1.5rem;">
        <!-- Breadcrumb -->
        <nav class="breadcrumb" style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; color: #4b5563; margin-bottom: 1rem;">
            <a href="{{ route('index') }}">
                <i class="fas fa-users" style="margin-right: 0.25rem;"></i>
                View Students
            </a>
            <i class="fas fa-chevron-right" style="color: #9ca3af;"></i>
            <span style="color: #1f2937; font-weight: 500;">Class {{ $className }}</span>
        </nav>

        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <div>
                <h1 style="font-size: 1.875rem; font-weight: bold; color: #1f2937; display: flex; align-items: center; margin: 0;">
                    <i class="fas fa-school" style="margin-right: 0.75rem; color: #3b82f6;"></i>
                    Class {{ $className }} Sections
                </h1>
                <p style="color: #4b5563; margin-top: 0.5rem; margin-bottom: 0;">{{ $academicYear }} Academic Year</p>
            </div>
            
            <!-- Action Buttons -->
            <div style="display: flex; gap: 0.5rem;">
                <button id="grid-view" class="btn-primary">
                    <i class="fas fa-th" style="margin-right: 0.5rem;"></i>Grid View
                </button>
                <button id="list-view" class="btn-secondary">
                    <i class="fas fa-list" style="margin-right: 0.5rem;"></i>List View
                </button>
            </div>
        </div>
    </div>

    <!-- Search and Filter Bar -->
    <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06); padding: 1rem; border: 1px solid #e5e7eb; margin-bottom: 1.5rem;">
        <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
            <div style="flex: 1; position: relative; min-width: 200px;">
                <input type="text" id="search-sections" placeholder="Search sections, teachers, or rooms...">
                <i class="fas fa-search" style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); color: #9ca3af;"></i>
            </div>
            <div style="display: flex; gap: 0.5rem;">
                <select id="status-filter" style="padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; color: #374151;">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                <button id="clear-filters" style="padding: 0.5rem 1rem; background-color: #e5e7eb; color: #374151; border-radius: 0.375rem; border: none; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#d1d5db'" onmouseout="this.style.backgroundColor='#e5e7eb'">
                    <i class="fas fa-times" style="margin-right: 0.25rem;"></i>Clear
                </button>
            </div>
        </div>
    </div>

    <!-- Sections Grid -->
    <div id="sections-container" class="sections-grid">
        @foreach($sections as $section)
            <div class="section-card" 
                 data-section="{{ $section->section }}" 
                 data-grade="{{ $section->grade_type }}" 
                 data-status="{{ $section->status }}"
                 data-teacher="{{ strtolower($section->teacher_name) }}"
                 data-room="{{ strtolower($section->room_number ?? '') }}">
                
                <!-- Section Header -->
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div class="section-icon section-icon-{{ strtolower($section->section) }}">
                                {{ $section->section }}
                            </div>
                        
                        <!-- Status Badge -->
                        <span class="{{ $section->status === 'active' ? 'status-badge-active' : 'status-badge-inactive' }}">
                            {{ ucfirst($section->status) }}
                        </span>
                    </div>
                        

                            <div style="margin-left: 1rem;">
                                <h3 class="text-xl font-semibold text-gray-800" style="margin: 0;">
                                    {{ $className }}-{{ $section->section }}
                                </h3>
                                <span class="text-sm px-2 py-1 bg-blue-100 text-blue-700 rounded-full" style="display: inline-block; margin-top: 0.25rem;">
                                    {{ ucfirst(str_replace('_', ' ', $section->grade_type)) }}
                                </span>
                            </div>
                        </div>
                    <!-- Section Details -->
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">
                                <i class="fas fa-users" style="margin-right: 0.5rem;"></i>
                                Students
                            </span>
                            <span style="font-size: 0.875rem; font-weight: 500; color: #1f2937;">
                                {{ $section->student_count }}/{{ $section->student_capacity }}
                            </span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">
                                <i class="fas fa-user-tie" style="margin-right: 0.5rem;"></i>
                                Class Teacher
                            </span>
                            <span style="font-size: 0.875rem; font-weight: 500; color: #1f2937; max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $section->teacher_name }}">
                                {{ $section->teacher_name }}
                            </span>
                        </div>

                        @if($section->room_number)
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">
                                    <i class="fas fa-door-open" style="margin-right: 0.5rem;"></i>
                                    Room
                                </span>
                                <span style="font-size: 0.875rem; font-weight: 500; color: #1f2937;">
                                    {{ $section->room_number }}
                                    @if($section->building)
                                        <span style="color: #6b7280;">({{ $section->building }})</span>
                                    @endif
                                </span>
                            </div>
                        @endif

                        @if($section->floor_number !== null)
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">
                                    <i class="fas fa-layer-group" style="margin-right: 0.5rem;"></i>
                                    Floor
                                </span>
                                <span style="font-size: 0.875rem; font-weight: 500; color: #1f2937;">
                                    {{ $section->floor_number === 0 ? 'Ground' : $section->floor_number }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Capacity Progress Bar -->
                    <div style="margin-bottom: 1.5rem;">
                        <div style="display: flex; justify-content: space-between; font-size: 0.75rem; color: #4b5563; margin-bottom: 0.25rem;">
                            <span>Capacity</span>
                            <span>{{ $section->student_capacity > 0 ? round(($section->student_count / $section->student_capacity) * 100) : 0 }}%</span>
                        </div>
                        <div class="capacity-progress">
                            <div class="capacity-fill" style="width: {{ $section->student_capacity > 0 ? min(($section->student_count / $section->student_capacity) * 100, 100) : 0 }}%"></div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div style="display: flex; gap: 0.5rem;">
                        @if($section->student_count > 0)
                            <a href="{{ route('show', $section->id) }}" class="btn-primary" style="flex: 1;">
                                <i class="fas fa-eye" style="margin-right: 0.5rem;"></i>
                                View Students
                            </a>
                        @else
                            <div class="btn-disabled" style="flex: 1;">
                                <i class="fas fa-exclamation-circle" style="margin-right: 0.5rem;"></i>
                                No Students
                            </div>
                        @endif
                        
                        <!-- Quick Actions Dropdown -->
                        <div style="position: relative;">
                            <button class="btn-secondary dropdown-toggle" data-section-id="{{ $section->id }}" style="padding: 0.75rem;">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu" style="position: absolute; right: 0; margin-top: .10rem; width: 12rem; z-index: 10;">
                               
                                <a href="#" onclick="exportStudents({{ $section->id }})">
                                    <i class="fas fa-file-export" style="margin-right: 0.5rem;"></i>Export Students
                                </a>
                                <a href="#" onclick="viewAnalytics({{ $section->id }})">
                                    <i class="fas fa-chart-bar" style="margin-right: 0.5rem;"></i>View Analytics
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Footer -->
                <div style="padding: 0 1.5rem 1rem 1.5rem; background-color: #f9fafb; border-radius: 0 0 0.5rem 0.5rem;">
                    <div style="display: flex; align-items: center; justify-content: space-between; font-size: 0.75rem; color: #6b7280;">
                        <span>
                            <i class="fas fa-calendar" style="margin-right: 0.25rem;"></i>
                            {{ $academicYear }}
                        </span>
                        <span style="display: flex; align-items: center;">
                            <i class="fas fa-clock" style="margin-right: 0.25rem;"></i>
                            Last updated: Today
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Enhanced Summary Section -->
    <div style="background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06); padding: 1.5rem; border: 1px solid #e5e7eb; margin-top: 1.5rem;">
        <h3 style="font-size: 1.125rem; font-weight: 600; color: #1f2937; margin-bottom: 1.5rem; display: flex; align-items: center; margin-top: 0;">
            <i class="fas fa-chart-bar" style="margin-right: 0.5rem; color: #4b5563;"></i>
            Class {{ $className }} Analytics
        </h3>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem;">
            <div class="analytics-card" style="text-align: center;">
                <div style="font-size: 1.875rem; font-weight: bold; color: #3b82f6; margin-bottom: 0.25rem;">{{ $sections->count() }}</div>
                <div style="font-size: 0.875rem; color: #4b5563;">Total Sections</div>
                <div style="font-size: 0.75rem; color: #3b82f6; margin-top: 0.25rem;">Active: {{ $sections->where('status', 'active')->count() }}</div>
            </div>
            
            <div class="analytics-card" style="text-align: center;">
                <div style="font-size: 1.875rem; font-weight: bold; color: #10b981; margin-bottom: 0.25rem;">{{ $sections->sum('student_count') }}</div>
                <div style="font-size: 0.875rem; color: #4b5563;">Total Students</div>
                <div style="font-size: 0.75rem; color: #10b981; margin-top: 0.25rem;">Enrolled Students</div>
            </div>
            
            <div class="analytics-card" style="text-align: center;">
                <div style="font-size: 1.875rem; font-weight: bold; color: #8b5cf6; margin-bottom: 0.25rem;">{{ $sections->sum('student_capacity') }}</div>
                <div style="font-size: 0.875rem; color: #4b5563;">Total Capacity</div>
                <div style="font-size: 0.75rem; color: #8b5cf6; margin-top: 0.25rem;">Maximum Students</div>
            </div>
            
            <div class="analytics-card" style="text-align: center;">
                <div style="font-size: 1.875rem; font-weight: bold; color: #f59e0b; margin-bottom: 0.25rem;">
                    {{ $sections->sum('student_capacity') > 0 ? round(($sections->sum('student_count') / $sections->sum('student_capacity')) * 100) : 0 }}%
                </div>
                <div style="font-size: 0.875rem; color: #4b5563;">Utilization Rate</div>
                <div style="font-size: 0.75rem; color: #f59e0b; margin-top: 0.25rem;">
                    {{ $sections->sum('student_capacity') - $sections->sum('student_count') }} spots available
                </div>
            </div>
        </div>

        <!-- Additional Analytics -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
            <div>
                <h4 style="font-size: 1rem; font-weight: 500; color: #374151; margin-bottom: 0.75rem;">Section Distribution</h4>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    @foreach($sections->groupBy('section') as $sectionLetter => $sectionGroup)
                    <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.5rem; background-color: #f9fafb; border-radius: 0.375rem;">
                        <span style="font-size: 0.875rem; color: #4b5563;">Section {{ $sectionLetter }}</span>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span style="font-size: 0.875rem; font-weight: 500;">{{ $sectionGroup->sum('student_count') }} students</span>
                            <div class="distribution-bar">
                                <div class="distribution-fill-blue" style="width: {{ $sections->sum('student_count') > 0 ? ($sectionGroup->sum('student_count') / $sections->sum('student_count')) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div>
                <h4 style="font-size: 1rem; font-weight: 500; color: #374151; margin-bottom: 0.75rem;">Grade Type Distribution</h4>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    @foreach($sections->groupBy('grade_type') as $gradeType => $gradeGroup)
                    <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.5rem; background-color: #f9fafb; border-radius: 0.375rem;">
                        <span style="font-size: 0.875rem; color: #4b5563;">{{ ucfirst(str_replace('_', ' ', $gradeType)) }}</span>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span style="font-size: 0.875rem; font-weight: 500;">{{ $gradeGroup->count() }} sections</span>
                            <div class="distribution-bar">
                                <div class="distribution-fill-green" style="width: {{ $sections->count() > 0 ? ($gradeGroup->count() / $sections->count()) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- No Results Message -->
<div id="no-results" style="display: none;">
    <i class="fas fa-search" style="color: #9ca3af; font-size: 2.5rem; margin-bottom: 1rem;"></i>
    <h3 style="font-size: 1.125rem; font-weight: 500; color: #4b5563; margin-bottom: 0.5rem;">No sections found</h3>
    <p style="color: #6b7280;">Try adjusting your search or filter criteria</p>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchInput = document.getElementById('search-sections');
        const statusFilter = document.getElementById('status-filter');
        const clearFilters = document.getElementById('clear-filters');
        const sectionsContainer = document.getElementById('sections-container');
        const noResults = document.getElementById('no-results');
        
        function filterSections() {
            const searchTerm = searchInput.value.toLowerCase();
            const statusFilterValue = statusFilter.value;
            const sections = document.querySelectorAll('.section-card');
            let visibleCount = 0;
            
            sections.forEach(section => {
                const teacher = section.dataset.teacher;
                const room = section.dataset.room;
                const status = section.dataset.status;
                const sectionLetter = section.dataset.section;
                
                const matchesSearch = !searchTerm || 
                    teacher.includes(searchTerm) || 
                    room.includes(searchTerm) || 
                    sectionLetter.toLowerCase().includes(searchTerm);
                
                const matchesStatus = !statusFilterValue || status === statusFilterValue;
                
                if (matchesSearch && matchesStatus) {
                    section.style.display = 'block';
                    visibleCount++;
                } else {
                    section.style.display = 'none';
                }
            });
            
            if (visibleCount === 0) {
                sectionsContainer.style.display = 'none';
                noResults.style.display = 'block';
            } else {
                sectionsContainer.style.display = 'grid';
                noResults.style.display = 'none';
            }
        }
        
        searchInput.addEventListener('input', filterSections);
        statusFilter.addEventListener('change', filterSections);
        
        clearFilters.addEventListener('click', function() {
            searchInput.value = '';
            statusFilter.value = '';
            filterSections();
        });
        
        // Sidebar filters
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const filter = this.dataset.filter;
                const sections = document.querySelectorAll('.section-card');
                
                // Remove active class from all buttons
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
                
                sections.forEach(section => {
                    if (filter === 'all') {
                        section.style.display = 'block';
                    } else if (filter.startsWith('section-')) {
                        const sectionLetter = filter.replace('section-', '');
                        if (section.dataset.section === sectionLetter) {
                            section.style.display = 'block';
                        } else {
                            section.style.display = 'none';
                        }
                    }
                });
                
                // Update no results display
                const visibleSections = Array.from(sections).filter(s => s.style.display !== 'none');
                if (visibleSections.length === 0) {
                    sectionsContainer.style.display = 'none';
                    noResults.style.display = 'block';
                } else {
                    sectionsContainer.style.display = 'grid';
                    noResults.style.display = 'none';
                }
            });
        });
        
        // Grade type filters
        document.querySelectorAll('.grade-filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const gradeType = this.dataset.grade;
                const sections = document.querySelectorAll('.section-card');
                
                // Remove active class from all grade buttons
                document.querySelectorAll('.grade-filter-btn').forEach(b => b.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
                
                sections.forEach(section => {
                    if (section.dataset.grade === gradeType) {
                        section.style.display = 'block';
                    } else {
                        section.style.display = 'none';
                    }
                });
                
                // Update no results display
                const visibleSections = Array.from(sections).filter(s => s.style.display !== 'none');
                if (visibleSections.length === 0) {
                    sectionsContainer.style.display = 'none';
                    noResults.style.display = 'block';
                } else {
                    sectionsContainer.style.display = 'grid';
                    noResults.style.display = 'none';
                }
            });
        });
        
        // Dropdown menus
        document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.stopPropagation();
                const menu = this.nextElementSibling;
                
                // Close all other dropdowns
                document.querySelectorAll('.dropdown-menu').forEach(m => {
                    if (m !== menu) {
                        m.classList.remove('show');
                    }
                });
                
                menu.classList.toggle('show');
            });
        });
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function() {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        });
        
        // View toggle
        const gridView = document.getElementById('grid-view');
        const listView = document.getElementById('list-view');
        
        listView.addEventListener('click', function() {
            sectionsContainer.className = 'sections-list';
            
            // Update button styles
            this.className = 'btn-primary';
            gridView.className = 'btn-secondary';
        });
        
        gridView.addEventListener('click', function() {
            sectionsContainer.className = 'sections-grid';
            
            // Update button styles
            this.className = 'btn-primary';
            listView.className = 'btn-secondary';
        });
    });
    
    // Export function
    function exportData() {
        alert('Export functionality would be implemented here');
    }
    
    // Edit section function
    function editSection(sectionId) {
        alert('Edit section ' + sectionId + ' functionality would be implemented here');
    }
    
    // Export students function
    function exportStudents(sectionId) {
        alert('Export students for section ' + sectionId + ' functionality would be implemented here');
    }
    
    // View analytics function
    function viewAnalytics(sectionId) {
        alert('View analytics for section ' + sectionId + ' functionality would be implemented here');
    }
    
    // Auto-hide success/error messages
    setTimeout(function() {
        const messages = document.querySelectorAll('.fixed.top-4.right-4');
        messages.forEach(message => {
            message.style.opacity = '0';
            setTimeout(() => message.remove(), 300);
        });
    }, 3000);
</script>
                            