<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->role ?? 'Dashboard' }}</title>
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

        /* Dashboard Content */
        .dashboard-content {
            padding: 30px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--card-color);
        }

        .stat-card.students { --card-color: #3498db; }
        .stat-card.teachers { --card-color: #2ecc71; }
        .stat-card.staff { --card-color: #f39c12; }
        .stat-card.revenue { --card-color: #e74c3c; }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            background: var(--card-color);
        }

        .stat-trend {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 6px;
        }

        .stat-trend.up {
            background: #d4edda;
            color: #155724;
        }

        .stat-trend.down {
            background: #f8d7da;
            color: #721c24;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 14px;
            color: #718096;
            font-weight: 500;
        }

        /* Charts Section */
        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .chart-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
        }

        .chart-filters {
            display: flex;
            gap: 10px;
        }

        .filter-btn {
            padding: 6px 12px;
            border: 1px solid #e2e8f0;
            background: white;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn.active,
        .filter-btn:hover {
            background: #3498db;
            color: white;
            border-color: #3498db;
        }

        .chart-placeholder {
            height: 300px;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #718096;
            font-size: 14px;
        }

        /* Recent Activity */
        .activity-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .activity-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .activity-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 20px;
        }

        .activity-title {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #f7fafc;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3498db, #2980b9);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .activity-content {
            flex: 1;
        }

        .activity-name {
            font-weight: 600;
            font-size: 14px;
            color: #2d3748;
        }

        .activity-action {
            font-size: 13px;
            color: #718096;
        }

        .activity-time {
            font-size: 12px;
            color: #a0aec0;
        }

        /* Quick Actions */
        .quick-actions {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .quick-actions-title {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 20px;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            background: white;
            color: #4a5568;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .action-btn:hover {
            border-color: #3498db;
            background: #f0f9ff;
            color: #3498db;
            transform: translateY(-2px);
        }

        .action-btn i {
            font-size: 18px;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }

            .activity-grid {
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

            .dashboard-content {
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .search-bar {
                display: none;
            }

            .header-icons {
                gap: 10px;
            }

            .user-info {
                display: none;
            }

            .actions-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stat-card,
        .chart-card,
        .activity-card,
        .quick-actions {
            animation: fadeInUp 0.6s ease forwards;
        }

        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }
    </style>
</head>
<body>
    @if(!Auth::check())
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
    @php exit(); @endphp
@endif

@if(!in_array(Auth::user()->role ?? '', ['superadmin', 'admin']))
    <script>
        alert('Unauthorized access');
        window.location.href = "{{ route('login') }}";
    </script>
    @php exit(); @endphp
@endif
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-graduation-cap"></i>
                EduManage
            </div>
            <div class="tagline">{{ ucfirst($user->role) }} Panel</div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-section-title">Main</div>
                <div class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link active">
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
                    <a href="{{route('studentmanage')}}" class="nav-link">
                        <i class="fas fa-user-graduate"></i>
                        Students
                        <span class="badge">1,247</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{route('teachermanage')}}" class="nav-link">
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
                        <i class="fas fa-class"></i>
                        Schools
                    </a>
                </div>
                     <div class="nav-item">
                    <a href="{{route('class-management.index')}}" class="nav-link">
                        <i class="fas fa-school"></i>
                        Classes
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
    <a href="#" class="nav-link" id="logout-btn">
        <i class="fas fa-sign-out-alt"></i>
        Logout
    </a>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script>
document.getElementById('logout-btn').addEventListener('click', function(e) {
    e.preventDefault();
    if (confirm('Are you sure you want to logout?')) {
        document.getElementById('logout-form').submit();
    }
});
</script>
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
                    <h1 class="page-title">Dashboard</h1>
                    <div class="breadcrumb">Home / Dashboard</div>
                </div>
            </div>

            <div class="header-right">
                <div class="search-bar">
                    <input type="text" placeholder="Search users, courses, reports...">
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
                         <h4>{{ Auth::user()->name ?? 'Super Admin' }}</h4>
                        <p>{{ Auth::user()->email ?? 'admin@edumanage.com' }}</p>
                    </div>
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card students">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="stat-trend up">
                            <i class="fas fa-arrow-up"></i>
                            12.5%
                        </div>
                    </div>
                    <div class="stat-number">1,247</div>
                    <div class="stat-label">Total Students</div>
                </div>

                <div class="stat-card teachers">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="stat-trend up">
                            <i class="fas fa-arrow-up"></i>
                            8.2%
                        </div>
                    </div>
                    <div class="stat-number">89</div>
                    <div class="stat-label">Active Teachers</div>
                </div>

                <div class="stat-card staff">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="stat-trend up">
                            <i class="fas fa-arrow-up"></i>
                            3.1%
                        </div>
                    </div>
                    <div class="stat-number">45</div>
                    <div class="stat-label">Staff Members</div>
                </div>

                <div class="stat-card revenue">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-trend down">
                            <i class="fas fa-arrow-down"></i>
                            2.4%
                        </div>
                    </div>
                    <div class="stat-number">$24.5K</div>
                    <div class="stat-label">Monthly Revenue</div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="charts-grid">
                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">Student Enrollment Trends</h3>
                        <div class="chart-filters">
                            <button class="filter-btn active">7 Days</button>
                            <button class="filter-btn">30 Days</button>
                            <button class="filter-btn">3 Months</button>
                            <button class="filter-btn">Year</button>
                        </div>
                    </div>
                    <div class="chart-placeholder">
                        <i class="fas fa-chart-line" style="font-size: 48px; opacity: 0.3;"></i>
                    </div>
                </div>

                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">User Distribution</h3>
                    </div>
                    <div class="chart-placeholder">
                        <i class="fas fa-chart-pie" style="font-size: 48px; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="activity-grid">
                <div class="activity-card">
                    <div class="activity-header">
                        <h3 class="activity-title">Recent User Activity</h3>
                    </div>

                    <div class="activity-item">
                        <div class="activity-avatar">JD</div>
                        <div class="activity-content">
                            <div class="activity-name">John Doe</div>
                            <div class="activity-action">Registered as a new student</div>
                        </div>
                        <div class="activity-time">2 min ago</div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-avatar">MS</div>
                        <div class="activity-content">
                            <div class="activity-name">Mary Smith</div>
                            <div class="activity-action">Updated course schedule</div>
                        </div>
                        <div class="activity-time">15 min ago</div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-avatar">RJ</div>
                        <div class="activity-content">
                            <div class="activity-name">Robert Johnson</div>
                            <div class="activity-action">Created new examination</div>
                        </div>
                        <div class="activity-time">1 hour ago</div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-avatar">AL</div>
                        <div class="activity-content">
                            <div class="activity-name">Alice Lee</div>
                            <div class="activity-action">Submitted assignment grades</div>
                        </div>
                        <div class="activity-time">2 hours ago</div>
                    </div>
                </div>

                <div class="activity-card">
                    <div class="activity-header">
                        <h3 class="activity-title">System Alerts</h3>
                    </div>

                    <div class="activity-item">
                        <div class="activity-avatar" style="background: #f39c12;">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-name">Server Maintenance</div>
                            <div class="activity-action">Scheduled for tonight at 2:00 AM</div>
                        </div>
                        <div class="activity-time">1 day ago</div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-avatar" style="background: #e74c3c;">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-name">Security Update</div>
                            <div class="activity-action">New security patch available</div>
                        </div>
                        <div class="activity-time">2 days ago</div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-avatar" style="background: #2ecc71;">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-name">Backup Complete</div>
                            <div class="activity-action">Daily backup completed successfully</div>
                        </div>
                        <div class="activity-time">1 day ago</div>
                    </div>

                    <div class="activity-item">
                        <div class="activity-avatar" style="background: #3498db;">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-name">New Feature</div>
                            <div class="activity-action">Grade analytics module released</div>
                        </div>
                        <div class="activity-time">3 days ago</div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <h3 class="quick-actions-title">Quick Actions</h3>
                <div class="actions-grid">
                    <a href="#" class="action-btn">
                        <i class="fas fa-user-plus"></i>
                        Add New User
                    </a>
                    <a href="#" class="action-btn">
                        <i class="fas fa-school"></i>
                        Create School
                    </a>
                    <a href="#" class="action-btn">
                        <i class="fas fa-book"></i>
                        Add Course
                    </a>
                    <a href="#" class="action-btn">
                        <i class="fas fa-calendar-plus"></i>
                        Schedule Event
                    </a>
                    <a href="#" class="action-btn">
                        <i class="fas fa-file-alt"></i>
                        Generate Report
                    </a>
                    <a href="#" class="action-btn">
                        <i class="fas fa-cog"></i>
                        System Settings
                    </a>
                    <a href="#" class="action-btn">
                        <i class="fas fa-envelope"></i>
                        Send Notification
                    </a>
                    <a href="#" class="action-btn">
                        <i class="fas fa-database"></i>
                        Backup Data
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Mobile Overlay -->
    <div class="mobile-overlay" id="mobileOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 999;" onclick="toggleSidebar()"></div>

    <script>
        // Sidebar Toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const mobileOverlay = document.getElementById('mobileOverlay');
            
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('open');
                if (sidebar.classList.contains('open')) {
                    mobileOverlay.style.display = 'block';
                } else {
                    mobileOverlay.style.display = 'none';
                }
            } else {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            }
        }

        // Menu button click
        document.getElementById('menuBtn').addEventListener('click', toggleSidebar);

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const mobileOverlay = document.getElementById('mobileOverlay');
            
            if (window.innerWidth > 768) {
                sidebar.classList.remove('open');
                mobileOverlay.style.display = 'none';
            }
        });

        // Chart filter buttons
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active class from all filter buttons in the same group
                const parent = this.closest('.chart-filters');
                parent.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                
                // Add active class to clicked button
                this.classList.add('active');
                
                // Here you would typically update the chart data
                console.log('Filter changed to:', this.textContent);
            });
        });

        // Navigation link clicks
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all nav links
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                
                // Add active class to clicked link
                this.classList.add('active');
                
                // Update page title and breadcrumb
                const linkText = this.textContent.trim().split('\n')[0];
                document.querySelector('.page-title').textContent = linkText;
                document.querySelector('.breadcrumb').textContent = `Home / ${linkText}`;
                
                // Here you would typically load the corresponding page content
                console.log('Navigating to:', linkText);
            });
        });

        // Search functionality
        document.querySelector('.search-bar input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                const searchQuery = this.value.trim();
                if (searchQuery) {
                    console.log('Searching for:', searchQuery);
                    // Here you would implement actual search functionality
                }
            }
        });

        // Header icons click handlers
        document.querySelectorAll('.header-icon').forEach(icon => {
            icon.addEventListener('click', function() {
                const iconType = this.querySelector('i').classList.contains('fa-bell') ? 'notifications' : 'messages';
                console.log('Opening:', iconType);
                
                // Here you would show notifications or messages dropdown
                // For demo purposes, we'll just animate the icon
                this.style.transform = 'scale(0.9)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            });
        });

        // User profile dropdown
        document.querySelector('.user-profile').addEventListener('click', function() {
            console.log('Opening user profile menu');
            
            // Here you would show user profile dropdown menu
            // For demo purposes, we'll just animate the avatar
            const avatar = this.querySelector('.user-avatar');
            avatar.style.transform = 'scale(0.9)';
            setTimeout(() => {
                avatar.style.transform = 'scale(1)';
            }, 150);
        });

        // Quick action buttons
        document.querySelectorAll('.action-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const actionName = this.textContent.trim();
                console.log('Quick action:', actionName);
                
                // Here you would implement the actual quick action functionality
                // For demo purposes, we'll show a simple animation
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            });
        });

        // Simulate real-time updates
        function updateStats() {
            const statNumbers = document.querySelectorAll('.stat-number');
            statNumbers.forEach(stat => {
                const currentValue = parseInt(stat.textContent.replace(/[^\d]/g, ''));
                const change = Math.floor(Math.random() * 10) - 5; // Random change between -5 and +5
                const newValue = Math.max(0, currentValue + change);
                
                if (stat.textContent.includes('
                    )) {
                    stat.textContent = `${(newValue / 1000).toFixed(1)}K`;
                } else {
                    stat.textContent = newValue.toLocaleString();
                }
            });
        

        // Update stats every 30 seconds (for demo purposes)
        setInterval(updateStats, 30000);

        // Add loading states for actions
        function showLoading(element) {
            const originalContent = element.innerHTML;
            element.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
            element.style.pointerEvents = 'none';
            
            setTimeout(() => {
                element.innerHTML = originalContent;
                element.style.pointerEvents = 'auto';
            }, 2000);
        }

        // Add click handlers for demonstration
        document.addEventListener('DOMContentLoaded', function() {
            // Add some interactive demo functionality
            const demoElements = document.querySelectorAll('.stat-card, .action-btn');
            
            demoElements.forEach(element => {
                element.addEventListener('mouseenter', function() {
                    this.style.cursor = 'pointer';
                });
            });

            // Simulate notification updates
            function updateNotificationBadges() {
                const badges = document.querySelectorAll('.header-icon .badge');
                badges.forEach(badge => {
                    const currentCount = parseInt(badge.textContent);
                    const newCount = Math.max(0, currentCount + Math.floor(Math.random() * 3) - 1);
                    badge.textContent = newCount;
                    
                    if (newCount > currentCount) {
                        badge.style.animation = 'pulse 0.5s ease-in-out';
                        setTimeout(() => {
                            badge.style.animation = '';
                        }, 500);
                    }
                });
            }

            // Update notification badges every 60 seconds
            setInterval(updateNotificationBadges, 60000);

            console.log('EduManage Super Admin Dashboard loaded successfully!');
        });

        // Add CSS animation for pulse effect
        const style = document.createElement('style');
        style.textContent = `
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.2); }
                100% { transform: scale(1); }
            }
        `;
        document.head.appendChild(style);


     
function confirmLogout() {
    if (confirm('Are you sure you want to logout?')) {
        document.getElementById('logout-form').submit();
    }
}

    </script>
</body>
</html>