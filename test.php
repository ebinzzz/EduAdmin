@extends('layouts.app')

@section('title', 'Class Management - EduManage')

@section('page-title', 'Class Management Dashboard')

@section('breadcrumb', 'Home / Administration / Class Management')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Management Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/chart.js/3.9.1/chart.min.js"></script>
    @section('styles')
    <style>
        :root {
            --primary-color: #667eea;
            --primary-dark: #5a67d8;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #3b82f6;
            --light-bg: #f8fafc;
            --border-color: #e5e7eb;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-primary);
        }

        /* Page Header */
        .page-header {
            background: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .breadcrumb-custom {
            background: none;
            padding: 0;
            margin: 0;
            font-size: 0.875rem;
        }

        .breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before {
            content: "→";
            color: var(--text-secondary);
        }

        /* Dashboard Cards */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--accent-color);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .stat-card.primary { --accent-color: var(--primary-color); }
        .stat-card.success { --accent-color: var(--success-color); }
        .stat-card.warning { --accent-color: var(--warning-color); }
        .stat-card.danger { --accent-color: var(--danger-color); }

        .stat-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .stat-card-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            background: var(--accent-color);
        }

        .stat-card-content h3 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
            line-height: 1;
        }

        .stat-card-content p {
            font-size: 0.875rem;
            color: var(--text-secondary);
            margin: 0;
            font-weight: 500;
        }

        /* Main Content Card */
        .main-content-card {
            background: white;
            border-radius: 16px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .content-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .content-header h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .action-buttons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        /* Enhanced Buttons */
        .btn-enhanced {
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            overflow: hidden;
        }

        .btn-enhanced:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-enhanced:hover:before {
            left: 100%;
        }

        .btn-enhanced:hover {
            transform: translateY(-2px);
        }

        .btn-primary-enhanced {
            background: var(--primary-color);
            color: white;
        }

        .btn-primary-enhanced:hover {
            background: var(--primary-dark);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-success-enhanced {
            background: var(--success-color);
            color: white;
        }

        .btn-success-enhanced:hover {
            background: #059669;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        }

        /* Tabs */
        .custom-tabs {
            border-bottom: 2px solid var(--border-color);
            background: var(--light-bg);
        }

        .nav-tabs-custom {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-tab-custom {
            flex: 1;
        }

        .nav-link-custom {
            display: block;
            padding: 1rem 1.5rem;
            text-decoration: none;
            color: var(--text-secondary);
            font-weight: 500;
            text-align: center;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link-custom:hover {
            background: rgba(102, 126, 234, 0.1);
            color: var(--primary-color);
        }

        .nav-link-custom.active {
            background: white;
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
        }

        /* Filters Section */
        .filters-section {
            background: var(--light-bg);
            padding: 1.5rem;
            border-radius: 12px;
            margin: 1.5rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            min-width: 200px;
        }

        .filter-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control-enhanced, .form-select-enhanced {
            padding: 0.75rem 1rem;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 0.875rem;
            background: white;
            transition: all 0.3s ease;
        }

        .form-control-enhanced:focus, .form-select-enhanced:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        /* Tab Content */
        .tab-content-custom {
            padding: 0;
        }

        .tab-pane-custom {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .tab-pane-custom.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Class Grid */
    
        .btn-sm-enhanced:hover {
            transform: translateY(-1px);
        }

        /* Modal Improvements */
        .modal-content-enhanced {
            border: none;
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
        }

        .modal-header-enhanced {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            border-radius: 16px 16px 0 0;
            padding: 1.5rem 2rem;
        }

        .modal-title-enhanced {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
        }

        .modal-body-enhanced {
            padding: 2rem;
        }

        .modal-footer-enhanced {
            padding: 1.5rem 2rem;
            border-top: 1px solid var(--border-color);
            background: var(--light-bg);
            border-radius: 0 0 16px 16px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--text-secondary);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-cards {
                grid-template-columns: 1fr;
            }
            
            .classes-grid {
                grid-template-columns: 1fr;
                padding: 1rem;
            }
            
            .filters-section {
                flex-direction: column;
                align-items: stretch;
            }
            
            .filter-group {
                min-width: auto;
            }
            
            .content-header {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }
            
            .action-buttons {
                justify-content: center;
            }
            
            .custom-tabs .nav-tabs-custom {
                flex-direction: column;
            }
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Alert Improvements */
        .alert-enhanced {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-success-enhanced {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
        }

        .alert-danger-enhanced {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }

        .alert-warning-enhanced {
            background: rgba(245, 158, 11, 0.1);
            color: #d97706;
        }

        .alert-info-enhanced {
            background: rgba(59, 130, 246, 0.1);
            color: #2563eb;
        }
    </style>
</head>

@section('content')
<!-- Page Header -->


<!-- Dashboard Cards -->
<div class="container-fluid">
    <div class="dashboard-cards">
        <div class="stat-card primary">
            <div class="stat-card-header">
                <div class="stat-card-content">
                    <h3 id="totalClasses">12</h3>
                    <p>Total Classes</p>
                </div>
                <div class="stat-card-icon">
                    <i class="fas fa-chalkboard"></i>
                </div>
            </div>
        </div>

        <div class="stat-card success">
            <div class="stat-card-header">
                <div class="stat-card-content">
                    <h3 id="totalStudents">485</h3>
                    <p>Total Students</p>
                </div>
                <div class="stat-card-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <div class="stat-card warning">
            <div class="stat-card-header">
                <div class="stat-card-content">
                    <h3 id="teachersAssigned">8</h3>
                    <p>Teachers Assigned</p>
                </div>
                <div class="stat-card-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>
        </div>

        <div class="stat-card danger">
            <div class="stat-card-header">
                <div class="stat-card-content">
                    <h3 id="maintenanceRequired">3</h3>
                    <p>Maintenance Required</p>
                </div>
                <div class="stat-card-icon">
                    <i class="fas fa-tools"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content-card">
        <div class="content-header">
            <h2>
                <i class="fas fa-cogs"></i>
                Class Management System
            </h2>
            <div class="action-buttons">
                <button class="btn-enhanced btn-primary-enhanced" onclick="openCreateClassModal()">
                    <i class="fas fa-plus"></i>
                    Create New Class
                </button>
                <button class="btn-enhanced btn-success-enhanced" onclick="exportClasses()">
                    <i class="fas fa-download"></i>
                    Export Data
                </button>
            </div>
        </div>

        <!-- Tabs Navigation -->
       <!-- Replace your existing nav-tabs-custom section with this: -->
<ul class="nav-tabs-custom">
    <li class="nav-tab-custom">
        <a href="#classes-tab" class="nav-link-custom active">
            <i class="fas fa-chalkboard"></i>
            Classes Overview
        </a>
    </li>
    <li class="nav-tab-custom">
        <a href="#amenities-tab" class="nav-link-custom">
            <i class="fas fa-chair"></i>
            Amenities Management
        </a>
    </li>
    <li class="nav-tab-custom">
        <a href="#maintenance-tab" class="nav-link-custom">
            <i class="fas fa-tools"></i>
            Maintenance Records
        </a>
    </li>
    <li class="nav-tab-custom">
        <a href="#reports-tab" class="nav-link-custom">
            <i class="fas fa-chart-bar"></i>
            Reports & Analytics
        </a>
    </li>
</ul>
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

        <!-- Tab Content -->
        <div class="tab-content-custom">
            <!-- Classes Tab -->
            <div id="classes-tab" class="tab-pane-custom active">
                <!-- Filters -->
                <div class="filters-section">
                    <div class="filter-group">
                        <label class="filter-label">Grade Type</label>
                        <select class="form-select-enhanced" id="gradeTypeFilter" onchange="filterClasses()">
                            <option value="">All Grade Types</option>
                            <option value="pre_primary">Pre-Primary</option>
                            <option value="primary">Primary</option>
                            <option value="secondary">Secondary</option>
                            <option value="higher_secondary">Higher Secondary</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Academic Year</label>
                        <select class="form-select-enhanced" id="academicYearFilter" onchange="filterClasses()">
                            <option value="">All Years</option>
                            <option value="2024-2025" selected>2024-2025</option>
                            <option value="2025-2026">2025-2026</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Status</label>
                        <select class="form-select-enhanced" id="statusFilter" onchange="filterClasses()">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Search</label>
                        <input type="text" class="form-control-enhanced" id="searchFilter" placeholder="Search classes..." onkeyup="filterClasses()">
                    </div>
                </div>

                <!-- Classes Grid -->
                <div class="classes-grid" id="classesGrid">
                    <!-- Sample class cards -->
                    <div id="classCardContainer">
                          @foreach($classes->take(3) as $class)
                                @php
                                    $displayName = $class->name . ' - ' . $class->section;
                                $teacherName = isset($class->classTeacher) 
                            ? $class->classTeacher->first_name . ' ' . $class->classTeacher->last_name 
                            : 'Not Assigned';
                            $room = $class->room_number ?? 'Not Assigned';
                            $building = $class->building ?? 'Main Block';
                            $floor = is_null($class->floor_number) 
                                        ? 'Not Assigned' 
                                        : ($class->floor_number == 0 ? 'Ground Floor' : $class->floor_number . ' Floor');
                                        $status = strtolower($class->status);
                                        $statusClass = $status === 'active' ? 'status-active' : 'status-inactive';
                                        $statusLabel = ucfirst($status);

                                        $studentCount = $class->current_student_count ?? 0;
                                        $capacity = $class->student_capacity ?? 40;

                                        $studentColor = $status === 'inactive' ? 'var(--text-secondary)' 
                                                        : ($studentCount < $capacity ? 'var(--warning-color)' : 'var(--success-color)');

            // Optional: Grade type logic if needed
          //  $gradeType = App\Http\Controllers\Class\ClassManagementController::determineGradeTypeStatic($class->name);
        @endphp

        <div class="class-card"
           
             data-academic-year="{{ $class->academic_year }}"
             data-status="{{ $status }}">

            <div class="class-card-header">
                <h3 class="class-name">{{ $displayName }}</h3>
                <span class="class-status {{ $statusClass }}">{{ $statusLabel }}</span>
            </div>

            <div class="class-info">
                <div class="info-row">
                    <span class="info-label">Room:</span>
                    <span class="info-value">{{ $room }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Teacher:</span>
                    <span class="info-value">{{ $teacherName }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Students:</span>
                    <span class="info-value" style="color: {{ $studentColor }}">{{ $studentCount }}/{{ $capacity }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Building:</span>
                    <span class="info-value">{{ $building }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Floor:</span>
                    <span class="info-value">{{ $floor }}</span>
                </div>
            </div>

            <div class="class-actions">
                <button class="btn-sm-enhanced" style="background: var(--primary-color); color: white;" onclick="editClass({{ $class->id }})">
                    <i class="fas fa-edit"></i> Edit
                </button>
                <button class="btn-sm-enhanced" style="background: var(--success-color); color: white;" onclick="viewAmenities({{ $class->id }})">
                    <i class="fas fa-chair"></i> Amenities
                </button>
                <button class="btn-sm-enhanced" style="background: var(--warning-color); color: white;" onclick="manageStudents({{ $class->id }})">
                    <i class="fas fa-users"></i> Students
                </button>
            </div>
        </div>
    @endforeach
</div>

            </div>

            <!-- Amenities Tab -->
            <div id="amenities-tab" class="tab-pane-custom">
                <div style="padding: 1.5rem;">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4>Amenities Management</h4>
                        <button class="btn-enhanced btn-primary-enhanced" onclick="openAddAmenityModal()">
                            <i class="fas fa-plus"></i>
                            Add Amenity
                        </button>
                    </div>

                    <!-- Amenities Grid -->
                    <div class="classes-grid" id="amenitiesGrid">
                        <!-- Sample amenity cards -->
                        <div class="class-card">
                            <div class="class-card-header">
                                <div>
                                    <h3 class="class-name" style="font-size: 1.1rem;">Desks</h3>
                                    <small class="text-muted">Class 10 - A</small>
                                </div>
                                <span class="condition-indicator" style="width: 12px; height: 12px; background: var(--success-color); border-radius: 50%;"></span>
                            </div>
                            
                            <div class="class-info">
                                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 1rem;">
                                    <div style="text-align: center; padding: 0.75rem; background: var(--light-bg); border-radius: 8px;">
                                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--text-primary);">20</div>
                                        <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase;">Total</div>
                                    </div>
                                    <div style="text-align: center; padding: 0.75rem; background: var(--light-bg); border-radius: 8px;">
                                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--success-color);">18</div>
                                        <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase;">Working</div>
                                    </div>
                                    <div style="text-align: center; padding: 0.75rem; background: var(--light-bg); border-radius: 8px;">
                                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--danger-color);">1</div>
                                        <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase;">Damaged</div>
                                    </div>
                                    <div style="text-align: center; padding: 0.75rem; background: var(--light-bg); border-radius: 8px;">
                                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--warning-color);">1</div>
                                        <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase;">Repair</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="class-actions">
                                <button class="btn-sm-enhanced" style="background: var(--primary-color); color: white; flex: 1;" onclick="editAmenity(1)">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </button>
                                <button class="btn-sm-enhanced" style="background: var(--warning-color); color: white; flex: 1;" onclick="scheduleMaintenance(1)">
                                    <i class="fas fa-tools"></i>
                                    Maintain
                                </button>
                            </div>
                        </div>

                        <div class="class-card">
                            <div class="class-card-header">
                                <div>
                                    <h3 class="class-name" style="font-size: 1.1rem;">Chairs</h3>
                                    <small class="text-muted">Class 10 - A</small>
                                </div>
                                <span class="condition-indicator" style="width: 12px; height: 12px; background: var(--warning-color); border-radius: 50%;"></span>
                            </div>
                            
                            <div class="class-info">
                                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 1rem;">
                                    <div style="text-align: center; padding: 0.75rem; background: var(--light-bg); border-radius: 8px;">
                                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--text-primary);">40</div>
                                        <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase;">Total</div>
                                    </div>
                                    <div style="text-align: center; padding: 0.75rem; background: var(--light-bg); border-radius: 8px;">
                                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--success-color);">35</div>
                                        <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase;">Working</div>
                                    </div>
                                    <div style="text-align: center; padding: 0.75rem; background: var(--light-bg); border-radius: 8px;">
                                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--danger-color);">3</div>
                                        <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase;">Damaged</div>
                                    </div>
                                    <div style="text-align: center; padding: 0.75rem; background: var(--light-bg); border-radius: 8px;">
                                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--warning-color);">2</div>
                                        <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase;">Repair</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="class-actions">
                                <button class="btn-sm-enhanced" style="background: var(--primary-color); color: white; flex: 1;" onclick="editAmenity(2)">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </button>
                                <button class="btn-sm-enhanced" style="background: var(--warning-color); color: white; flex: 1;" onclick="scheduleMaintenance(2)">
                                    <i class="fas fa-tools"></i>
                                    Maintain
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Maintenance Tab -->
            <div id="maintenance-tab" class="tab-pane-custom">
                <div style="padding: 1.5rem;">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4>Maintenance Records</h4>
                        <button class="btn-enhanced" style="background: var(--warning-color); color: white;" onclick="openScheduleMaintenanceModal()">
                            <i class="fas fa-calendar"></i>
                            Schedule Maintenance
                        </button>
                    </div>

                    <!-- Search Bar -->
                    <div class="mb-4">
                        <input type="text" class="form-control-enhanced" placeholder="Search maintenance records..." style="max-width: 400px;">
                    </div>

                    <!-- Maintenance Table -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead style="background: var(--light-bg);">
                                <tr>
                                    <th>Date</th>
                                    <th>Class</th>
                                    <th>Item</th>
                                    <th>Type</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Cost</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2025-07-28</td>
                                    <td>Class 10 - A</td>
                                    <td>Chairs</td>
                                    <td><span class="badge" style="background: var(--warning-color); color: white; padding: 0.25rem 0.5rem; border-radius: 12px; font-size: 0.75rem;">Repair</span></td>
                                    <td><span class="badge" style="background: var(--danger-color); color: white; padding: 0.25rem 0.5rem; border-radius: 12px; font-size: 0.75rem;">High</span></td>
                                    <td><span class="badge" style="background: var(--info-color); color: white; padding: 0.25rem 0.5rem; border-radius: 12px; font-size: 0.75rem;">In Progress</span></td>
                                    <td>₹2,500</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary btn-sm" onclick="viewMaintenanceDetails(1)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-success btn-sm" onclick="updateMaintenanceStatus(1)">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" onclick="deleteMaintenanceRecord(1)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2025-07-25</td>
                                    <td>Class 9 - B</td>
                                    <td>Projector</td>
                                    <td><span class="badge" style="background: var(--danger-color); color: white; padding: 0.25rem 0.5rem; border-radius: 12px; font-size: 0.75rem;">Replacement</span></td>
                                    <td><span class="badge" style="background: var(--warning-color); color: white; padding: 0.25rem 0.5rem; border-radius: 12px; font-size: 0.75rem;">Medium</span></td>
                                    <td><span class="badge" style="background: var(--success-color); color: white; padding: 0.25rem 0.5rem; border-radius: 12px; font-size: 0.75rem;">Completed</span></td>
                                    <td>₹45,000</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary btn-sm" onclick="viewMaintenanceDetails(2)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-success btn-sm" onclick="updateMaintenanceStatus(2)">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="btn btn-outline-danger btn-sm" onclick="deleteMaintenanceRecord(2)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Reports Tab -->
            <div id="reports-tab" class="tab-pane-custom">
                <div style="padding: 1.5rem;">
                    <h4 class="mb-4">Reports & Analytics</h4>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: var(--shadow); border: 1px solid var(--border-color);">
                                <h5 class="mb-3">Class Utilization Chart</h5>
                                <canvas id="classUtilizationChart" style="max-height: 400px;"></canvas>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: var(--shadow); border: 1px solid var(--border-color);">
                                <h5 class="mb-3">Amenity Conditions</h5>
                                <canvas id="amenityConditionChart" style="max-height: 300px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->

<!-- Create Class Modal -->
<div class="modal fade" id="createClassModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-enhanced">
            <div class="modal-header modal-header-enhanced">
                <h5 class="modal-title modal-title-enhanced">Create New Class</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="createClassForm" method="POST"  action="{{route('create.class')}}">
                @csrf
                <div class="modal-body modal-body-enhanced">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Class Name <span class="text-danger">*</span></label>
                                <select class="form-select-enhanced" name="name" required>
                                    <option value="">Select Class</option>
                                    <option value="LKG">LKG</option>
                                    <option value="UKG">UKG</option>
                                    <option value="1">Class 1</option>
                                    <option value="2">Class 2</option>
                                    <option value="3">Class 3</option>
                                    <option value="4">Class 4</option>
                                    <option value="5">Class 5</option>
                                    <option value="6">Class 6</option>
                                    <option value="7">Class 7</option>
                                    <option value="8">Class 8</option>
                                    <option value="9">Class 9</option>
                                    <option value="10">Class 10</option>
                                    <option value="11">Class 11</option>
                                    <option value="12">Class 12</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Section <span class="text-danger">*</span></label>
                                <select class="form-select-enhanced" name="section" required>
                                    <option value="">Select Section</option>
                                    <option value="A">Section A</option>
                                    <option value="B">Section B</option>
                                    <option value="C">Section C</option>
                                    <option value="D">Section D</option>
                                    <option value="E">Section E</option>
                                    <option value="F">Section F</option>
                                    <option value="G">Section G</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                                                <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Class Teacher</label>
                                    <select class="form-select-enhanced" name="class_teacher_id">
                                        <option value="">Select Teacher</option>
                                        @foreach($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->first_name }} {{ $teacher->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Student Capacity</label>
                                <input type="number" class="form-control-enhanced" name="student_capacity" value="40" min="1" max="100">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Room Number</label>
                                <input type="text" class="form-control-enhanced" name="room_number" placeholder="e.g., R-101">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Building</label>
                                <input type="text" class="form-control-enhanced" name="building" placeholder="e.g., Main Block">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Floor</label>
                                <select class="form-select-enhanced" name="floor_number">
                                    <option value="">Select Floor</option>
                                    <option value="0">Ground Floor</option>
                                    <option value="1">1st Floor</option>
                                    <option value="2">2nd Floor</option>
                                    <option value="3">3rd Floor</option>
                                    <option value="4">4th Floor</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Academic Year</label>
                        <select class="form-select-enhanced" name="academic_year" required>
                            <option value="2024-2025" selected>2024-2025</option>
                            <option value="2025-2026">2025-2026</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea class="form-control-enhanced" name="description" rows="3" placeholder="Optional description about the class"></textarea>
                    </div>
                </div>
                <div class="modal-footer modal-footer-enhanced">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-enhanced btn-primary-enhanced">
                        <i class="fas fa-save"></i>
                        Create Class
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Amenity Modal -->
<div class="modal fade" id="addAmenityModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-enhanced">
            <div class="modal-header modal-header-enhanced">
                <h5 class="modal-title modal-title-enhanced">Add Class Amenity</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="addAmenityForm">
                <div class="modal-body modal-body-enhanced">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Select Class <span class="text-danger">*</span></label>
                                <select class="form-select-enhanced" name="class_id" required>
                                    <option value="">Select Class</option>
                                    <option value="1">Class 10 - A</option>
                                    <option value="2">Class 9 - B</option>
                                    <option value="3">Class 8 - A</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Item Type <span class="text-danger">*</span></label>
                                <select class="form-select-enhanced" name="item_type" required onchange="updateItemOptions()">
                                    <option value="">Select Type</option>
                                    <option value="furniture">Furniture</option>
                                    <option value="equipment">Equipment</option>
                                    <option value="electronics">Electronics</option>
                                    <option value="stationary">Stationary</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Item Name <span class="text-danger">*</span></label>
                                <select class="form-select-enhanced" name="item_name" required id="itemNameSelect">
                                    <option value="">Select Item</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Total Quantity <span class="text-danger">*</span></label>
                                <input type="number" class="form-control-enhanced" name="total_quantity" required min="1" onchange="updateWorkingQuantity()">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Working Quantity</label>
                                <input type="number" class="form-control-enhanced" name="working_quantity" min="0" id="workingQuantityInput">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Damaged Quantity</label>
                                <input type="number" class="form-control-enhanced" name="damaged_quantity" value="0" min="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Under Repair</label>
                                <input type="number" class="form-control-enhanced" name="repair_quantity" value="0" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Brand</label>
                                <input type="text" class="form-control-enhanced" name="brand" placeholder="e.g., Godrej, Nilkamal">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Purchase Date</label>
                                <input type="date" class="form-control-enhanced" name="purchase_date">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Purchase Cost</label>
                                <input type="number" class="form-control-enhanced" name="purchase_cost" step="0.01" min="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Overall Condition</label>
                                <select class="form-select-enhanced" name="overall_condition">
                                    <option value="excellent">Excellent</option>
                                    <option value="good" selected>Good</option>
                                    <option value="fair">Fair</option>
                                    <option value="poor">Poor</option>
                                    <option value="damaged">Damaged</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Vendor/Supplier</label>
                        <input type="text" class="form-control-enhanced" name="vendor" placeholder="Supplier name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Specifications</label>
                        <textarea class="form-control-enhanced" name="specifications" rows="3" placeholder="Item specifications and details"></textarea>
                    </div>
                </div>
                <div class="modal-footer modal-footer-enhanced">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-enhanced btn-primary-enhanced">
                        <i class="fas fa-save"></i>
                        Add Amenity
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


<!-- Bootstrap JS -->


<script>
    // Sample data
    let classes = [
        {
            id: 1,
            display_name: "Class 10 - A",
            room_number: "R-101",
            class_teacher: { name: "Ms. Sarah Johnson" },
            current_student_count: 38,
            student_capacity: 40,
            building: "Main Block",
            floor_number: 1,
            status: "active",
            grade_type: "secondary",
            academic_year: "2024-2025"
        },
        {
            id: 2,
            display_name: "Class 9 - B",
            room_number: "R-205",
            class_teacher: { name: "Mr. David Smith" },
            current_student_count: 35,
            student_capacity: 40,
            building: "Main Block",
            floor_number: 2,
            status: "active",
            grade_type: "secondary",
            academic_year: "2024-2025"
        },
        {
            id: 3,
            display_name: "Class 8 - A",
            room_number: null,
            class_teacher: null,
            current_student_count: 0,
            student_capacity: 40,
            building: "Main Block",
            floor_number: 0,
            status: "inactive",
            grade_type: "primary",
            academic_year: "2024-2025"
        }
    ];

    let amenities = [];
    let maintenanceRecords = [];

    // Item options for different types
    const itemOptions = {
        furniture: ['Bench', 'Desk', 'Chair', 'Table', 'Cupboard', 'Shelf', 'Locker'],
        equipment: ['Projector', 'Speaker', 'Microphone', 'Fan', 'AC', 'Water Purifier'],
        electronics: ['Computer', 'Laptop', 'Tablet', 'Smart Board', 'Television', 'Printer'],
        stationary: ['Whiteboard', 'Blackboard', 'Marker', 'Eraser', 'Chalk']
    };

    // Initialize dashboard
    document.addEventListener('DOMContentLoaded', function() {
        initializeCharts();
        updateStats();
    });

    // Tab switching function
   // Replace the existing switchTab function with this corrected version
function switchTab(event, tabId) {
    event.preventDefault();
    
    // Remove active class from all nav links
    document.querySelectorAll('.nav-link-custom').forEach(link => {
        link.classList.remove('active');
    });
    
    // Hide all tab panes
    document.querySelectorAll('.tab-pane-custom').forEach(pane => {
        pane.classList.remove('active');
    });
    
    // Show selected tab and mark nav link as active
    const targetTab = document.getElementById(tabId);
    const clickedLink = event.target.closest('.nav-link-custom');
    
    if (targetTab) {
        targetTab.classList.add('active');
    }
    
    if (clickedLink) {
        clickedLink.classList.add('active');
    }
    
    // Trigger any tab-specific initialization
    if (tabId === 'reports-tab') {
        // Reinitialize charts when reports tab is shown
        setTimeout(() => {
            initializeCharts();
        }, 100);
    }
}

// Add click event listeners to all tab links (add this to your DOMContentLoaded event)
document.addEventListener('DOMContentLoaded', function() {
    // ... your existing DOMContentLoaded code ...
    
    // Initialize tab navigation
    const tabLinks = document.querySelectorAll('.nav-link-custom');
    tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const tabId = this.getAttribute('onclick').match(/'([^']+)'/)[1];
            switchTab(e, tabId);
        });
    });
    
    // ... rest of your existing DOMContentLoaded code ...
});

    // Filter classes
    function filterClasses() {
        const gradeType = document.getElementById('gradeTypeFilter').value;
        const academicYear = document.getElementById('academicYearFilter').value;
        const status = document.getElementById('statusFilter').value;
        const search = document.getElementById('searchFilter').value.toLowerCase();
        
        const classCards = document.querySelectorAll('.class-card');
        
        classCards.forEach(card => {
            const cardGradeType = card.getAttribute('data-grade-type');
            const cardAcademicYear = card.getAttribute('data-academic-year');
            const cardStatus = card.getAttribute('data-status');
            const cardText = card.textContent.toLowerCase();
            
            const matches = 
                (!gradeType || cardGradeType === gradeType) &&
                (!academicYear || cardAcademicYear === academicYear) &&
                (!status || cardStatus === status) &&
                (!search || cardText.includes(search));
            
            card.style.display = matches ? 'block' : 'none';
        });
    }

    // Update item options based on type
    function updateItemOptions() {
        const itemType = document.querySelector('select[name="item_type"]').value;
        const itemNameSelect = document.getElementById('itemNameSelect');
        
        itemNameSelect.innerHTML = '<option value="">Select Item</option>';
        
        if (itemType && itemOptions[itemType]) {
            itemOptions[itemType].forEach(item => {
                const option = document.createElement('option');
                option.value = item;
                option.textContent = item;
                itemNameSelect.appendChild(option);
            });
        }
    }

    // Update working quantity when total quantity changes
   // Update working quantity when total quantity changes
