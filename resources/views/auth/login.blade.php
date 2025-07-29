<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EduManage</title>
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
            display: flex;
        }

        .login-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.1);
        }

        /* Left Side - Branding */
        .brand-side {
            flex: 1;
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px;
            position: relative;
            overflow: hidden;
        }

        .brand-side::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.05), transparent);
            transform: rotate(45deg);
            animation: shimmer 6s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }

        .brand-content {
            text-align: center;
            color: white;
            z-index: 2;
            position: relative;
        }

        .school-illustration {
            width: 200px;
            height: 200px;
            margin: 0 auto 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 4px solid rgba(255, 255, 255, 0.2);
            position: relative;
            backdrop-filter: blur(10px);
        }

        .school-building {
            position: relative;
            width: 100px;
            height: 76px;
            transform: scale(2);
        }

        .main-building {
            width: 42px;
            height: 28px;
            background: #ffffff;
            border-radius: 3px 3px 0 0;
            position: relative;
            margin: 0 auto;
            margin-top:25%;
        }

        .roof {
            width: 0;
            height: 0;
            border-left: 25px solid transparent;
            border-right: 25px solid transparent;
            border-bottom: 12px solid #e74c3c;
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
        }

        .door {
            width: 6px;
            height: 16px;
            background: #34495e;
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px 2px 0 0;
        }

        .window {
            width: 5px;
            height: 5px;
            background: #3498db;
            position: absolute;
            border-radius: 1px;
        }

        .window.left {
            top: 6px;
            left: 6px;
        }

        .window.right {
            top: 6px;
            right: 6px;
        }

        .flag-pole {
            width: 2px;
            height: 16px;
            background: #95a5a6;
            position: absolute;
            top: -28px;
            right: -10px;
            margin-top:35%;
        }

        .flag {
            width: 10px;
            height: 6px;
            background: #e74c3c;
            position: absolute;
            top: -26px;
            right: 10px;
            border-radius: 0 2px 2px 0;
        }

        .brand-content h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 15px;
            letter-spacing: 2px;
        }

        .brand-content .subtitle {
            font-size: 24px;
            opacity: 0.9;
            margin-bottom: 30px;
            font-weight: 300;
        }

        .brand-content .description {
            font-size: 16px;
            opacity: 0.8;
            line-height: 1.6;
            max-width: 400px;
        }

        .features {
            margin-top: 40px;
            text-align: left;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .feature-item i {
            margin-right: 15px;
            font-size: 20px;
            color: #3498db;
            background: rgba(255, 255, 255, 0.1);
            padding: 8px;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Right Side - Form */
        .form-side {
            flex: 1;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 80px;
            min-height: 100vh;
        }

        .form-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .form-header h2 {
            font-size: 36px;
            color: #2c3e50;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .form-header p {
            font-size: 18px;
            color: #7f8c8d;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            font-size: 14px;
            border: none;
            display: flex;
            align-items: center;
        }

        .alert-danger {
            color: #d32f2f;
            background: linear-gradient(135deg, #ffebee, #fce4ec);
            border-left: 4px solid #d32f2f;
        }

        .alert-danger::before {
            content: '⚠';
            margin-right: 10px;
            font-size: 18px;
        }

        .login-form {
            max-width: 450px;
            width: 100%;
            margin: 0 auto;
        }

        /* Role Selection Cards */
        .role-selection {
            margin-bottom: 40px;
        }

        .role-selection label {
            display: block;
            margin-bottom: 20px;
            font-weight: 600;
            color: #2c3e50;
            font-size: 18px;
            text-align: center;
        }

        .role-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .role-card {
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            user-select: none;
        }

        .role-card input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 1;
        }

        .role-card-content {
            background: #f8f9fa;
            border: 2px solid #e1e8ed;
            border-radius: 15px;
            padding: 25px 15px;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .role-card-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(52, 152, 219, 0.1), rgba(41, 128, 185, 0.1));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .role-card:hover .role-card-content {
            border-color: #3498db;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(52, 152, 219, 0.2);
        }

        .role-card:hover .role-card-content::before {
            opacity: 1;
        }

        .role-card input[type="radio"]:checked + .role-card-content,
        .role-card.selected .role-card-content {
            border-color: #3498db;
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(52, 152, 219, 0.4);
        }

        .role-card input[type="radio"]:checked + .role-card-content .role-icon,
        .role-card.selected .role-card-content .role-icon {
            color: white;
            background: rgba(255, 255, 255, 0.2);
            animation: bounce 0.6s ease;
        }

        @keyframes bounce {
            0%, 20%, 60%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            80% { transform: translateY(-5px); }
        }

        .role-icon {
            font-size: 32px;
            color: #3498db;
            margin-bottom: 12px;
            width: 60px;
            height: 60px;
            background: rgba(52, 152, 219, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            transition: all 0.3s ease;
        }

        .role-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
            position: relative;
            z-index: 1;
        }

        .role-description {
            font-size: 12px;
            opacity: 0.8;
            position: relative;
            z-index: 1;
        }

        .form-group {
            margin-bottom: 30px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 12px;
            font-weight: 600;
            color: #2c3e50;
            font-size: 16px;
        }

        .input-wrapper {
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 18px 25px 18px 60px;
            border: 2px solid #e1e8ed;
            border-radius: 15px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control:focus {
            outline: none;
            border-color: #3498db;
            background: white;
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
            transform: translateY(-2px);
        }

        .input-icon {
            position: absolute;
            left: 22px;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
            font-size: 20px;
            transition: color 0.3s ease;
        }

        .form-control:focus + .input-icon {
            color: #3498db;
        }

        .field-error {
            color: #d32f2f;
            font-size: 14px;
            margin-top: 8px;
            display: flex;
            align-items: center;
        }

        .field-error::before {
            content: '!';
            display: inline-block;
            width: 18px;
            height: 18px;
            background: #d32f2f;
            color: white;
            border-radius: 50%;
            font-size: 12px;
            line-height: 18px;
            text-align: center;
            margin-right: 8px;
        }

        .password-toggle {
            position: absolute;
            right: 22px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #7f8c8d;
            font-size: 18px;
            transition: color 0.3s ease;
            padding: 5px;
        }

        .password-toggle:hover {
            color: #3498db;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            font-size: 16px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            margin-right: 10px;
            transform: scale(1.2);
            cursor: pointer;
        }

        .forgot-password {
            color: #3498db;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #2980b9;
            text-decoration: underline;
        }

        .submit-btn {
            width: 100%;
            padding: 20px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #2980b9, #1f5f8b);
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(52, 152, 219, 0.4);
        }

        .submit-btn:active {
            transform: translateY(-1px);
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .divider {
            text-align: center;
            margin: 30px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e1e8ed;
        }

        .divider span {
            background: white;
            padding: 0 20px;
            color: #7f8c8d;
            font-size: 14px;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 15px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 24px;
        }

        .social-btn.google {
            background: linear-gradient(135deg, #db4437, #c23321);
        }

        .social-btn.facebook {
            background: linear-gradient(135deg, #3b5998, #2d4373);
        }

        .social-btn.microsoft {
            background: linear-gradient(135deg, #00a1f1, #0078d4);
        }

        .social-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .register-link {
            text-align: center;
            font-size: 16px;
            color: #7f8c8d;
        }

        .register-link a {
            color: #3498db;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: #2980b9;
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .brand-side {
                padding: 40px;
            }
            
            .form-side {
                padding: 40px 60px;
            }
            
            .brand-content h1 {
                font-size: 36px;
            }
            
            .brand-content .subtitle {
                font-size: 20px;
            }
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
            
            .brand-side {
                display: none;
            }
            
            .form-side {
                flex: 1;
                padding: 40px 30px;
                min-height: 100vh;
                justify-content: flex-start;
                padding-top: 80px;
            }
            
            .form-header {
                margin-bottom: 40px;
            }
            
            .form-header h2 {
                font-size: 28px;
            }
            
            .form-header::before {
                content: '';
                display: block;
                width: 60px;
                height: 60px;
                background: linear-gradient(135deg, #3498db, #2980b9);
                border-radius: 15px;
                margin: 0 auto 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Font Awesome 6 Free';
                font-weight: 900;
                content: '\f19d';
                color: white;
                font-size: 24px;
            }
            
            .role-cards {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            
            .role-card-content {
                padding: 20px 15px;
            }
            
            .role-icon {
                font-size: 28px;
                width: 50px;
                height: 50px;
            }
            
            .remember-forgot {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .social-login {
                margin-top: 20px;
                margin-bottom: 20px;
            }
        }

        /* Animation for form elements */
        .form-group, .role-selection {
            opacity: 0;
            transform: translateY(30px);
            animation: slideUp 0.8s ease forwards;
        }

        .role-selection { animation-delay: 0.1s; }
        .form-group:nth-child(3) { animation-delay: 0.2s; }
        .form-group:nth-child(4) { animation-delay: 0.3s; }
        .form-group:nth-child(5) { animation-delay: 0.4s; }
        .form-group:nth-child(6) { animation-delay: 0.5s; }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .loading {
            pointer-events: none;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 24px;
            height: 24px;
            border: 3px solid rgba(255,255,255,0.3);
            border-top: 3px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left Side - Branding -->
        <div class="brand-side">
            <div class="brand-content">
                <div class="school-illustration">
                    <div class="school-building">
                        <div class="main-building">
                            <div class="roof"></div>
                            <div class="window left"></div>
                            <div class="window right"></div>
                            <div class="door"></div>
                        </div>
                    </div>
                </div>
                <h1><i class="fas fa-graduation-cap"></i> EduManage</h1>
                <p class="subtitle">Student Management System</p>
                <p class="description">Streamline your educational institution with our comprehensive management platform designed for modern learning environments.</p>
                
                <div class="features">
                    <div class="feature-item">
                        <i class="fas fa-users"></i>
                        <span>Student & Staff Management</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-chart-line"></i>
                        <span>Performance Analytics</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-shield-alt"></i>
                        <span>Secure & Reliable</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="form-side">
            <div class="form-header">
                <h2>Welcome Back!</h2>
                <p>Please sign in to your account to continue</p>
            </div>

            <!-- Validation Errors -->
             @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin-left: 20px; margin: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif 

            <form method="POST" action="{{route('login')}}" class="login-form">
                 @csrf 

                <!-- Role Selection Cards -->
                <!--<div class="role-selection">
                    <label>Choose your login type</label>
                    <div class="role-cards">
                        <div class="role-card">
                            <input type="radio" id="superadmin" name="role" value="superadmin" {{ old('role') == 'superadmin' ? 'checked' : '' }} required>
                            <div class="role-card-content">
                                <div class="role-icon">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                                <div class="role-title">Super Administrator</div>
                                <div class="role-description">System Admin Access</div>
                            </div>
                        </div>
                        
                        <div class="role-card">
                            <input type="radio" id="teacher" name="role" value="teacher" {{ old('role') == 'teacher' ? 'checked' : '' }} required>
                            <div class="role-card-content">
                                <div class="role-icon">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <div class="role-title">Teacher</div>
                                <div class="role-description">Faculty Portal</div>
                            </div>
                        </div>
                        
                        <div class="role-card">
                            <input type="radio" id="student" name="role" value="student" {{ old('role') == 'student' ? 'selected' : '' }} required>
                            <div class="role-card-content">
                                <div class="role-icon">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                                <div class="role-title">Student</div>
                                <div class="role-description">Student Dashboard</div>
                            </div>
                        </div>
                    </div>
                    @error('role')
                        <div class="field-error">{{ $message }}</div>
                    @enderror 
                </div>-->

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email address" required value="{{ old('email') }}">
                        <i class="fas fa-envelope input-icon"></i>
                    </div>
                    @error('email')
                        <div class="field-error">{{ $message }}</div>
                    @enderror 
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                        <i class="fas fa-lock input-icon"></i>
                        <i class="fas fa-eye password-toggle" onclick="togglePassword()"></i>
                    </div>
                </div>

                <div class="remember-forgot">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </div>

                <div class="form-group">
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-sign-in-alt"></i> Sign In
                    </button>
                </div>

                <div class="divider">
                    <span>Or continue with</span>
                </div>

                <div class="social-login">
                    <a href="#" class="social-btn google" title="Sign in with Google">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#" class="social-btn facebook" title="Sign in with Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-btn microsoft" title="Sign in with Microsoft">
                        <i class="fab fa-microsoft"></i>
                    </a>
                </div>

                <div class="register-link">
                    Don't have an account? 
                    <a href="{{route('register')}}">
                        <i class="fas fa-user-plus"></i> Create one here
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const toggleIcon = document.querySelector(".password-toggle");
            const isPassword = passwordInput.type === "password";

            passwordInput.type = isPassword ? "text" : "password";
            toggleIcon.classList.toggle("fa-eye");
            toggleIcon.classList.toggle("fa-eye-slash");
        }

        // Add loading state to form submission
        document.querySelector('.login-form').addEventListener('submit', function(e) {
            const submitBtn = document.querySelector('.submit-btn');
            submitBtn.classList.add('loading');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing In...';
        });

       
      

        // Handle radio button changes

        // Set initial selected state if there's a checked radio
       
    </script>
</body>
</html>