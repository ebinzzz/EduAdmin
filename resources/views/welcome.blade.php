<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edu-Admin - Complete School Management System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
        }

        /* Header & Navigation */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 15px 0;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .header.scrolled {
            padding: 10px 0;
            background: rgba(255, 255, 255, 0.98);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            text-decoration: none;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 10px;
            font-size: 18px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 30px;
        }

        .nav-menu a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-menu a:hover {
            color: #3498db;
        }

        .nav-menu a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #3498db;
            transition: width 0.3s ease;
        }

        .nav-menu a:hover::after {
            width: 100%;
        }

        .auth-buttons {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }

        .btn-secondary {
            background: transparent;
            color: #3498db;
            border: 2px solid #3498db;
        }

        .btn-secondary:hover {
            background: #3498db;
            color: white;
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: #333;
            cursor: pointer;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .hero-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            animation: slideInLeft 1s ease;
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.9;
            animation: slideInLeft 1s ease 0.2s both;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            animation: slideInLeft 1s ease 0.4s both;
        }

        .btn-large {
            padding: 15px 30px;
            font-size: 1.1rem;
        }

        .hero-visual {
            position: relative;
            animation: slideInRight 1s ease;
        }

        .dashboard-preview {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
        }

        .preview-header {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
        }

        .preview-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .preview-dot.red { background: #ff5f56; }
        .preview-dot.yellow { background: #ffbd2e; }
        .preview-dot.green { background: #27ca3f; }

        .preview-content {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            color: #333;
        }

        .preview-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }

        .stat-number {
            font-size: 24px;
            font-weight: bold;
            display: block;
        }

        .stat-label {
            font-size: 12px;
            opacity: 0.8;
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* Features Section */
        .features {
            padding: 100px 0;
            background: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-header h2 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .section-header p {
            font-size: 1.1rem;
            color: #7f8c8d;
            max-width: 600px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(52, 152, 219, 0.1), transparent);
            transition: left 0.5s;
        }

        .feature-card:hover::before {
            left: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 32px;
            color: white;
            position: relative;
            z-index: 1;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .feature-card p {
            color: #7f8c8d;
            line-height: 1.6;
        }

        /* Statistics Section */
        .stats {
            padding: 80px 0;
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            text-align: center;
        }

        .stat-item {
            position: relative;
        }

        .stat-item::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: #e74c3c;
            border-radius: 2px;
        }

        .stat-item h3 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 10px;
            counter-reset: stat-counter;
        }

        .stat-item p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Testimonials */
        .testimonials {
            padding: 100px 0;
            background: white;
        }

        .testimonials-slider {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
        }

        .testimonial {
            text-align: center;
            padding: 40px;
            display: none;
        }

        .testimonial.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .testimonial-text {
            font-size: 1.3rem;
            font-style: italic;
            color: #2c3e50;
            margin-bottom: 30px;
            line-height: 1.8;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .author-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3498db, #2980b9);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }

        .author-info h4 {
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .author-info p {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .testimonial-nav {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 30px;
        }

        .nav-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #bdc3c7;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .nav-dot.active {
            background: #3498db;
        }

        /* Footer */
        .footer {
            background: #2c3e50;
            color: white;
            padding: 60px 0 20px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-section h3 {
            margin-bottom: 20px;
            color: #3498db;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .footer-section ul li a {
            color: #bdc3c7;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-section ul li a:hover {
            color: #3498db;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: #34495e;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: #3498db;
            transform: translateY(-3px);
        }

        .footer-bottom {
            border-top: 1px solid #34495e;
            padding-top: 20px;
            text-align: center;
            color: #bdc3c7;
        }

        /* Scroll to Top Button */
        .scroll-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            border: none;
            border-radius: 50%;
            color: white;
            font-size: 18px;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .scroll-top.visible {
            opacity: 1;
            visibility: visible;
        }

        .scroll-top:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(52, 152, 219, 0.4);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-menu, .auth-buttons {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .hero-container {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 30px;
            }

            .hero-content h1 {
                font-size: 2.5rem;
            }

            .hero-buttons {
                justify-content: center;
                flex-wrap: wrap;
            }

            .section-header h2 {
                font-size: 2rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-content {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .hero-content h1 {
                font-size: 2rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .stat-item h3 {
                font-size: 2.5rem;
            }
        }

        /* Loading Animation */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #2c3e50;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(52, 152, 219, 0.3);
            border-top: 3px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <!-- Header -->
    <header class="header" id="header">
        <div class="nav-container">
            <a href="#" class="logo">
                <div class="logo-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                Edu-Admin
            </a>
            
            <nav class="nav-menu">
                <a href="#home">Home</a>
                <a href="#features">Features</a>
                <a href="#about">About</a>
                <a href="#testimonials">Reviews</a>
                <a href="#contact">Contact</a>
            </nav>
            
            <div class="auth-buttons">
                <a href="/login" class="btn btn-secondary">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
                <a href="/register" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Get Started
                </a>
            </div>
            
            <button class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-container">
            <div class="hero-content">
                <h1>Transform Your School with Edu-Admin</h1>
                <p>The complete school management system that streamlines administration, enhances learning, and connects your entire educational community.</p>
                <div class="hero-buttons">
                    <a href="/register" class="btn btn-primary btn-large">
                        <i class="fas fa-rocket"></i> Start Free Trial
                    </a>
                    <a href="#features" class="btn btn-secondary btn-large">
                        <i class="fas fa-play"></i> Watch Demo
                    </a>
                </div>
            </div>
            <div class="hero-visual">
                <div class="dashboard-preview">
                    <div class="preview-header">
                        <div class="preview-dot red"></div>
                        <div class="preview-dot yellow"></div>
                        <div class="preview-dot green"></div>
                    </div>
                    <div class="preview-content">
                        <h4 style="margin-bottom: 15px; color: #2c3e50;">School Dashboard</h4>
                        <div class="preview-stats">
                            <div class="stat-card">
                                <span class="stat-number">1,247</span>
                                <span class="stat-label">Students</span>
                            </div>
                            <div class="stat-card">
                                <span class="stat-number">89</span>
                                <span class="stat-label">Teachers</span>
                            </div>
                            <div class="stat-card">
                                <span class="stat-number">42</span>
                                <span class="stat-label">Classes</span>
                            </div>
                            <div class="stat-card">
                                <span class="stat-number">98%</span>
                                <span class="stat-label">Attendance</span>
                            </div>
                        </div>
                        <div style="height: 4px; background: #ecf0f1; border-radius: 2px; overflow: hidden;">
                            <div style="height: 100%; width: 75%; background: linear-gradient(90deg, #3498db, #2980b9); animation: progress 2s ease-in-out infinite alternate;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="container">
            <div class="section-header">
                <h2>Comprehensive School Management</h2>
                <p>Everything you need to run a modern educational institution efficiently and effectively</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3>Student Management</h3>
                    <p>Complete student lifecycle management from admission to graduation with detailed profiles, academic records, and progress tracking.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3>Teacher Portal</h3>
                    <p>Empower educators with tools for lesson planning, grade management, attendance tracking, and student communication.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3>Schedule Management</h3>
                    <p>Intelligent timetable creation, class scheduling, exam planning, and event management with conflict detection.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Grade & Assessment</h3>
                    <p>Comprehensive grading system with customizable rubrics, report cards, and detailed academic analytics.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Parent Communication</h3>
                    <p>Keep parents engaged with real-time updates, progress reports, and direct communication channels.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h3>Fee Management</h3>
                    <p>Streamlined fee collection, payment tracking, financial reporting, and automated billing systems.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <h3>Attendance Tracking</h3>
                    <p>Digital attendance management with biometric integration, automated reports, and absence notifications.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3>Library Management</h3>
                    <p>Complete library system with book cataloging, issue tracking, digital resources, and inventory management.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Mobile App</h3>
                    <p>Native mobile applications for students, teachers, and parents with offline capabilities and push notifications.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <h3 data-count="500">0</h3>
                    <p>Schools Using Edu-Admin</p>
                </div>
                <div class="stat-item">
                    <h3 data-count="150000">0</h3>
                    <p>Active Students</p>
                </div>
                <div class="stat-item">
                    <h3 data-count="12000">0</h3>
                    <p>Teachers & Staff</p>
                </div>
                <div class="stat-item">
                    <h3 data-count="99">0</h3>
                    <p>Uptime Guarantee</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials" id="testimonials">
        <div class="container">
            <div class="section-header">
                <h2>What Our Schools Say</h2>
                <p>Trusted by educational institutions worldwide</p>
            </div>
            <div class="testimonials-slider">
                <div class="testimonial active">
                    <p class="testimonial-text">"Edu-Admin has revolutionized how we manage our school. The integrated approach saves us hours of administrative work daily, and parents love the real-time updates."</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="author-info">
                            <h4>Dr. Sarah Johnson</h4>
                            <p>Principal, Greenwood High School</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial">
                    <p class="testimonial-text">"The grade management and reporting features are outstanding. Our teachers can focus more on teaching rather than paperwork, and the analytics help us make better decisions."</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="author-info">
                            <h4>Michael Chen</h4>
                            <p>IT Director, Valley Academy</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial">
                    <p class="testimonial-text">"As a parent, I love being able to track my child's progress in real-time. The mobile app makes communication with teachers so much easier."</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="author-info">
                            <h4>Emily Rodriguez</h4>
                            <p>Parent, Riverside Elementary</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-nav">
                    <span class="nav-dot active" onclick="showTestimonial(0)"></span>
                    <span class="nav-dot" onclick="showTestimonial(1)"></span>
                    <span class="nav-dot" onclick="showTestimonial(2)"></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Edu-Admin</h3>
                    <p>Transforming education through innovative school management solutions. Empowering schools to focus on what matters most - student success.</p>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#testimonials">Testimonials</a></li>
                        <li><a href="/pricing">Pricing</a></li>
                        <li><a href="/demo">Request Demo</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Solutions</h3>
                    <ul>
                        <li><a href="/student-management">Student Management</a></li>
                        <li><a href="/teacher-portal">Teacher Portal</a></li>
                        <li><a href="/parent-app">Parent App</a></li>
                        <li><a href="/administration">Administration</a></li>
                        <li><a href="/finance">Finance & Fees</a></li>
                        <li><a href="/analytics">Analytics & Reports</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Support</h3>
                    <ul>
                        <li><a href="/help">Help Center</a></li>
                        <li><a href="/documentation">Documentation</a></li>
                        <li><a href="/training">Training</a></li>
                        <li><a href="/support">24/7 Support</a></li>
                        <li><a href="/community">Community</a></li>
                        <li><a href="/status">System Status</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact Info</h3>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i> 123 Education Street, Tech City, TC 12345</li>
                        <li><i class="fas fa-phone"></i> +1 (555) 123-4567</li>
                        <li><i class="fas fa-envelope"></i> info@edu-admin.com</li>
                        <li><i class="fas fa-clock"></i> Mon-Fri: 9AM-6PM EST</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Edu-Admin. All rights reserved. | Privacy Policy | Terms of Service | Cookie Policy</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button class="scroll-top" id="scrollTop">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // Loading overlay
        window.addEventListener('load', function() {
            const loadingOverlay = document.getElementById('loadingOverlay');
            setTimeout(() => {
                loadingOverlay.style.opacity = '0';
                setTimeout(() => {
                    loadingOverlay.style.display = 'none';
                }, 500);
            }, 1000);
        });

        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            const scrollTop = document.getElementById('scrollTop');
            
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
                scrollTop.classList.add('visible');
            } else {
                header.classList.remove('scrolled');
                scrollTop.classList.remove('visible');
            }
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Scroll to top functionality
        document.getElementById('scrollTop').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Animated counters for statistics
        function animateCounter(element, target, duration = 2000) {
            let start = 0;
            const increment = target / (duration / 16);
            
            function updateCounter() {
                start += increment;
                if (start < target) {
                    element.textContent = Math.floor(start).toLocaleString();
                    requestAnimationFrame(updateCounter);
                } else {
                    element.textContent = target.toLocaleString();
                }
            }
            updateCounter();
        }

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    
                    // Animate counters when stats section is visible
                    if (entry.target.classList.contains('stats')) {
                        const counters = entry.target.querySelectorAll('[data-count]');
                        counters.forEach(counter => {
                            const target = parseInt(counter.getAttribute('data-count'));
                            animateCounter(counter, target);
                        });
                    }
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.querySelectorAll('.feature-card, .stats, .testimonials').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });

        // Testimonials slider
        let currentTestimonial = 0;
        const testimonials = document.querySelectorAll('.testimonial');
        const navDots = document.querySelectorAll('.nav-dot');

        function showTestimonial(index) {
            testimonials[currentTestimonial].classList.remove('active');
            navDots[currentTestimonial].classList.remove('active');
            
            currentTestimonial = index;
            
            testimonials[currentTestimonial].classList.add('active');
            navDots[currentTestimonial].classList.add('active');
        }

        // Auto-rotate testimonials
        setInterval(() => {
            const nextIndex = (currentTestimonial + 1) % testimonials.length;
            showTestimonial(nextIndex);
        }, 5000);

        // Mobile menu functionality
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const navMenu = document.querySelector('.nav-menu');
        const authButtons = document.querySelector('.auth-buttons');

        mobileMenuBtn?.addEventListener('click', function() {
            navMenu.style.display = navMenu.style.display === 'flex' ? 'none' : 'flex';
            authButtons.style.display = authButtons.style.display === 'flex' ? 'none' : 'flex';
        });

        // Feature cards hover effect
        document.querySelectorAll('.feature-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Progress bar animation in hero preview
        const progressBar = document.querySelector('[style*="progress"]');
        if (progressBar) {
            setInterval(() => {
                const currentWidth = parseInt(progressBar.style.width) || 75;
                const newWidth = currentWidth >= 95 ? 75 : currentWidth + 5;
                progressBar.style.width = newWidth + '%';
            }, 2000);
        }

        // Add floating animation to dashboard preview
        const dashboardPreview = document.querySelector('.dashboard-preview');
        if (dashboardPreview) {
            setInterval(() => {
                dashboardPreview.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    dashboardPreview.style.transform = 'translateY(0)';
                }, 2000);
            }, 4000);
        }

        // Dynamic background for hero section
        const hero = document.querySelector('.hero');
        if (hero) {
            let mouseX = 0, mouseY = 0;
            
            hero.addEventListener('mousemove', function(e) {
                mouseX = e.clientX / window.innerWidth;
                mouseY = e.clientY / window.innerHeight;
                
                const xRotation = (mouseY - 0.5) * 10;
                const yRotation = (mouseX - 0.5) * -10;
                
                hero.style.transform = `perspective(1000px) rotateX(${xRotation}deg) rotateY(${yRotation}deg)`;
            });
            
            hero.addEventListener('mouseleave', function() {
                hero.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg)';
            });
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                // Close mobile menu if open
                navMenu.style.display = 'none';
                authButtons.style.display = 'none';
            }
            
            if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
                // Navigate testimonials with arrow keys
                const direction = e.key === 'ArrowLeft' ? -1 : 1;
                const nextIndex = (currentTestimonial + direction + testimonials.length) % testimonials.length;
                showTestimonial(nextIndex);
            }
        });

        // Form validation for newsletter signup (if added)
        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        // Add search functionality (if search is added)
        function searchFeatures(query) {
            const features = document.querySelectorAll('.feature-card');
            features.forEach(feature => {
                const text = feature.textContent.toLowerCase();
                if (text.includes(query.toLowerCase())) {
                    feature.style.display = 'block';
                } else {
                    feature.style.display = 'none';
                }
            });
        }

        // Performance monitoring
        function logPerformance() {
            if ('performance' in window) {
                const loadTime = performance.timing.loadEventEnd - performance.timing.navigationStart;
                console.log(`Page load time: ${loadTime}ms`);
            }
        }

        // Initialize performance logging
        window.addEventListener('load', logPerformance);

        // Add loading states for buttons
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (this.href && this.href.includes('/register')) {
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
                    this.style.pointerEvents = 'none';
                }
            });
        });

        // Add tooltip functionality
        function createTooltip(element, text) {
            const tooltip = document.createElement('div');
            tooltip.className = 'tooltip';
            tooltip.textContent = text;
            tooltip.style.cssText = `
                position: absolute;
                background: #2c3e50;
                color: white;
                padding: 8px 12px;
                border-radius: 4px;
                font-size: 14px;
                white-space: nowrap;
                z-index: 1000;
                opacity: 0;
                transition: opacity 0.3s ease;
                pointer-events: none;
            `;
            
            element.addEventListener('mouseenter', function(e) {
                document.body.appendChild(tooltip);
                const rect = element.getBoundingClientRect();
                tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
                tooltip.style.top = rect.top - tooltip.offsetHeight - 10 + 'px';
                tooltip.style.opacity = '1';
            });
            
            element.addEventListener('mouseleave', function() {
                if (tooltip.parentNode) {
                    tooltip.parentNode.removeChild(tooltip);
                }
            });
        }

        // Add tooltips to social links
        document.querySelectorAll('.social-link').forEach(link => {
            const platform = link.querySelector('i').className.split('-')[1];
            createTooltip(link, `Follow us on ${platform.charAt(0).toUpperCase() + platform.slice(1)}`);
        });

        // Initialize all components
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Edu-Admin homepage loaded successfully!');
            
            // Add subtle parallax effect
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const heroContent = document.querySelector('.hero-content');
                if (heroContent) {
                    heroContent.style.transform = `translateY(${scrolled * 0.1}px)`;
                }
            });
        });
    </script>

    <style>
        @keyframes progress {
            0% { width: 75%; }
            50% { width: 95%; }
            100% { width: 75%; }
        }

        /* Additional responsive improvements */
        @media (max-width: 1024px) {
            .hero-container {
                padding: 0 40px;
            }
            
            .dashboard-preview {
                padding: 20px;
            }
            
            .preview-stats {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }
        }

        @media (max-width: 768px) {
            .nav-menu {
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background: white;
                flex-direction: column;
                padding: 20px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
                display: none;
            }
            
            .auth-buttons {
                position: absolute;
                top: 180px;
                left: 0;
                width: 100%;
                background: white;
                flex-direction: column;
                padding: 20px;
                display: none;
            }
            
            .hero-content h1 {
                font-size: 2.2rem;
                line-height: 1.2;
            }
            
            .testimonial-text {
                font-size: 1.1rem;
            }
            
            .footer-section ul li {
                font-size: 14px;
            }
        }

        /* Dark mode support (optional) */
        @media (prefers-color-scheme: dark) {
            .dashboard-preview {
                background: rgba(0, 0, 0, 0.2);
            }
            
            .preview-content {
                background: rgba(255, 255, 255, 0.95);
            }
        }

        /* High contrast mode support */
        @media (prefers-contrast: high) {
            .btn {
                border: 2px solid currentColor;
            }
            
            .feature-card {
                border: 1px solid #333;
            }
        }

        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</body>
</html>