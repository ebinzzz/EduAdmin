<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EduManage - Teacher Portal')</title>
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
            background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
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
            color: #68d391;
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
            background: rgba(104, 211, 145, 0.1);
            color: #68d391;
            transform: translateX(5px);
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: #68d391;
        }

        .nav-link i {
            width: 20px;
            margin-right: 15px;
            font-size: 16px;
        }

        .nav-link .badge {
            margin-left: auto;
            background: rgba(104, 211, 145, 0.3);
            color: #68d391;
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
            background: linear-gradient(135deg, #68d391, #48bb78);
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

        /* Content Area */
        .content-area {
            padding: 20px;
        }

        /* Responsive Design */
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

        /* Page specific styles */
        @yield('styles')
    </style>
    @stack('styles')
</head>
<body>
    <!-- Mobile overlay -->
    <div class="mobile-overlay" onclick="closeSidebar()"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-chalkboard-teacher"></i>
                EduManage
            </div>
            <div class="tagline">Teacher Portal</div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-section-title">Main</div>
                <div class="nav-item">
                    <a href="{{ route('teacher.dashboard') }}" class="nav-link {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('teacher.profile') }}" class="nav-link {{ request()->routeIs('teacher.profile') ? 'active' : '' }}">
                        <i class="fas fa-user"></i>
                        My Profile
                    </a>
                </div>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">Classes & Students</div>
                <div class="nav-item">
                    <a href="{{ route('teacher.classes') }}" class="nav-link {{ request()->routeIs('teacher.classes*') ? 'active' : '' }}">
                        <i class="fas fa-school"></i>
                        My Classes
                        <span class="badge">5</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('teacher.students') }}" class="nav-link {{ request()->routeIs('teacher.students*') ? 'active' : '' }}">
                        <i class="fas fa-user-graduate"></i>
                        Students
                        <span class="badge">127</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('teacher.attendance') }}" class="nav-link {{ request()->routeIs('teacher.attendance*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-check"></i>
                        Attendance
                    </a>
                </div>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">Academic</div>
                <div class="nav-item">
                    <a href="{{ route('teacher.timetable') }}" class="nav-link {{ request()->routeIs('teacher.timetable*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-alt"></i>
                        Timetable
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('teacher.assignments') }}" class="nav-link {{ request()->routeIs('teacher.assignments*') ? 'active' : '' }}">
                        <i class="fas fa-tasks"></i>
                        Assignments
                        <span class="badge">8</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('teacher.exams') }}" class="nav-link {{ request()->routeIs('teacher.exams*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i>
                        Exams & Tests
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('teacher.grades') }}" class="nav-link {{ request()->routeIs('teacher.grades*') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar"></i>
                        Grades & Results
                    </a>
                </div>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">Communication</div>
                <div class="nav-item">
                    <a href="{{ route('teacher.messages') }}" class="nav-link {{ request()->routeIs('teacher.messages*') ? 'active' : '' }}">
                        <i class="fas fa-envelope"></i>
                        Messages
                        <span class="badge">3</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('teacher.announcements') }}" class="nav-link {{ request()->routeIs('teacher.announcements*') ? 'active' : '' }}">
                        <i class="fas fa-bullhorn"></i>
                        Announcements
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('teacher.parents') }}" class="nav-link {{ request()->routeIs('teacher.parents*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        Parent Communication
                    </a>
                </div>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">Resources</div>
                <div class="nav-item">
                    <a href="{{ route('teacher.resources') }}" class="nav-link {{ request()->routeIs('teacher.resources*') ? 'active' : '' }}">
                        <i class="fas fa-book"></i>
                        Teaching Resources
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('teacher.reports') }}" class="nav-link {{ request()->routeIs('teacher.reports*') ? 'active' : '' }}">
                        <i class="fas fa-file-alt"></i>
                        Reports
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('teacher.help') }}" class="nav-link {{ request()->routeIs('teacher.help*') ? 'active' : '' }}">
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
                    <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
                    <div class="breadcrumb">@yield('breadcrumb', 'Home')</div>
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
                        <span class="badge">5</span>
                    </div>
                    <div class="header-icon">
                        <i class="fas fa-envelope"></i>
                        <span class="badge">3</span>
                    </div>
                </div>

                <div class="user-profile">
                    <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'TC', 0, 2)) }}</div>
                    <div class="user-info">
                        <h4>{{ Auth::user()->name ?? 'Teacher Name' }}</h4>
                        <p>{{ Auth::user()->email ?? 'teacher@edumanage.com' }}</p>
                    </div>
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="content-area">
            @yield('content')
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

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const menuBtn = document.getElementById('menuBtn');
            
            if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !menuBtn.contains(e.target)) {
                closeSidebar();
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth > 768) {
                sidebar.classList.remove('open');
                document.querySelector('.mobile-overlay').classList.remove('active');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>