function updateWorkingQuantity() {
    const totalQuantity = parseInt(document.querySelector('input[name="total_quantity"]').value) || 0;
    const workingQuantityInput = document.getElementById('workingQuantityInput');
    workingQuantityInput.value = totalQuantity;
    workingQuantityInput.max = totalQuantity;
}

// Update statistics
function updateStats() {
    const activeClasses = classes.filter(c => c.status === 'active').length;
    const totalStudents = classes.reduce((sum, c) => sum + c.current_student_count, 0);
    const assignedTeachers = classes.filter(c => c.class_teacher).length;
    const maintenanceRequired = 3; // This would come from actual maintenance data
    
    document.getElementById('totalClasses').textContent = classes.length;
    document.getElementById('totalStudents').textContent = totalStudents;
    document.getElementById('teachersAssigned').textContent = assignedTeachers;
    document.getElementById('maintenanceRequired').textContent = maintenanceRequired;
}
function initTabNavigation() {
    const tabLinks = document.querySelectorAll('.nav-link-custom');
    
    tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get target tab from href or data attribute
            let targetTab = this.getAttribute('href');
            if (targetTab && targetTab.startsWith('#')) {
                targetTab = targetTab.substring(1);
            } else {
                // Fallback to onclick parsing
                const onclickMatch = this.getAttribute('onclick');
                if (onclickMatch) {
                    const match = onclickMatch.match(/'([^']+)'/);
                    if (match) {
                        targetTab = match[1];
                    }
                }
            }
            
            if (targetTab) {
                switchTab(e, targetTab);
            }
        });
    });
}

