<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Management - EduManage</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            color: #2d3748;
            line-height: 1.6;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100vh;
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
            z-index: 1000;
            transition: transform 0.3s ease;
            overflow-y: auto;
        }

        .sidebar.collapsed {
            transform: translateX(-280px);
        }

        .sidebar-header {
            padding: 30px 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .sidebar-header .logo {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .sidebar-header .tagline {
            font-size: 12px;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar-nav {
            padding: 20px 0;
        }

        .nav-section {
            margin-bottom: 30px;
        }

        .nav-section-title {
            padding: 0 25px 10px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.6;
            font-weight: 600;
        }

        .nav-item {
            margin-bottom: 5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: #ffffff;
        }

        .nav-link i {
            width: 20px;
            margin-right: 15px;
            font-size: 16px;
        }

        .nav-link .badge {
            margin-left: auto;
            background: rgba(255, 255, 255, 0.2);
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 0;
        }

        /* Header */
        .header {
            background: white;
            padding: 20px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #4a5568;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: #2d3748;
        }

        .breadcrumb {
            font-size: 14px;
            color: #718096;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .search-bar {
            position: relative;
        }

        .search-bar input {
            padding: 10px 40px 10px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            width: 300px;
            font-size: 14px;
        }

        .search-bar i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
        }

        .header-icons {
            display: flex;
            gap: 15px;
        }

        .header-icon {
            position: relative;
            padding: 8px;
            border-radius: 8px;
            background: #f7fafc;
            color: #4a5568;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .header-icon:hover {
            background: #edf2f7;
            color: #2d3748;
        }

        .header-icon .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #e53e3e;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 5px 15px;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        .user-profile:hover {
            background: #f7fafc;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3498db, #2980b9);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .user-info h4 {
            font-size: 14px;
            font-weight: 600;
        }

        .user-info p {
            font-size: 12px;
            color: #718096;
        }

        /* Teacher Management Content */
        .teachers-content {
            padding: 30px;
        }

        /* Action Bar */
        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            gap: 20px;
            flex-wrap: wrap;
        }

        .action-left {
            display: flex;
            gap: 15px;
            align-items: center;
            flex: 1;
        }

        .action-right {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .filter-dropdown {
            position: relative;
        }

        .filter-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            border: 1px solid #e2e8f0;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn:hover {
            border-color: #3498db;
            color: #3498db;
        }

        .sort-dropdown {
            position: relative;
        }

        .sort-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            border: 1px solid #e2e8f0;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .sort-btn:hover {
            border-color: #3498db;
            color: #3498db;
        }

        .add-teacher-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .add-teacher-btn:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--card-color);
        }

        .stat-card.total { --card-color: #3498db; }
        .stat-card.active { --card-color: #2ecc71; }
        .stat-card.departments { --card-color: #f39c12; }
        .stat-card.pending { --card-color: #e74c3c; }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
            background: var(--card-color);
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 14px;
            color: #718096;
            font-weight: 500;
        }

        /* Teachers Table */
        .teachers-table-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .table-header {
            padding: 25px 30px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-title {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
        }

        .table-actions {
            display: flex;
            gap: 10px;
        }

        .table-btn {
            padding: 8px 12px;
            border: 1px solid #e2e8f0;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .table-btn:hover {
            border-color: #3498db;
            color: #3498db;
        }

        .teachers-table {
            width: 100%;
            border-collapse: collapse;
        }

        .teachers-table th {
            background: #f8fafc;
            padding: 15px 20px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            color: #4a5568;
            border-bottom: 1px solid #e2e8f0;
        }

        .teachers-table td {
            padding: 20px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .teachers-table tr:hover {
            background: #f8fafc;
        }

        .teacher-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .teacher-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3498db, #2980b9);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
        }

        .teacher-details h4 {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 2px;
        }

        .teacher-details p {
            font-size: 13px;
            color: #718096;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-badge.active {
            background: #d4edda;
            color: #155724;
        }

        .status-badge.inactive {
            background: #f8d7da;
            color: #721c24;
        }

        .status-badge.pending {
            background: #fff3cd;
            color: #856404;
        }

        .department-tag {
            display: inline-block;
            padding: 4px 8px;
            background: #e3f2fd;
            color: #1976d2;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            width: 35px;
            height: 35px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .action-btn.view {
            background: #e3f2fd;
            color: #1976d2;
        }

        .action-btn.view:hover {
            background: #1976d2;
            color: white;
        }

        .action-btn.edit {
            background: #fff3e0;
            color: #f57c00;
        }

        .action-btn.edit:hover {
            background: #f57c00;
            color: white;
        }

        .action-btn.delete {
            background: #ffebee;
            color: #d32f2f;
        }

        .action-btn.delete:hover {
            background: #d32f2f;
            color: white;
        }

        /* Modal Styles */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 10000;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 15px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            padding: 25px 30px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 600;
            color: #2d3748;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #718096;
            padding: 5px;
        }

        .modal-close:hover {
            color: #2d3748;
        }

        .modal-body {
            padding: 30px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
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
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        .form-select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            cursor: pointer;
        }

        .form-textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            resize: vertical;
            min-height: 100px;
        }

        .modal-footer {
            padding: 20px 30px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background: #2980b9;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 30px;
            padding: 20px 0;
        }

        .pagination-btn {
            padding: 8px 12px;
            border: 1px solid #e2e8f0;
            background: white;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pagination-btn:hover,
        .pagination-btn.active {
            background: #3498db;
            color: white;
            border-color: #3498db;
        }

        .pagination-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .search-bar input {
                width: 200px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-280px);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .menu-btn {
                display: block;
            }

            .header {
                padding: 15px 20px;
            }

            .teachers-content {
                padding: 20px;
            }

            .action-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .action-left,
            .action-right {
                justify-content: center;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .search-bar {
                display: none;
            }

            .user-info {
                display: none;
            }

            .teachers-table {
                font-size: 13px;
            }

            .teachers-table th,
            .teachers-table td {
                padding: 12px 8px;
            }

            .teacher-info {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }

            .modal-content {
                width: 95%;
                margin: 20px;
            }

            .modal-body {
                padding: 20px;
            }
        }

        /* Loading States */
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .action-buttons a,
.action-buttons form button {
    padding: 6px 12px;
    font-size: 14px;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
    margin-right: 5px;
    transition: background-color 0.2s ease;
}

.action-buttons a {
    background-color: #3498db;
    color: white;
}

.action-buttons a:hover {
    background-color: #2980b9;
}

.action-buttons form button {
    background-color: #e74c3c;
    color: white;
}

.action-buttons form button:hover {
    background-color: #c0392b;
}

    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-graduation-cap"></i>
                EduManage
            </div>
            <div class="tagline">Super Admin Panel</div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-section-title">Main</div>
                <div class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-chart-line"></i>
                        Analytics
                    </a>
                </div>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">User Management</div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user-graduate"></i>
                        Students
                        <span class="badge">1,247</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-chalkboard-teacher"></i>
                        Teachers
                        <span class="badge">89</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user-tie"></i>
                        Staff
                        <span class="badge">45</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-user-shield"></i>
                        Admins
                        <span class="badge">12</span>
                    </a>
                </div>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">Academic</div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-school"></i>
                        Schools
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-book"></i>
                        Courses
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-calendar-alt"></i>
                        Schedule
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-graduation-cap"></i>
                        Examinations
                    </a>
                </div>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">System</div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cog"></i>
                        Settings
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-shield-alt"></i>
                        Security
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file-alt"></i>
                        Reports
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-question-circle"></i>
                        Help & Support
                    </a>
                </div>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <!-- Header -->
        <header class="header">
            <div class="header-left">
                <button class="menu-btn" id="menuBtn">
                    <i class="fas fa-bars"></i>
                </button>
                <div>
                    <h1 class="page-title">Teachers</h1>
                    <div class="breadcrumb">Home / User Management / Teachers</div>
                </div>
            </div>

            <div class="header-right">
                <div class="search-bar">
                    <input type="text" placeholder="Search teachers..." id="globalSearch">
                    <i class="fas fa-search"></i>
                </div>

                <div class="header-icons">
                    <div class="header-icon">
                        <i class="fas fa-bell"></i>
                        <span class="badge">3</span>
                    </div>
                    <div class="header-icon">
                        <i class="fas fa-envelope"></i>
                        <span class="badge">7</span>
                    </div>
                </div>

                <div class="user-profile">
                    <div class="user-avatar">SA</div>
                    <div class="user-info">
                        <h4>Super Admin</h4>
                        <p>admin@edumanage.com</p>
                    </div>
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
        </header>

        <!-- Teachers Content -->
        <div class="teachers-content">
            <!-- Action Bar -->
            <div class="action-bar">
                <div class="action-left">
                    <div class="filter-dropdown">
                        <button class="filter-btn" id="filterBtn">
                            <i class="fas fa-filter"></i>
                            Filter
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                    
                    <div class="sort-dropdown">
                        <button class="sort-btn" id="sortBtn">
                            <i class="fas fa-sort"></i>
                            Sort by Name
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                </div>

                <div class="action-right">
    <a href="{{ route('addteacher') }}" class="add-teacher-btn" id="addTeacherBtn">
        <i class="fas fa-plus"></i>
        Add Teacher
    </a>
</div>

            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card total">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="stat-number">89</div>
                    <div class="stat-label">Total Teachers</div>
                </div>

                <div class="stat-card active">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                    </div>
                    <div class="stat-number">74</div>
                    <div class="stat-label">Active Teachers</div>
                </div>

                <div class="stat-card departments">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-building"></i>
                        </div>
                    </div>
                    <div class="stat-number">12</div>
                    <div class="stat-label">Departments</div>
                </div>

                <div class="stat-card pending">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <div class="stat-number">8</div>
                    <div class="stat-label">Pending Approval</div>
                </div>
            </div>

            <!-- Teachers Table -->
            <div class="teachers-table-container">
                <div class="table-header">
                    <h3 class="table-title">All Teachers</h3>
                    <div class="table-actions">
                        <button class="table-btn">
                            <i class="fas fa-download"></i>
                            Export
                        </button>
                        <button class="table-btn">
                            <i class="fas fa-print"></i>
                            Print
                        </button>
                    </div>
                </div>

                <table class="teachers-table">
                    <thead>
                        <tr>
                            <th>Teacher</th>
                            <th>Employee ID</th>
                            <th>Department</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Joined Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="teachersTableBody">
    @foreach($teachers as $teacher)
        <tr>
            <td>{{ $teacher->first_name }} {{ $teacher->last_name }}</td>
            <td>{{ $teacher->employee_id }}</td>
            <td>{{ $teacher->department }}</td>
            <td>{{ $teacher->phone }}</td>
            <td>
                <span style="color: green;">Active</span> {{-- You can enhance this with a column in DB --}}
            </td>
            <td>{{ \Carbon\Carbon::parse($teacher->join_date)->format('d M Y') }}</td>
           <td class="action-buttons">
            <a href="{{route('teacher.edit', $teacher->id)}}">Edit</a>

            <form action="{{-- route('teachers.destroy', $teacher->id) --}}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </td>

        </tr>
    @endforeach
</tbody>

                </table>

                <!-- Pagination -->
                <div class="pagination">
                    <button class="pagination-btn" id="prevBtn">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="pagination-btn active">1</button>
                    <button class="pagination-btn">2</button>
                    <button class="pagination-btn">3</button>
                    <button class="pagination-btn">4</button>
                    <button class="pagination-btn" id="nextBtn">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </main>

    <!-- Add/Edit Teacher Modal -->
    <div class="modal" id="teacherModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Add New Teacher</h2>
                <button class="modal-close" id="modalClose">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            
            
        </div>
    </div>

    <script>
        // Sample teacher data
       

        let currentTeachers = [...teachersData];
        let editingTeacherId = null;

        // DOM Elements
        const menuBtn = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const addTeacherBtn = document.getElementById('addTeacherBtn');
        const teacherModal = document.getElementById('teacherModal');
        const modalClose = document.getElementById('modalClose');
        const cancelBtn = document.getElementById('cancelBtn');
        const saveBtn = document.getElementById('saveBtn');
        const teacherForm = document.getElementById('teacherForm');
        const modalTitle = document.getElementById('modalTitle');
        const globalSearch = document.getElementById('globalSearch');
        const teachersTableBody = document.getElementById('teachersTableBody');

        // Initialize the application
        function init() {
            renderTeachers();
            setupEventListeners();
        }

        // Setup event listeners
        function setupEventListeners() {
            // Menu toggle
            menuBtn?.addEventListener('click', toggleSidebar);

            // Add teacher button
         

            // Modal close buttons
           

            // Save button


            // Global search
            globalSearch.addEventListener('input', handleSearch);

            // Form submission
           // teacherForm.addEventListener('submit', handleFormSubmit);

            // Click outside modal to close
            teacherModal.addEventListener('click', function(e) {
                if (e.target === teacherModal) {
                    closeModal();
                }
            });
        }

        // Toggle sidebar
        function toggleSidebar() {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        }

        // Render teachers table
        function renderTeachers() {
            teachersTableBody.innerHTML = '';

            currentTeachers.forEach(teacher => {
                const row = createTeacherRow(teacher);
                teachersTableBody.appendChild(row);
            });
        }

        // Create teacher table row
        function createTeacherRow(teacher) {
            const row = document.createElement('tr');
            
            const initials = (teacher.firstName[0] + teacher.lastName[0]).toUpperCase();
            const joinDate = new Date(teacher.joinDate).toLocaleDateString();
            
            row.innerHTML = `
                <td>
                    <div class="teacher-info">
                        <div class="teacher-avatar">${initials}</div>
                        <div class="teacher-details">
                            <h4>${teacher.firstName} ${teacher.lastName}</h4>
                            <p>${teacher.email}</p>
                        </div>
                    </div>
                </td>
                <td>${teacher.employeeId}</td>
                <td>
                    <span class="department-tag">${teacher.department}</span>
                </td>
                <td>${teacher.phone}</td>
                <td>
                    <span class="status-badge ${teacher.status}">${teacher.status.toUpperCase()}</span>
                </td>
                <td>${joinDate}</td>
                <td>
                    <div class="action-buttons">
                        <button class="action-btn view" onclick="viewTeacher(${teacher.id})" title="View Details">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="action-btn edit" onclick="editTeacher(${teacher.id})" title="Edit Teacher">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="action-btn delete" onclick="deleteTeacher(${teacher.id})" title="Delete Teacher">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            `;

            return row;
        }

        // Open add teacher modal
    

        // Edit teacher
        function editTeacher(id) {
            const teacher = currentTeachers.find(t => t.id === id);
            if (!teacher) return;

            editingTeacherId = id;
            modalTitle.textContent = 'Edit Teacher';
            saveBtn.textContent = 'Update Teacher';

            // Populate form fields
            document.getElementById('firstName').value = teacher.firstName;
            document.getElementById('lastName').value = teacher.lastName;
            document.getElementById('email').value = teacher.email;
            document.getElementById('phone').value = teacher.phone;
            document.getElementById('employeeId').value = teacher.employeeId;
            document.getElementById('department').value = teacher.department;
            document.getElementById('qualification').value = teacher.qualification;
            document.getElementById('experience').value = teacher.experience;
            document.getElementById('joinDate').value = teacher.joinDate;
            document.getElementById('salary').value = teacher.salary;
            document.getElementById('address').value = teacher.address;

            teacherModal.classList.add('show');
        }

        // View teacher details
        function viewTeacher(id) {
            const teacher = currentTeachers.find(t => t.id === id);
            if (!teacher) return;

            alert(`Teacher Details:\n\nName: ${teacher.firstName} ${teacher.lastName}\nEmployee ID: ${teacher.employeeId}\nDepartment: ${teacher.department}\nEmail: ${teacher.email}\nPhone: ${teacher.phone}\nQualification: ${teacher.qualification}\nExperience: ${teacher.experience} years\nStatus: ${teacher.status}`);
        }

        // Delete teacher
        function deleteTeacher(id) {
            if (confirm('Are you sure you want to delete this teacher?')) {
                const index = currentTeachers.findIndex(t => t.id === id);
                if (index > -1) {
                    currentTeachers.splice(index, 1);
                    renderTeachers();
                    updateStats();
                }
            }
        }

        // Close modal
        function closeModal() {
            teacherModal.classList.remove('show');
            teacherForm.reset();
            editingTeacherId = null;
        }

        // Handle form submission
      
        // Save teacher
 

            if (editingTeacherId) {
                // Update existing teacher
                const index = currentTeachers.findIndex(t => t.id === editingTeacherId);
                if (index > -1) {
                    currentTeachers[index] = { ...currentTeachers[index], ...teacherData };
                }
            } else {
                // Add new teacher
                const newId = Math.max(...currentTeachers.map(t => t.id)) + 1;
                currentTeachers.push({ id: newId, ...teacherData });
            }

            renderTeachers();
            updateStats();
            closeModal();
        

        // Handle search
        function handleSearch(e) {
            const searchTerm = e.target.value.toLowerCase();
            
            if (searchTerm === '') {
                currentTeachers = [...teachersData];
            } else {
                currentTeachers = teachersData.filter(teacher => 
                    teacher.firstName.toLowerCase().includes(searchTerm) ||
                    teacher.lastName.toLowerCase().includes(searchTerm) ||
                    teacher.email.toLowerCase().includes(searchTerm) ||
                    teacher.employeeId.toLowerCase().includes(searchTerm) ||
                    teacher.department.toLowerCase().includes(searchTerm)
                );
            }
            
            renderTeachers();
        }

        // Update statistics
        function updateStats() {
            const total = currentTeachers.length;
            const active = currentTeachers.filter(t => t.status === 'active').length;
            const pending = currentTeachers.filter(t => t.status === 'pending').length;
            const departments = [...new Set(currentTeachers.map(t => t.department))].length;

            document.querySelector('.stat-card.total .stat-number').textContent = total;
            document.querySelector('.stat-card.active .stat-number').textContent = active;
            document.querySelector('.stat-card.pending .stat-number').textContent = pending;
            document.querySelector('.stat-card.departments .stat-number').textContent = departments;
        }

        // Initialize the application when DOM is loaded
        document.addEventListener('DOMContentLoaded', init);
    </script>
</body>
</html>