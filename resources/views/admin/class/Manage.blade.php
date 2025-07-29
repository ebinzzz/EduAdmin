@extends('layouts.app')

@section('title', 'Class Management - EduManage')

@section('page-title', 'Class Management Dashboard')

@section('breadcrumb', 'Home / Administration / Class Management')

@section('styles')
<style>
    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .dashboard-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        padding: 25px;
        transition: all 0.3s ease;
        border-left: 5px solid;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .dashboard-card.primary { border-left-color: #667eea; }
    .dashboard-card.success { border-left-color: #10b981; }
    .dashboard-card.warning { border-left-color: #f59e0b; }
    .dashboard-card.danger { border-left-color: #ef4444; }

    .card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .card-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: white;
    }

    .card-icon.primary { background: #667eea; }
    .card-icon.success { background: #10b981; }
    .card-icon.warning { background: #f59e0b; }
    .card-icon.danger { background: #ef4444; }

    .card-number {
        font-size: 32px;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .card-label {
        color: #6b7280;
        font-size: 14px;
        margin: 0;
    }

    .main-content {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .content-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .content-title {
        font-size: 24px;
        font-weight: 600;
        margin: 0;
    }

    .tabs-container {
        border-bottom: 2px solid #e5e7eb;
    }

    .nav-tabs {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        background: #f8fafc;
    }

    .nav-tab {
        flex: 1;
    }

    .nav-link {
        display: block;
        padding: 15px 20px;
        text-decoration: none;
        color: #6b7280;
        font-weight: 500;
        text-align: center;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .nav-link:hover {
        background: #e5e7eb;
        color: #374151;
    }

    .nav-link.active {
        background: white;
        color: #667eea;
        border-bottom-color: #667eea;
    }

    .tab-content {
        padding: 30px;
    }

    .tab-pane {
        display: none;
    }

    .tab-pane.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 12px 20px;
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

    .btn-success {
        background: #10b981;
        color: white;
    }

    .btn-success:hover {
        background: #059669;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
    }

    .btn-warning {
        background: #f59e0b;
        color: white;
    }

    .btn-warning:hover {
        background: #d97706;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3);
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

    .btn-outline {
        background: transparent;
        color: #6b7280;
        border: 2px solid #d1d5db;
    }

    .btn-outline:hover {
        background: #f9fafb;
        border-color: #9ca3af;
    }

    .class-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .class-card {
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .class-card:hover {
        border-color: #667eea;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .class-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
    }

    .class-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
    }

    .class-name {
        font-size: 20px;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .class-status {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-active {
        background: #d1fae5;
        color: #065f46;
    }

    .status-inactive {
        background: #fee2e2;
        color: #991b1b;
    }

    .class-info {
        margin-bottom: 15px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .info-label {
        color: #6b7280;
        font-weight: 500;
    }

    .info-value {
        color: #1f2937;
        font-weight: 600;
    }

    .class-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
    }

    .filters-section {
        background: #f8fafc;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        align-items: center;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .filter-label {
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
    }

    .form-select, .form-control {
        padding: 8px 12px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        background: white;
        transition: border-color 0.3s ease;
    }

    .form-select:focus, .form-control:focus {
        outline: none;
        border-color: #667eea;
    }

    .amenities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .amenity-card {
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 15px;
        transition: all 0.3s ease;
    }

    .amenity-card:hover {
        border-color: #10b981;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .amenity-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .amenity-name {
        font-weight: 600;
        color: #1f2937;
    }

    .amenity-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin-bottom: 15px;
    }

    .stat-item {
        text-align: center;
        padding: 8px;
        border-radius: 6px;
        background: #f8fafc;
    }

    .stat-number {
        font-size: 18px;
        font-weight: 700;
        color: #1f2937;
    }

    .stat-label {
        font-size: 11px;
        color: #6b7280;
        text-transform: uppercase;
    }

    .condition-indicator {
        display: inline-block;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-right: 5px;
    }

    .condition-excellent { background: #10b981; }
    .condition-good { background: #3b82f6; }
    .condition-fair { background: #f59e0b; }
    .condition-poor { background: #ef4444; }
    .condition-damaged { background: #6b7280; }

    @media (max-width: 768px) {
        .dashboard-cards {
            grid-template-columns: 1fr;
        }
        
        .class-grid {
            grid-template-columns: 1fr;
        }
        
        .filters-section {
            flex-direction: column;
            align-items: stretch;
        }
        
        .action-buttons {
            justify-content: center;
        }
        
        .nav-tabs {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Dashboard Cards -->
    <div class="dashboard-cards">
        <div class="dashboard-card primary">
            <div class="card-header">
                <div>
                    <h3 class="card-number">{{ $totalClasses }}</h3>
                    <p class="card-label">Total Classes</p>
                </div>
                <div class="card-icon primary">
                    <i class="fas fa-chalkboard"></i>
                </div>
            </div>
        </div>

        <div class="dashboard-card success">
            <div class="card-header">
                <div>
                    <h3 class="card-number">{{ $totalStudents }}</h3>
                    <p class="card-label">Total Students</p>
                </div>
                <div class="card-icon success">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <div class="dashboard-card warning">
            <div class="card-header">
                <div>
                    <h3 class="card-number">{{ $teachersAssigned }}</h3>
                    <p class="card-label">Teachers Assigned</p>
                </div>
                <div class="card-icon warning">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>
        </div>

        <div class="dashboard-card danger">
            <div class="card-header">
                <div>
                    <h3 class="card-number">{{ $maintenanceRequired }}</h3>
                    <p class="card-label">Maintenance Required</p>
                </div>
                <div class="card-icon danger">
                    <i class="fas fa-tools"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="content-header">
            <h2 class="content-title">
                <i class="fas fa-cogs"></i>
                Class Management System
            </h2>
            <div class="action-buttons">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createClassModal">
                    <i class="fas fa-plus"></i>
                    Create New Class
                </a>
                <a href="#" class="btn btn-success" onclick="exportClasses()">
                    <i class="fas fa-download"></i>
                    Export Data
                </a>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div class="tabs-container">
            <ul class="nav-tabs">
                <li class="nav-tab">
                    <a href="#classes-tab" class="nav-link active" onclick="switchTab(event, 'classes-tab')">
                        <i class="fas fa-chalkboard"></i>
                        Classes Overview
                    </a>
                </li>
                <li class="nav-tab">
                    <a href="#amenities-tab" class="nav-link" onclick="switchTab(event, 'amenities-tab')">
                        <i class="fas fa-chair"></i>
                        Amenities Management
                    </a>
                </li>
                <li class="nav-tab">
                    <a href="#maintenance-tab" class="nav-link" onclick="switchTab(event, 'maintenance-tab')">
                        <i class="fas fa-tools"></i>
                        Maintenance Records
                    </a>
                </li>
                <li class="nav-tab">
                    <a href="#reports-tab" class="nav-link" onclick="switchTab(event, 'reports-tab')">
                        <i class="fas fa-chart-bar"></i>
                        Reports & Analytics
                    </a>
                </li>
            </ul>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Classes Tab -->
            <div id="classes-tab" class="tab-pane active">
                <!-- Filters -->
                <div class="filters-section">
                    <div class="filter-group">
                        <label class="filter-label">Grade Type</label>
                        <select class="form-select" id="gradeTypeFilter" onchange="filterClasses()">
                            <option value="">All Grade Types</option>
                            <option value="pre_primary">Pre-Primary</option>
                            <option value="primary">Primary</option>
                            <option value="secondary">Secondary</option>
                            <option value="higher_secondary">Higher Secondary</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Academic Year</label>
                        <select class="form-select" id="academicYearFilter" onchange="filterClasses()">
                            <option value="">All Years</option>
                            <option value="2024-2025" selected>2024-2025</option>
                            <option value="2025-2026">2025-2026</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Status</label>
                        <select class="form-select" id="statusFilter" onchange="filterClasses()">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label class="filter-label">Search</label>
                        <input type="text" class="form-control" id="searchFilter" placeholder="Search classes..." onkeyup="filterClasses()">
                    </div>
                </div>

                <!-- Classes Grid -->
                <div class="class-grid" id="classesGrid">
                    <!-- Classes will be loaded here -->
                </div>
            </div>

            <!-- Amenities Tab -->
            <div id="amenities-tab" class="tab-pane">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Amenities Management</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAmenityModal">
                        <i class="fas fa-plus"></i>
                        Add Amenity
                    </button>
                </div>

                <!-- Amenities Grid -->
                <div class="amenities-grid" id="amenitiesGrid">
                    <!-- Amenities will be loaded here -->
                </div>
            </div>

            <!-- Maintenance Tab -->
            <div id="maintenance-tab" class="tab-pane">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Maintenance Records</h4>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#scheduleMaintenanceModal">
                        <i class="fas fa-calendar"></i>
                        Schedule Maintenance
                    </button>
                </div>

                <!-- Maintenance Records Table -->
                <div class="table-responsive">
                    <table class="table table-hover" id="maintenanceTable">
                        <thead>
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
                            <!-- Maintenance records will be loaded here -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Reports Tab -->
            <div id="reports-tab" class="tab-pane">
                <div class="row">
                    <div class="col-md-8">
                        <canvas id="classUtilizationChart"></canvas>
                    </div>
                    <div class="col-md-4">
                        <canvas id="amenityConditionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Class Modal -->
<div class="modal fade" id="createClassModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="createClassForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Class Name <span class="text-danger">*</span></label>
                                <select class="form-select" name="name" required>
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
                                <label class="form-label">Section <span class="text-danger">*</span></label>
                                <select class="form-select" name="section" required>
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
                                <label class="form-label">Class Teacher</label>
                                <select class="form-select" name="class_teacher_id">
                                    <option value="">Select Teacher</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Student Capacity</label>
                                <input type="number" class="form-control" name="student_capacity" value="40" min="1" max="100">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Room Number</label>
                                <input type="text" class="form-control" name="room_number" placeholder="e.g., R-101">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Building</label>
                                <input type="text" class="form-control" name="building" placeholder="e.g., Main Block">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Floor</label>
                                <select class="form-select" name="floor_number">
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
                        <label class="form-label">Academic Year</label>
                        <select class="form-select" name="academic_year" required>
                            <option value="2024-2025" selected>2024-2025</option>
                            <option value="2025-2026">2025-2026</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Optional description about the class"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
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
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Class Amenity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addAmenityForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Select Class <span class="text-danger">*</span></label>
                                <select class="form-select" name="class_id" required id="amenityClassSelect">
                                    <option value="">Select Class</option>
                                    <!-- Classes will be populated -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Item Type <span class="text-danger">*</span></label>
                                <select class="form-select" name="item_type" required onchange="updateItemOptions()">
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
                                <label class="form-label">Item Name <span class="text-danger">*</span></label>
                                <select class="form-select" name="item_name" required id="itemNameSelect">
                                    <option value="">Select Item</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Total Quantity <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="total_quantity" required min="1" onchange="updateWorkingQuantity()">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Working Quantity</label>
                                <input type="number" class="form-control" name="working_quantity" min="0" id="workingQuantityInput">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Damaged Quantity</label>
                                <input type="number" class="form-control" name="damaged_quantity" value="0" min="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Under Repair</label>
                                <input type="number" class="form-control" name="repair_quantity" value="0" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Brand</label>
                                <input type="text" class="form-control" name="brand" placeholder="e.g., Godrej, Nilkamal">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Purchase Date</label>
                                <input type="date" class="form-control" name="purchase_date">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Purchase Cost</label>
                                <input type="number" class="form-control" name="purchase_cost" step="0.01" min="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Overall Condition</label>
                                <select class="form-select" name="overall_condition">
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
                        <label class="form-label">Vendor/Supplier</label>
                        <input type="text" class="form-control" name="vendor" placeholder="Supplier name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Specifications</label>
                        <textarea class="form-control" name="specifications" rows="3" placeholder="Item specifications and details"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Add Amenity
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Schedule Maintenance Modal -->
<div class="modal fade" id="scheduleMaintenanceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Schedule Maintenance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="scheduleMaintenanceForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Select Amenity <span class="text-danger">*</span></label>
                        <select class="form-select" name="amenity_id" required id="maintenanceAmenitySelect">
                            <option value="">Select Amenity</option>
                            <!-- Amenities will be populated -->
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Maintenance Type <span class="text-danger">*</span></label>
                        <select class="form-select" name="maintenance_type" required>
                            <option value="">Select Type</option>
                            <option value="repair">Repair</option>
                            <option value="replacement">Replacement</option>
                            <option value="upgrade">Upgrade</option>
                            <option value="disposal">Disposal</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Maintenance Date</label>
                                <input type="date" class="form-control" name="maintenance_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Priority</label>
                                <select class="form-select" name="priority">
                                    <option value="low">Low</option>
                                    <option value="medium" selected>Medium</option>
                                    <option value="high">High</option>
                                    <option value="urgent">Urgent</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Quantity Affected</label>
                        <input type="number" class="form-control" name="quantity_affected" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Issue Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="issue_description" rows="3" required placeholder="Describe the issue or maintenance required"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Estimated Cost</label>
                        <input type="number" class="form-control" name="maintenance_cost" step="0.01" min="0">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Maintenance Vendor</label>
                        <input type="text" class="form-control" name="maintenance_vendor" placeholder="Vendor/Contractor name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-calendar"></i>
                        Schedule Maintenance
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Global variables
let classes = [];
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
    loadClasses();
    loadAmenities();
    loadMaintenanceRecords();
    initializeCharts();
});

// Tab switching function
function switchTab(event, tabId) {
    event.preventDefault();
    
    // Hide all tab panes
    document.querySelectorAll('.tab-pane').forEach(pane => {
        pane.classList.remove('active');
    });
    
    // Remove active class from all nav links
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('active');
    });
    
    // Show selected tab and mark nav link as active
    document.getElementById(tabId).classList.add('active');
    event.target.classList.add('active');
    
    // Load specific tab content
    if (tabId === 'amenities-tab') {
        loadAmenities();
    } else if (tabId === 'maintenance-tab') {
        loadMaintenanceRecords();
    } else if (tabId === 'reports-tab') {
        updateCharts();
    }
}

// Load classes
function loadClasses() {
    fetch('/api/classes')
        .then(response => response.json())
        .then(data => {
            classes = data.classes;
            renderClasses(classes);
            populateClassSelects();
        })
        .catch(error => {
            console.error('Error loading classes:', error);
            showAlert('error', 'Failed to load classes');
        });
}

// Render classes grid
function renderClasses(classesData) {
    const grid = document.getElementById('classesGrid');
    grid.innerHTML = '';
    
    classesData.forEach(classItem => {
        const classCard = createClassCard(classItem);
        grid.appendChild(classCard);
    });
}

// Create class card
function createClassCard(classItem) {
    const card = document.createElement('div');
    card.className = 'class-card';
    
    const utilizationPercentage = classItem.current_student_count / classItem.student_capacity * 100;
    const utilizationColor = utilizationPercentage > 90 ? '#ef4444' : utilizationPercentage > 75 ? '#f59e0b' : '#10b981';
    
    card.innerHTML = `
        <div class="class-header">
            <h3 class="class-name">${classItem.display_name}</h3>
            <span class="class-status status-${classItem.status}">${classItem.status}</span>
        </div>
        
        <div class="class-info">
            <div class="info-row">
                <span class="info-label">Room:</span>
                <span class="info-value">${classItem.room_number || 'Not Assigned'}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Teacher:</span>
                <span class="info-value">${classItem.class_teacher?.name || 'Not Assigned'}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Students:</span>
                <span class="info-value" style="color: ${utilizationColor}">
                    ${classItem.current_student_count}/${classItem.student_capacity}
                </span>
            </div>
            <div class="info-row">
                <span class="info-label">Building:</span>
                <span class="info-value">${classItem.building || 'Main'}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Floor:</span>
                <span class="info-value">${classItem.floor_number !== null ? classItem.floor_number : 'N/A'}</span>
            </div>
        </div>
        
        <div class="class-actions">
            <button class="btn btn-primary btn-sm" onclick="editClass(${classItem.id})">
                <i class="fas fa-edit"></i>
                Edit
            </button>
            <button class="btn btn-success btn-sm" onclick="viewAmenities(${classItem.id})">
                <i class="fas fa-chair"></i>
                Amenities
            </button>
            <button class="btn btn-warning btn-sm" onclick="manageStudents(${classItem.id})">
                <i class="fas fa-users"></i>
                Students
            </button>
            <button class="btn btn-danger btn-sm" onclick="deleteClass(${classItem.id})">
                <i class="fas fa-trash"></i>
                Delete
            </button>
        </div>
    `;
    
    return card;
}

// Filter classes
function filterClasses() {
    const gradeType = document.getElementById('gradeTypeFilter').value;
    const academicYear = document.getElementById('academicYearFilter').value;
    const status = document.getElementById('statusFilter').value;
    const search = document.getElementById('searchFilter').value.toLowerCase();
    
    let filteredClasses = classes.filter(classItem => {
        return (!gradeType || classItem.grade_type === gradeType) &&
               (!academicYear || classItem.academic_year === academicYear) &&
               (!status || classItem.status === status) &&
               (!search || classItem.display_name.toLowerCase().includes(search) ||
                           classItem.room_number?.toLowerCase().includes(search) ||
                           classItem.class_teacher?.name?.toLowerCase().includes(search));
    });
    
    renderClasses(filteredClasses);
}

// Create class form submission
document.getElementById('createClassForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    
    fetch('/api/classes', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            showAlert('success', 'Class created successfully!');
            document.getElementById('createClassModal').querySelector('.btn-close').click();
            this.reset();
            loadClasses();
        } else {
            showAlert('error', result.message || 'Failed to create class');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('error', 'An error occurred while creating the class');
    });
});

// Update item options based on type
function updateItemOptions() {
    const typeSelect = document.querySelector('select[name="item_type"]');
    const itemSelect = document.getElementById('itemNameSelect');
    const selectedType = typeSelect.value;
    
    itemSelect.innerHTML = '<option value="">Select Item</option>';
    
    if (selectedType && itemOptions[selectedType]) {
        itemOptions[selectedType].forEach(item => {
            const option = document.createElement('option');
            option.value = item;
            option.textContent = item;
            itemSelect.appendChild(option);
        });
    }
}

// Update working quantity
function updateWorkingQuantity() {
    const totalInput = document.querySelector('input[name="total_quantity"]');
    const workingInput = document.getElementById('workingQuantityInput');
    
    if (totalInput.value) {
        workingInput.value = totalInput.value;
    }
}

// Load amenities
function loadAmenities() {
    fetch('/api/amenities')
        .then(response => response.json())
        .then(data => {
            amenities = data.amenities;
            renderAmenities(amenities);
            populateAmenitySelects();
        })
        .catch(error => {
            console.error('Error loading amenities:', error);
            showAlert('error', 'Failed to load amenities');
        });
}

// Render amenities grid
function renderAmenities(amenitiesData) {
    const grid = document.getElementById('amenitiesGrid');
    grid.innerHTML = '';
    
    amenitiesData.forEach(amenity => {
        const amenityCard = createAmenityCard(amenity);
        grid.appendChild(amenityCard);
    });
}

// Create amenity card
function createAmenityCard(amenity) {
    const card = document.createElement('div');
    card.className = 'amenity-card';
    
    card.innerHTML = `
        <div class="amenity-header">
            <div>
                <strong class="amenity-name">${amenity.item_name}</strong>
                <div style="font-size: 12px; color: #6b7280;">${amenity.class.display_name}</div>
            </div>
            <span class="condition-indicator condition-${amenity.overall_condition}"></span>
        </div>
        
        <div class="amenity-stats">
            <div class="stat-item">
                <div class="stat-number">${amenity.total_quantity}</div>
                <div class="stat-label">Total</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">${amenity.working_quantity}</div>
                <div class="stat-label">Working</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">${amenity.damaged_quantity}</div>
                <div class="stat-label">Damaged</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">${amenity.repair_quantity}</div>
                <div class="stat-label">Repair</div>
            </div>
        </div>
        
        <div class="d-flex gap-2">
            <button class="btn btn-primary btn-sm flex-fill" onclick="editAmenity(${amenity.id})">
                <i class="fas fa-edit"></i>
                Edit
            </button>
            <button class="btn btn-warning btn-sm flex-fill" onclick="scheduleMaintenance(${amenity.id})">
                <i class="fas fa-tools"></i>
                Maintain
            </button>
        </div>
    `;
    
    return card;
}

// Show alert
function showAlert(type, message) {
    // Create alert element
    const alert = document.createElement('div');
    alert.className = `alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show`;
    alert.style.position = 'fixed';
    alert.style.top = '20px';
    alert.style.right = '20px';
    alert.style.zIndex = '9999';
    alert.style.minWidth = '300px';
    
    alert.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'}"></i>
        ${message}
        <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
    `;
    
    document.body.appendChild(alert);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (alert.parentElement) {
            alert.remove();
        }
    }, 5000);
}

// Initialize charts
function initializeCharts() {
    // Class Utilization Chart
    const utilizationCtx = document.getElementById('classUtilizationChart').getContext('2d');
    window.utilizationChart = new Chart(utilizationCtx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Student Count',
                data: [],
                backgroundColor: '#667eea',
                borderColor: '#5a67d8',
                borderWidth: 1
            }, {
                label: 'Capacity',
                data: [],
                backgroundColor: '#e5e7eb',
                borderColor: '#d1d5db',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Class Utilization'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    
    // Amenity Condition Chart
    const conditionCtx = document.getElementById('amenityConditionChart').getContext('2d');
    window.conditionChart = new Chart(conditionCtx, {
        type: 'doughnut',
        data: {
            labels: ['Excellent', 'Good', 'Fair', 'Poor', 'Damaged'],
            datasets: [{
                data: [0, 0, 0, 0, 0],
                backgroundColor: ['#10b981', '#3b82f6', '#f59e0b', '#ef4444', '#6b7280']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Amenity Conditions'
                }
            }
        }
    });
}

// Populate class selects
function populateClassSelects() {
    const selects = document.querySelectorAll('#amenityClassSelect, #maintenanceClassSelect');
    selects.forEach(select => {
        select.innerHTML = '<option value="">Select Class</option>';
        classes.forEach(classItem => {
            const option = document.createElement('option');
            option.value = classItem.id;
            option.textContent = classItem.display_name;
            select.appendChild(option);
        });
    });
}

// Populate amenity selects
function populateAmenitySelects() {
    const select = document.getElementById('maintenanceAmenitySelect');
    select.innerHTML = '<option value="">Select Amenity</option>';
    amenities.forEach(amenity => {
        const option = document.createElement('option');
        option.value = amenity.id;
        option.textContent = `${amenity.item_name} - ${amenity.class.display_name}`;
        select.appendChild(option);
    });
}

// Export classes
function exportClasses() {
    window.open('/api/classes/export', '_blank');
}

// Placeholder functions for actions
function editClass(id) {
    showAlert('info', 'Edit class functionality will be implemented');
}

function viewAmenities(id) {
    // Switch to amenities tab and filter by class
    switchTab({preventDefault: () => {}, target: document.querySelector('a[href="#amenities-tab"]')}, 'amenities-tab');
}

function manageStudents(id) {
    showAlert('info', 'Student management functionality will be implemented');
}

function deleteClass(id) {
    if (confirm('Are you sure you want to delete this class?')) {
        fetch(`/api/classes/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                showAlert('success', 'Class deleted successfully!');
                loadClasses();
            } else {
                showAlert('error', result.message || 'Failed to delete class');
            }
        });
    }
}

function editAmenity(id) {
    showAlert('info', 'Edit amenity functionality will be implemented');
}

function scheduleMaintenance(id) {
    document.getElementById('maintenanceAmenitySelect').value = id;
    new bootstrap.Modal(document.getElementById('scheduleMaintenanceModal')).show();
}

function loadMaintenanceRecords() {
    // Placeholder - will be implemented with actual API
    showAlert('info', 'Maintenance records will be loaded');
}

function updateCharts() {
    // Update charts with current data
    if (window.utilizationChart && classes.length > 0) {
        const labels = classes.map(c => c.display_name);
        const studentCounts = classes.map(c => c.current_student_count || 0);
        const capacities = classes.map(c => c.student_capacity || 0);
        
        window.utilizationChart.data.labels = labels;
        window.utilizationChart.data.datasets[0].data = studentCounts;
        window.utilizationChart.data.datasets[1].data = capacities;
        window.utilizationChart.update();
    }
    
    if (window.conditionChart && amenities.length > 0) {
        const conditionCounts = {
            excellent: 0,
            good: 0,
            fair: 0,
            poor: 0,
            damaged: 0
        };
        
        amenities.forEach(amenity => {
            if (conditionCounts.hasOwnProperty(amenity.overall_condition)) {
                conditionCounts[amenity.overall_condition]++;
            }
        });
        
        window.conditionChart.data.datasets[0].data = Object.values(conditionCounts);
        window.conditionChart.update();
    }
}

// Add amenity form submission
document.getElementById('addAmenityForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    
    // Validate quantities
    const total = parseInt(data.total_quantity);
    const working = parseInt(data.working_quantity || 0);
    const damaged = parseInt(data.damaged_quantity || 0);
    const repair = parseInt(data.repair_quantity || 0);
    
    if (working + damaged + repair > total) {
        showAlert('error', 'Sum of working, damaged, and repair quantities cannot exceed total quantity');
        return;
    }
    
    fetch('/api/amenities', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            showAlert('success', 'Amenity added successfully!');
            document.getElementById('addAmenityModal').querySelector('.btn-close').click();
            this.reset();
            loadAmenities();
            updateCharts();
        } else {
            showAlert('error', result.message || 'Failed to add amenity');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('error', 'An error occurred while adding the amenity');
    });
});

// Schedule maintenance form submission
document.getElementById('scheduleMaintenanceForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    
    fetch('/api/maintenance', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            showAlert('success', 'Maintenance scheduled successfully!');
            document.getElementById('scheduleMaintenanceModal').querySelector('.btn-close').click();
            this.reset();
            loadMaintenanceRecords();
        } else {
            showAlert('error', result.message || 'Failed to schedule maintenance');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('error', 'An error occurred while scheduling maintenance');
    });
});

// Load maintenance records function
function loadMaintenanceRecords() {
    fetch('/api/maintenance')
        .then(response => response.json())
        .then(data => {
            maintenanceRecords = data.records || [];
            renderMaintenanceTable(maintenanceRecords);
        })
        .catch(error => {
            console.error('Error loading maintenance records:', error);
            showAlert('error', 'Failed to load maintenance records');
        });
}

// Render maintenance table
function renderMaintenanceTable(records) {
    const tbody = document.querySelector('#maintenanceTable tbody');
    tbody.innerHTML = '';
    
    if (records.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="8" class="text-center py-4">
                    <i class="fas fa-tools fa-3x text-muted mb-3"></i>
                    <div>No maintenance records found</div>
                </td>
            </tr>
        `;
        return;
    }
    
    records.forEach(record => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${formatDate(record.maintenance_date)}</td>
            <td>${record.amenity.class.display_name}</td>
            <td>${record.amenity.item_name}</td>
            <td>
                <span class="badge bg-${getMaintenanceTypeColor(record.maintenance_type)}">
                    ${record.maintenance_type}
                </span>
            </td>
            <td>
                <span class="badge bg-${getPriorityColor(record.priority)}">
                    ${record.priority}
                </span>
            </td>
            <td>
                <span class="badge bg-${getStatusColor(record.status)}">
                    ${record.status}
                </span>
            </td>
            <td>₹${record.maintenance_cost || 0}</td>
            <td>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary" onclick="viewMaintenanceDetails(${record.id})">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn btn-outline-success" onclick="updateMaintenanceStatus(${record.id})">
                        <i class="fas fa-check"></i>
                    </button>
                    <button class="btn btn-outline-danger" onclick="deleteMaintenanceRecord(${record.id})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        `;
        tbody.appendChild(row);
    });
}

// Helper functions for maintenance table
function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString('en-IN');
}

function getMaintenanceTypeColor(type) {
    const colors = {
        repair: 'warning',
        replacement: 'danger',
        upgrade: 'info',
        disposal: 'secondary'
    };
    return colors[type] || 'secondary';
}

function getPriorityColor(priority) {
    const colors = {
        low: 'success',
        medium: 'warning',
        high: 'danger',
        urgent: 'dark'
    };
    return colors[priority] || 'secondary';
}

function getStatusColor(status) {
    const colors = {
        pending: 'warning',
        in_progress: 'info',
        completed: 'success',
        cancelled: 'secondary'
    };
    return colors[status] || 'secondary';
}

// Maintenance action functions
function viewMaintenanceDetails(id) {
    const record = maintenanceRecords.find(r => r.id === id);
    if (record) {
        showAlert('info', `Details: ${record.issue_description}`);
    }
}

function updateMaintenanceStatus(id) {
    const newStatus = prompt('Enter new status (pending, in_progress, completed, cancelled):');
    if (newStatus && ['pending', 'in_progress', 'completed', 'cancelled'].includes(newStatus)) {
        fetch(`/api/maintenance/${id}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ status: newStatus })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                showAlert('success', 'Status updated successfully!');
                loadMaintenanceRecords();
            } else {
                showAlert('error', result.message || 'Failed to update status');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('error', 'An error occurred while updating status');
        });
    }
}

function deleteMaintenanceRecord(id) {
    if (confirm('Are you sure you want to delete this maintenance record?')) {
        fetch(`/api/maintenance/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                showAlert('success', 'Maintenance record deleted successfully!');
                loadMaintenanceRecords();
            } else {
                showAlert('error', result.message || 'Failed to delete record');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('error', 'An error occurred while deleting the record');
        });
    }
}

// Auto-calculate quantities in amenity form
document.addEventListener('change', function(e) {
    if (e.target.name === 'damaged_quantity' || e.target.name === 'repair_quantity') {
        const form = e.target.closest('form');
        if (form && form.id === 'addAmenityForm') {
            const total = parseInt(form.querySelector('[name="total_quantity"]').value || 0);
            const damaged = parseInt(form.querySelector('[name="damaged_quantity"]').value || 0);
            const repair = parseInt(form.querySelector('[name="repair_quantity"]').value || 0);
            const working = total - damaged - repair;
            
            if (working >= 0) {
                form.querySelector('[name="working_quantity"]').value = working;
            }
        }
    }
});

// Search functionality for maintenance records
function searchMaintenanceRecords(query) {
    if (!query) {
        renderMaintenanceTable(maintenanceRecords);
        return;
    }
    
    const filtered = maintenanceRecords.filter(record => 
        record.amenity.class.display_name.toLowerCase().includes(query.toLowerCase()) ||
        record.amenity.item_name.toLowerCase().includes(query.toLowerCase()) ||
        record.maintenance_type.toLowerCase().includes(query.toLowerCase()) ||
        record.issue_description.toLowerCase().includes(query.toLowerCase())
    );
    
    renderMaintenanceTable(filtered);
}

// Add search input for maintenance records
document.addEventListener('DOMContentLoaded', function() {
    const maintenanceTab = document.getElementById('maintenance-tab');
    if (maintenanceTab) {
        const searchInput = document.createElement('input');
        searchInput.type = 'text';
        searchInput.className = 'form-control mb-3';
        searchInput.placeholder = 'Search maintenance records...';
        searchInput.addEventListener('input', (e) => searchMaintenanceRecords(e.target.value));
        
        const table = maintenanceTab.querySelector('.table-responsive');
        if (table) {
            table.parentNode.insertBefore(searchInput, table);
        }
    }
});

// Print functionality
function printClassReport() {
    const printWindow = window.open('', '_blank');
    printWindow.document.write(`
        <html>
            <head>
                <title>Class Management Report</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    .header { text-align: center; margin-bottom: 30px; }
                    .stats { display: flex; justify-content: space-around; margin-bottom: 30px; }
                    .stat-box { text-align: center; padding: 20px; border: 1px solid #ddd; }
                    table { width: 100%; border-collapse: collapse; }
                    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                    th { background-color: #f5f5f5; }
                </style>
            </head>
            <body>
                <div class="header">
                    <h1>Class Management Report</h1>
                    <p>Generated on: ${new Date().toLocaleDateString()}</p>
                </div>
                ${generatePrintContent()}
            </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.print();
}

function generatePrintContent() {
    let content = '<div class="stats">';
    content += `<div class="stat-box"><h3>${classes.length}</h3><p>Total Classes</p></div>`;
    content += `<div class="stat-box"><h3>${amenities.length}</h3><p>Total Amenities</p></div>`;
    content += `<div class="stat-box"><h3>${maintenanceRecords.length}</h3><p>Maintenance Records</p></div>`;
    content += '</div>';
    
    content += '<h2>Classes Overview</h2>';
    content += '<table><thead><tr><th>Class</th><th>Teacher</th><th>Students</th><th>Room</th><th>Status</th></tr></thead><tbody>';
    classes.forEach(cls => {
        content += `<tr>
            <td>${cls.display_name}</td>
            <td>${cls.class_teacher?.name || 'Not Assigned'}</td>
            <td>${cls.current_student_count}/${cls.student_capacity}</td>
            <td>${cls.room_number || 'N/A'}</td>
            <td>${cls.status}</td>
        </tr>`;
    });
    content += '</tbody></table>';
    
    return content;
}

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl + N: New Class
    if (e.ctrlKey && e.key === 'n') {
        e.preventDefault();
        document.querySelector('[data-bs-target="#createClassModal"]').click();
    }
    
    // Ctrl + E: Export
    if (e.ctrlKey && e.key === 'e') {
        e.preventDefault();
        exportClasses();
    }
    
    // Ctrl + P: Print
    if (e.ctrlKey && e.key === 'p') {
        e.preventDefault();
        printClassReport();
    }
});

// Refresh data every 5 minutes
setInterval(function() {
    if (document.visibilityState === 'visible') {
        loadClasses();
        loadAmenities();
        loadMaintenanceRecords();
        updateCharts();
    }
}, 300000); // 5 minutes

// Handle page visibility change
document.addEventListener('visibilitychange', function() {
    if (!document.hidden) {
        // Refresh data when page becomes visible
        loadClasses();
        loadAmenities();
        loadMaintenanceRecords();
        updateCharts();
    }
});

// Error handling for network issues
window.addEventListener('online', function() {
    showAlert('success', 'Connection restored. Refreshing data...');
    loadClasses();
    loadAmenities();
    loadMaintenanceRecords();
});

window.addEventListener('offline', function() {
    showAlert('warning', 'You are offline. Some features may not work properly.');
});

console.log('Class Management Dashboard initialized successfully!');
</script>
@endpush