// Call this function in your DOMContentLoaded event
document.addEventListener('DOMContentLoaded', function() {
    initTabNavigation();
    initializeCharts();
    updateStats();
});

// Initialize charts
function initializeCharts() {
    // Only initialize charts if the canvas elements are visible
    const utilizationCtx = document.getElementById('classUtilizationChart');
    const conditionCtx = document.getElementById('amenityConditionChart');
    
    if (utilizationCtx && utilizationCtx.offsetParent !== null) {
        // Chart is visible, safe to initialize
        if (Chart.getChart(utilizationCtx)) {
            Chart.getChart(utilizationCtx).destroy();
        }
        
        new Chart(utilizationCtx, {
            type: 'bar',
            data: {
                labels: ['Class 10-A', 'Class 9-B', 'Class 8-A'],
                datasets: [{
                    label: 'Current Students',
                    data: [38, 35, 0],
                    backgroundColor: 'rgba(102, 126, 234, 0.8)',
                    borderColor: 'rgba(102, 126, 234, 1)',
                    borderWidth: 2
                }, {
                    label: 'Capacity',
                    data: [40, 40, 40],
                    backgroundColor: 'rgba(16, 185, 129, 0.3)',
                    borderColor: 'rgba(16, 185, 129, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    if (conditionCtx && conditionCtx.offsetParent !== null) {
        // Chart is visible, safe to initialize
        if (Chart.getChart(conditionCtx)) {
            Chart.getChart(conditionCtx).destroy();
        }
        
        new Chart(conditionCtx, {
            type: 'doughnut',
            data: {
                labels: ['Working', 'Damaged', 'Under Repair'],
                datasets: [{
                    data: [85, 10, 5],
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(245, 158, 11, 0.8)'
                    ],
                    borderColor: [
                        'rgba(16, 185, 129, 1)',
                        'rgba(239, 68, 68, 1)',
                        'rgba(245, 158, 11, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    }
}

// Modal functions
function openCreateClassModal() {
    const modal = new bootstrap.Modal(document.getElementById('createClassModal'));
    modal.show();
}

function openAddAmenityModal() {
    const modal = new bootstrap.Modal(document.getElementById('addAmenityModal'));
    modal.show();
}

function openScheduleMaintenanceModal() {
    // This would open a maintenance scheduling modal
    alert('Schedule Maintenance Modal would open here');
}

// Class management functions
function editClass(classId) {
    const classData = classes.find(c => c.id === classId);
    if (classData) {
        // Populate edit form with class data
        alert(`Edit Class: ${classData.display_name}`);
        // Here you would open an edit modal with pre-filled data
    }
}

function viewAmenities(classId) {
    const classData = classes.find(c => c.id === classId);
    if (classData) {
        alert(`View Amenities for: ${classData.display_name}`);
        // Here you would show amenities for this specific class
    }
}

function manageStudents(classId) {
    const classData = classes.find(c => c.id === classId);
    if (classData) {
        alert(`Manage Students for: ${classData.display_name}`);
        // Here you would open student management interface
    }
}

// Amenity management functions
function editAmenity(amenityId) {
    alert(`Edit Amenity ID: ${amenityId}`);
    // Here you would open edit amenity modal
}

function scheduleMaintenance(amenityId) {
    alert(`Schedule Maintenance for Amenity ID: ${amenityId}`);
    // Here you would open maintenance scheduling modal
}

// Maintenance functions
function viewMaintenanceDetails(recordId) {
    alert(`View Maintenance Details for Record ID: ${recordId}`);
    // Here you would show detailed maintenance information
}

function updateMaintenanceStatus(recordId) {
    alert(`Update Status for Maintenance Record ID: ${recordId}`);
    // Here you would update the maintenance status
}

function deleteMaintenanceRecord(recordId) {
    if (confirm('Are you sure you want to delete this maintenance record?')) {
        alert(`Delete Maintenance Record ID: ${recordId}`);
        // Here you would delete the maintenance record
    }
}

// Export function
function exportClasses() {
    alert('Export functionality would be implemented here');
    // Here you would implement CSV/Excel export
}

// Form submission handlers
document.getElementById('createClassForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const classData = {
        name: formData.get('name'),
        section: formData.get('section'),
        class_teacher_id: formData.get('class_teacher_id'),
        student_capacity: parseInt(formData.get('student_capacity')),
        room_number: formData.get('room_number'),
        building: formData.get('building'),
        floor_number: formData.get('floor_number'),
        academic_year: formData.get('academic_year'),
        description: formData.get('description')
    };
    
    // Here you would send the data to your Laravel backend
    console.log('Creating class:', classData);
    
    // Show success message
    showAlert('Class created successfully!', 'success');
    
    // Close modal
    bootstrap.Modal.getInstance(document.getElementById('createClassModal')).hide();
    
    // Reset form
    e.target.reset();
});

document.getElementById('addAmenityForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const amenityData = {
        class_id: formData.get('class_id'),
        item_type: formData.get('item_type'),
        item_name: formData.get('item_name'),
        total_quantity: parseInt(formData.get('total_quantity')),
        working_quantity: parseInt(formData.get('working_quantity')),
        damaged_quantity: parseInt(formData.get('damaged_quantity')),
        repair_quantity: parseInt(formData.get('repair_quantity')),
        brand: formData.get('brand'),
        purchase_date: formData.get('purchase_date'),
        purchase_cost: parseFloat(formData.get('purchase_cost')),
        overall_condition: formData.get('overall_condition'),
        vendor: formData.get('vendor'),
        specifications: formData.get('specifications')
    };
    
    // Here you would send the data to your Laravel backend
    console.log('Adding amenity:', amenityData);
    
    // Show success message
    showAlert('Amenity added successfully!', 'success');
    
    // Close modal
    bootstrap.Modal.getInstance(document.getElementById('addAmenityModal')).hide();
    
    // Reset form
    e.target.reset();
});

// Utility function to show alerts
function showAlert(message, type = 'info') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type}-enhanced alert-dismissible fade show`;
    alertDiv.style.position = 'fixed';
    alertDiv.style.top = '20px';
    alertDiv.style.right = '20px';
    alertDiv.style.zIndex = '9999';
    alertDiv.style.minWidth = '300px';
    
    alertDiv.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'danger' ? 'exclamation-triangle' : 'info-circle'}"></i>
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(alertDiv);
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.parentNode.removeChild(alertDiv);
        }
    }, 5000);
}

// Search functionality for maintenance records
document.addEventListener('DOMContentLoaded', function() {
    const maintenanceSearchInput = document.querySelector('#maintenance-tab input[placeholder="Search maintenance records..."]');
    if (maintenanceSearchInput) {
        maintenanceSearchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('#maintenance-tab tbody tr');
            
            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
    }
});

// Handle form validation
function validateForm(formId) {
    const form = document.getElementById(formId);
    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            isValid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    });
    
    return isValid;
}

// Real-time form validation
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.hasAttribute('required') && !this.value.trim()) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });
        });
    });
});

// Handle quantity calculations in amenity form
document.addEventListener('DOMContentLoaded', function() {
    const amenityForm = document.getElementById('addAmenityForm');
    if (amenityForm) {
        const totalQuantityInput = amenityForm.querySelector('input[name="total_quantity"]');
        const workingQuantityInput = amenityForm.querySelector('input[name="working_quantity"]');
        const damagedQuantityInput = amenityForm.querySelector('input[name="damaged_quantity"]');
        const repairQuantityInput = amenityForm.querySelector('input[name="repair_quantity"]');
        
        function updateQuantities() {
            const total = parseInt(totalQuantityInput.value) || 0;
            const damaged = parseInt(damagedQuantityInput.value) || 0;
            const repair = parseInt(repairQuantityInput.value) || 0;
            const working = total - damaged - repair;
            
            if (working >= 0) {
                workingQuantityInput.value = working;
            }
        }
        
        [damagedQuantityInput, repairQuantityInput].forEach(input => {
            if (input) {
                input.addEventListener('input', updateQuantities);
            }
        });
    }
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl + N for new class
    if (e.ctrlKey && e.key === 'n') {
        e.preventDefault();
        openCreateClassModal();
    }
    
    // Ctrl + A for new amenity
    if (e.ctrlKey && e.key === 'a') {
        e.preventDefault();
        openAddAmenityModal();
    }
    
    // Escape to close modals
    if (e.key === 'Escape') {
        const openModals = document.querySelectorAll('.modal.show');
        openModals.forEach(modal => {
            bootstrap.Modal.getInstance(modal).hide();
        });
    }
});

// Auto-save draft functionality (optional)
let autoSaveTimer;
function startAutoSave(formId) {
    clearTimeout(autoSaveTimer);
    autoSaveTimer = setTimeout(() => {
        const form = document.getElementById(formId);
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);
        
        // Save to localStorage as draft
        localStorage.setItem(`draft_${formId}`, JSON.stringify(data));
        console.log('Draft saved for', formId);
    }, 2000);
}

// Load draft functionality
function loadDraft(formId) {
    const draft = localStorage.getItem(`draft_${formId}`);
    if (draft) {
        const data = JSON.parse(draft);
        const form = document.getElementById(formId);
        
        Object.keys(data).forEach(key => {
            const field = form.querySelector(`[name="${key}"]`);
            if (field) {
                field.value = data[key];
            }
        });
        
        showAlert('Draft loaded successfully!', 'info');
    }
}

// Clear draft
function clearDraft(formId) {
    localStorage.removeItem(`draft_${formId}`);
}

// Print functionality
function printReport(reportType) {
    window.print();
}

// Bulk operations
function selectAllClasses() {
    const checkboxes = document.querySelectorAll('.class-checkbox');
    checkboxes.forEach(cb => cb.checked = true);
}

function deselectAllClasses() {
    const checkboxes = document.querySelectorAll('.class-checkbox');
    checkboxes.forEach(cb => cb.checked = false);
}

function bulkDeleteClasses() {
    const selected = document.querySelectorAll('.class-checkbox:checked');
    if (selected.length === 0) {
        showAlert('Please select classes to delete', 'warning');
        return;
    }
    
    if (confirm(`Are you sure you want to delete ${selected.length} classes?`)) {
        // Implement bulk delete
        showAlert(`${selected.length} classes deleted successfully!`, 'success');
    }
}
</script>
