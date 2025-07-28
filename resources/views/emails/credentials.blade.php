<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Credentials</title>
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
            background-color: #f8f9fa;
        }
        
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .header p {
            font-size: 16px;
            opacity: 0.9;
        }
        
        .content {
            padding: 40px 30px;
        }
        
        .welcome-section {
            text-align: center;
            margin-bottom: 35px;
        }
        
        .welcome-section h2 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 15px;
        }
        
        .welcome-section p {
            color: #666;
            font-size: 16px;
        }
        
        .credentials-box {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 30px;
            margin: 30px 0;
            text-align: center;
        }
        
        .credentials-title {
            color: #495057;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        
        .credential-item {
            margin: 15px 0;
            padding: 15px;
            background: white;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }
        
        .credential-label {
            font-weight: 600;
            color: #495057;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        
        .credential-value {
            font-size: 16px;
            color: #2c3e50;
            font-family: 'Courier New', monospace;
            font-weight: 600;
            word-break: break-all;
        }
        
        .login-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }
        
        .security-notice {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }
        
        .security-notice h3 {
            color: #856404;
            font-size: 16px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        
        .security-notice h3:before {
            content: "🔒";
            margin-right: 8px;
            font-size: 18px;
        }
        
        .security-notice p {
            color: #856404;
            font-size: 14px;
            margin: 5px 0;
        }
        
        .footer {
            background: #2c3e50;
            color: #ecf0f1;
            padding: 25px 30px;
            text-align: center;
        }
        
        .footer p {
            margin: 5px 0;
            font-size: 14px;
        }
        
        .footer a {
            color: #3498db;
            text-decoration: none;
        }
        
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #ddd, transparent);
            margin: 25px 0;
        }
        
        @media (max-width: 600px) {
            .email-container {
                margin: 10px;
            }
            
            .header, .content {
                padding: 20px;
            }
            
            .credentials-box {
                padding: 20px;
            }
            
            .credential-value {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>🎓 School Management System</h1>
            <p>Your gateway to educational excellence</p>
        </div>
        
        <!-- Content -->
        <div class="content">
            <!-- Welcome Section -->
            <div class="welcome-section">
                <h2>Welcome, {{ $user->first_name }} {{ $user->last_name }}! 👋</h2>
                <p>
                    @if($userType === 'teacher')
                        We're excited to have you join our teaching team. Your account has been created successfully.
                    @else
                        Welcome to our school! Your student account has been created and you're ready to begin your learning journey.
                    @endif
                </p>
            </div>
            
            <!-- Credentials Box -->
            <div class="credentials-box">
                <div class="credentials-title">📧 Your Login Credentials</div>
                
                <div class="credential-item">
                    <div class="credential-label">Email Address</div>
                    <div class="credential-value">{{ $user->email }}</div>
                </div>
                
                <div class="credential-item">
                    <div class="credential-label">Password</div>
                    <div class="credential-value">{{ $password }}</div>
                </div>
                
                @if($userType === 'teacher')
                    <div class="credential-item">
                        <div class="credential-label">Employee ID</div>
                        <div class="credential-value">{{ $user->employee_id }}</div>
                    </div>
                @endif
            </div>
            
            <!-- Login Button -->
            <div style="text-align: center;">
                <a href="{{ $loginUrl }}" class="login-button">
                    🚀 Login to Your Account
                </a>
            </div>
            
            <!-- Security Notice -->
            <div class="security-notice">
                <h3>Security Notice</h3>
                <p>• Please change your password after your first login</p>
                <p>• Keep your login credentials secure and confidential</p>
                <p>• Never share your password with anyone</p>
                <p>• Contact IT support if you suspect any unauthorized access</p>
            </div>
            
            <div class="divider"></div>
            
            <!-- Additional Info -->
            <div style="text-align: center; color: #666;">
                <p><strong>Need Help?</strong></p>
                <p>If you have any questions or need assistance, please contact our support team.</p>
                @if($userType === 'teacher')
                    <p>📧 Email: support@school.com | 📞 Phone: (555) 123-4567</p>
                @else
                    <p>📧 Email: student-support@school.com | 📞 Phone: (555) 123-4568</p>
                @endif
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p><strong>School Management System</strong></p>
            <p>© {{ date('Y') }} All rights reserved.</p>
            <p>This is an automated message. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>