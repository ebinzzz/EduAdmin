<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Teacher - EduManage</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #2d3748;
            line-height: 1.6;
        }

        /* Sidebar Styles */
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

        /* Main content area */
        .main-content {
            margin-left: 280px;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
            background: #f8fafc;
        }

        .sidebar.collapsed + .main-content {
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

        .container {
            max-width: 1000px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: slideUp 0.6s ease;
            margin: 20px auto;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-header {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            padding: 30px;
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
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
        }

        .form-header p {
            font-size: 16px;
            opacity: 0.9;
            position: relative;
            z-index: 2;
        }

        .form-header .icon {
            font-size: 48px;
            margin-bottom: 15px;
            opacity: 0.8;
        }

        .form-body {
            padding: 40px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
            font-size: 14px;
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
            font-size: 12px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 25px;
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
            position: relative;
        }

        .form-label.required::after {
            content: '*';
            color: #e53e3e;
            margin-left: 4px;
        }

        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 15px 18px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: #3498db;
            background: white;
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
            transform: translateY(-2px);
        }

        .form-select {
            cursor: pointer;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="%23718096" stroke-width="2"><polyline points="6,9 12,15 18,9"/></svg>');
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 20px;
            appearance: none;
        }

        .form-textarea {
            resize: vertical;
            min-height: 120px;
            font-family: inherit;
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
            font-size: 16px;
        }

        .input-icon .form-input {
            padding-left: 50px;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #f1f5f9;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 140px;
            justify-content: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2980b9, #1f5f8b);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
        }

        .btn-secondary {
            background: #f8fafc;
            color: #4a5568;
            border: 2px solid #e2e8f0;
        }

        .btn-secondary:hover {
            background: #edf2f7;
            border-color: #cbd5e0;
            transform: translateY(-2px);
        }

        .form-section {
            margin-bottom: 35px;
            padding-bottom: 25px;
            border-bottom: 1px solid #f1f5f9;
        }

        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: #3498db;
        }

        .help-text {
            font-size: 13px;
            color: #718096;
            margin-top: 5px;
            font-style: italic;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
            align-items: center;
            gap: 10px;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
            align-items: center;
            gap: 10px;
        }

        /* Custom checkbox styling */
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 15px;
        }

        .custom-checkbox {
            position: relative;
            display: inline-block;
        }

        .custom-checkbox input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .custom-checkbox:hover input ~ .checkmark {
            border-color: #3498db;
        }

        .custom-checkbox input:checked ~ .checkmark {
            background-color: #3498db;
            border-color: #3498db;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .custom-checkbox input:checked ~ .checkmark:after {
            display: block;
        }

        .custom-checkbox .checkmark:after {
            left: 6px;
            top: 2px;
            width: 6px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        /* Loading state */
        .btn.loading {
            opacity: 0.7;
            cursor: not-allowed;
            pointer-events: none;
        }

        .spinner {
            display: inline-block;
            width: 18px;
            height: 18px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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

            .container {
                margin: 10px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .form-body {
                padding: 30px 20px;
            }

            .form-header {
                padding: 25px 20px;
            }

            .form-header h1 {
                font-size: 24px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

            .search-bar {
                display: none;
            }

            .user-info {
                display: none;
            }

            .mobile-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
                display: none;
            }

            .mobile-overlay.active {
                display: block;
            }
        }
    </style>
</head>
<body>
    <!-- Mobile overlay -->
    <div class="mobile-overlay" onclick="closeSidebar()"></div>

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
                    <a href="#" class="nav-link">
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
                    <h1 class="page-title">Add Teacher</h1>
                    <div class="breadcrumb">Home / User Management / Teachers / Add Teacher</div>
                </div>
            </div>

            <div class="header-right">
                <div class="search-bar">
                    <input type="text" placeholder="Search...">
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

        <div class="container">
            <div class="form-header">
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h1>Add New Teacher</h1>
                <p>Fill in the details below to add a new teacher to the system</p>
            </div>

            <div class="form-body">
                <div class="breadcrumb">
                    <a href="{{route('dashboard')}}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <i class="fas fa-chevron-right"></i>
                    <a href="{{route('teachermanage')}}">Teachers</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Add Teacher</span>
                </div>

         
                   @if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 10px 15px; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 15px;">
        {{ session('success') }}
    </div>
@endif
@if($errors->any())
    <div style="background-color: #f8d7da; color: #721c24; padding: 10px 15px; border: 1px solid #f5c6cb; border-radius: 5px; margin-bottom: 15px;">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                

                <div class="error-message" id="errorMessage">
                    <i class="fas fa-exclamation-circle"></i>
                    Please fill in all required fields correctly.
                </div>

                <form id="addTeacherForm" method="POST" action="{{route('store')}}">
                    @csrf
                    <!-- Personal Information Section -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-user"></i>
                            Personal Information
                        </h3>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label required" for="firstName">First Name</label>
                                <div class="input-icon">
                                    <i class="fas fa-user"></i>
                                    <input type="text" class="form-input" id="firstName" name="firstName" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label required" for="lastName">Last Name</label>
                                <div class="input-icon">
                                    <i class="fas fa-user"></i>
                                    <input type="text" class="form-input" id="lastName" name="lastName" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label required" for="email">Email Address</label>
                                <div class="input-icon">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" class="form-input" id="email" name="email" required>
                                </div>
                                <div class="help-text">This will be used for login credentials</div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label required" for="phone">Phone Number</label>
                                <div class="input-icon">
                                    <i class="fas fa-phone"></i>
                                    <input type="tel" class="form-input" id="phone" name="phone" required>
                                </div>
                            </div>
                            
                            
                            
                           
                        </div>

                        <div class="form-group full-width">
                            <label class="form-label required" for="address">Address</label>
                            <textarea class="form-textarea" id="address" name="address" rows="3" placeholder="Enter full address..." required></textarea>
                        </div>
                    </div>

                    <!-- Professional Information Section -->
                    <div class="form-section">
                        <h3 class="section-title">
                            <i class="fas fa-briefcase"></i>
                            Professional Information
                        </h3>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label required" for="employeeId">Employee ID</label>
                                <div class="input-icon">
                                    <i class="fas fa-id-badge"></i>
                                    <input type="text" class="form-input" id="employeeId" name="employeeId" required>
                                </div>
                                <div class="help-text">Unique identifier for the teacher</div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label required" for="department">Department</label>
                                <select class="form-select" id="department" name="department" required>
                                    <option value="">Select Department</option>
                                    <option value="Mathematics">Mathematics</option>
                                    <option value="Science">Science</option>
                                    <option value="English">English</option>
                                    <option value="History">History</option>
                                    <option value="Computer Science">Computer Science</option>
                                    <option value="Physical Education">Physical Education</option>
                                    <option value="Art">Art</option>
                                    <option value="Music">Music</option>
                                    <option value="Languages">Languages</option>
                                    <option value="Social Studies">Social Studies</option>
                                </select>
                            </div>
                            
                            <!--<div class="form-group">
                                <label class="form-label required" for="position">Position</label>
                                <select class="form-select" id="position" name="position" required>
                                    <option value="">Select Position</option>
                                    <option value="Teacher">Teacher</option>
                                    <option value="Senior Teacher">Senior Teacher</option>
                                    <option value="Head of Department">Head of Department</option>
                                    <option value="Assistant Principal">Assistant Principal</option>
                                    <option value="Principal">Principal</option>
                                </select>
                            </div>-->
                            
                            <div class="form-group">
                                <label class="form-label required" for="joiningDate">Joining Date</label>
                                <input type="date" class="form-input" id="joinDate" name="joinDate" required>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label required" for="salary">Salary</label>
                                <div class="input-icon">
                                    <i class="fas fa-dollar-sign"></i>
                                    <input type="number" class="form-input" id="salary" name="salary" placeholder="0.00" step="0.01" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="experience">Years of Experience</label>
                                <div class="input-icon">
                                    <i class="fas fa-calendar-check"></i>
                                    <input type="number" class="form-input" id="experience" name="experience" placeholder="0" min="0">
                                </div>
                            </div>
                        </div>

                        <div class="form-group full-width">
                            <label class="form-label" for="qualifications">Qualifications</label>
                            <textarea class="form-textarea" id="qualification" name="qualification" rows="3" placeholder="Enter educational qualifications and certifications..."></textarea>
                        </div>
                    </div>

                    <!-- Additional Information Section -->
                    

                        <div class="checkbox-group">
                            <label class="custom-checkbox">
                                <input type="checkbox" id="sendCredentials" name="sendCredentials" checked>
                                <span class="checkmark"></span>
                            </label>
                            <label for="sendCredentials" class="form-label">Send Login Credentials</label>
                            <div class="help-text">Send login credentials to the teacher's email address</div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary" onclick="resetForm()">
                            <i class="fas fa-undo"></i>
                            Reset Form
                        </button>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <i class="fas fa-user-plus"></i>
                            Add Teacher
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Sidebar functionality
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.mobile-overlay');
            
            sidebar.classList.toggle('collapsed');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        }

        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.mobile-overlay');
            
            sidebar.classList.add('collapsed');
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
        }

        // Menu button functionality
        document.getElementById('menuBtn').addEventListener('click', toggleSidebar);

        // Form functionality
        

        function resetForm() {
            document.getElementById('addTeacherForm').reset();
            document.getElementById('successMessage').style.display = 'none';
            document.getElementById('errorMessage').style.display = 'none';
            
            // Reset border colors
            const inputs = document.querySelectorAll('.form-input, .form-select, .form-textarea');
            inputs.forEach(input => {
                input.style.borderColor = '#e2e8f0';
            });
        }

        // Auto-generate employee ID
        document.getElementById('firstName').addEventListener('input', generateEmployeeId);
        document.getElementById('lastName').addEventListener('input', generateEmployeeId);

        function generateEmployeeId() {
            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;
            const employeeIdField = document.getElementById('employeeId');
            
            if (firstName && lastName && !employeeIdField.value) {
                const year = new Date().getFullYear();
                const initials = (firstName.charAt(0) + lastName.charAt(0)).toUpperCase();
                const randomNum = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
                employeeIdField.value = `TCH${year}${initials}${randomNum}`;
            }
        }

        // Phone number formatting
        document.getElementById('phone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 6) {
                value = value.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
            } else if (value.length >= 3) {
                value = value.replace(/(\d{3})(\d{0,3})/, '($1) $2');
            }
            e.target.value = value;
        });

        // Emergency phone formatting
      

        // Set maximum date for joining date (today)
        document.getElementById('joiningDate').setAttribute('max', new Date().toISOString().split('T')[0]);
        
    
    </script>
</body>
</html>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const successMessage = document.getElementById("successMessage");
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.transition = "opacity 0.5s ease";
                successMessage.style.opacity = 0;
                setTimeout(() => successMessage.remove(), 500); // remove from DOM
            }, 3000); // 3 seconds
        }
    });
</script>
