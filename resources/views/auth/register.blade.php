<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration - EduManage</title>
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

        .registration-container {
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
            margin-top:30%;
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
            justify-content: flex-start;
            padding: 40px 60px;
            min-height: 100vh;
            overflow-y: auto;
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
            padding-top: 20px;
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

        .registration-form {
            max-width: 500px;
            width: 100%;
            margin: 0 auto;
        }

        .error-list {
            background: linear-gradient(135deg, #ffebee, #fce4ec);
            border-left: 4px solid #d32f2f;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            display: none;
        }

        .error-list ul {
            list-style: none;
            margin: 0;
        }

        .error-list li {
            color: #d32f2f;
            font-size: 14px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .error-list li::before {
            content: '⚠';
            margin-right: 10px;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 12px;
            font-weight: 600;
            color: #2c3e50;
            font-size: 16px;
        }

        .optional-text {
            font-size: 12px;
            color: #7f8c8d;
            font-style: italic;
            font-weight: 400;
        }

        .role-selector {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 10px;
        }

        .role-option {
            position: relative;
        }

        .role-option input[type="radio"] {
            display: none;
        }

        .role-option label {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 15px;
            border: 2px solid #e1e8ed;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f8f9fa;
            text-align: center;
        }

        .role-option label:hover {
            border-color: #3498db;
            background: #e3f2fd;
            transform: translateY(-2px);
        }

        .role-option input[type="radio"]:checked + label {
            border-color: #3498db;
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(52, 152, 219, 0.3);
        }

        .role-icon {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .role-text {
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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

        .password-strength {
            margin-top: 12px;
            font-size: 14px;
        }

        .strength-bar {
            width: 100%;
            height: 6px;
            background: #e1e8ed;
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 8px;
        }

        .strength-fill {
            height: 100%;
            background: #e74c3c;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 3px;
        }

        .strength-fill.weak { background: #e74c3c; width: 33%; }
        .strength-fill.medium { background: #f39c12; width: 66%; }
        .strength-fill.strong { background: #27ae60; width: 100%; }

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

        .login-link {
            text-align: center;
            font-size: 16px;
            color: #7f8c8d;
            padding-top: 20px;
            border-top: 1px solid #e1e8ed;
        }

        .login-link a {
            color: #3498db;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #2980b9;
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .brand-side {
                padding: 40px;
            }
            
            .form-side {
                padding: 40px 50px;
            }
            
            .brand-content h1 {
                font-size: 36px;
            }
            
            .brand-content .subtitle {
                font-size: 20px;
            }

            .role-selector {
                grid-template-columns: repeat(4, 1fr);
                gap: 10px;
            }

            .role-option label {
                padding: 15px 10px;
            }

            .role-icon {
                font-size: 24px;
                margin-bottom: 8px;
            }

            .role-text {
                font-size: 12px;
            }
        }

        @media (max-width: 768px) {
            .registration-container {
                flex-direction: column;
            }
            
            .brand-side {
                display: none; /* Hide left branding interface on mobile */
            }
            
            .form-side {
                flex: 1;
                padding: 40px 30px;
                min-height: 100vh;
                justify-content: flex-start;
                padding-top: 60px;
            }
            
            .form-header {
                margin-bottom: 30px;
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
                content: '\f19d'; /* graduation cap icon */
                color: white;
                font-size: 24px;
            }

            .role-selector {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .role-option label {
                padding: 15px 10px;
            }

            .role-icon {
                font-size: 22px;
            }

            .role-text {
                font-size: 12px;
            }
        }

        /* Animation for form elements */
        .form-group {
            opacity: 0;
            transform: translateY(30px);
            animation: slideUp 0.8s ease forwards;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }
        .form-group:nth-child(5) { animation-delay: 0.5s; }
        .form-group:nth-child(6) { animation-delay: 0.6s; }
        .form-group:nth-child(7) { animation-delay: 0.7s; }

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
    <div class="registration-container">
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
                <p class="subtitle">Registration Portal</p>
                <p class="description">Join our comprehensive educational management platform and unlock the full potential of modern learning.</p>
                
                <div class="features">
                    <div class="feature-item">
                        <i class="fas fa-user-plus"></i>
                        <span>Easy Registration Process</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-users-cog"></i>
                        <span>Multi-Role Support</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-lock"></i>
                        <span>Secure Account Creation</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="form-side">
            <div class="form-header">
                <h2>Create Account</h2>
                <p>Join our educational community today</p>
            </div>

            <!-- Error Display -->
            <div class="error-list" id="errorList">
                <ul id="errorMessages"></ul>
            </div>

            <form id="registrationForm" method="POST" action="{{route('register')}}" class="registration-form">
                <!-- Role Selection -->
               @csrf
                <!-- Name Field -->
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <div class="input-wrapper">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name" required>
                        <i class="fas fa-user input-icon"></i>
                    </div>
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email address" required>
                        <i class="fas fa-envelope input-icon"></i>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Create a strong password" required>
                        <i class="fas fa-lock input-icon"></i>
                    </div>
                    <div class="password-strength">
                        <div class="strength-bar">
                            <div class="strength-fill" id="strengthFill"></div>
                        </div>
                        <div id="strengthText">Password strength: <span>Weak</span></div>
                    </div>
                </div>

                <!-- Confirm Password Field -->
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
                        <i class="fas fa-lock input-icon"></i>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-user-plus"></i> Create Account
                    </button>
                </div>

                <!-- Login Link -->
                <div class="login-link">
                    Already have an account? 
                    <a href="{{route('login')}}">
                        <i class="fas fa-sign-in-alt"></i> Sign In Here
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Password strength checker
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthFill = document.getElementById('strengthFill');
            const strengthText = document.getElementById('strengthText');
            
            let strength = 0;
            let strengthLabel = 'Weak';
            
            // Check password strength
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            // Update UI based on strength
            strengthFill.className = 'strength-fill';
            if (strength >= 2 && strength < 4) {
                strengthFill.classList.add('medium');
                strengthLabel = 'Medium';
            } else if (strength >= 4) {
                strengthFill.classList.add('strong');
                strengthLabel = 'Strong';
            } else {
                strengthFill.classList.add('weak');
                strengthLabel = 'Weak';
            }
            
            strengthText.innerHTML = `Password strength: <span>${strengthLabel}</span>`;
        });

        // Form submission with loading state
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            const submitBtn = document.querySelector('.submit-btn');
            submitBtn.classList.add('loading');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Account...';
        });

        // Basic client-side validation
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const errorList = document.getElementById('errorList');
            const errorMessages = document.getElementById('errorMessages');
            
            errorMessages.innerHTML = '';
            errorList.style.display = 'none';
            
            const errors = [];
            
            if (password !== confirmPassword) {
                errors.push('Passwords do not match');
            }
            
            if (password.length < 8) {
                errors.push('Password must be at least 8 characters long');
            }
            
            if (errors.length > 0) {
                e.preventDefault();
                errors.forEach(error => {
                    const li = document.createElement('li');
                    li.textContent = error;
                    errorMessages.appendChild(li);
                });
                errorList.style.display = 'block';
                
                // Reset submit button
                const submitBtn = document.querySelector('.submit-btn');
                submitBtn.classList.remove('loading');
                submitBtn.innerHTML = '<i class="fas fa-user-plus"></i> Create Account';
            }
        });
    </script>
</body>
</html>