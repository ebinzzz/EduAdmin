<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Updated</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        .alert {
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            border-left: 4px solid #007bff;
            background-color: #d1ecf1;
            color: #0c5460;
        }
        .alert.password {
            border-left-color: #dc3545;
            background-color: #f8d7da;
            color: #721c24;
        }
        .changes-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .changes-table th {
            background: #495057;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: 600;
        }
        .changes-table td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
        }
        .changes-table tr:last-child td {
            border-bottom: none;
        }
        .old-value {
            color: #dc3545;
            text-decoration: line-through;
            font-style: italic;
        }
        .new-value {
            color: #28a745;
            font-weight: 600;
        }
        .footer {
            margin-top: 30px;
            padding: 20px;
            background: #e9ecef;
            border-radius: 5px;
            font-size: 14px;
            color: #6c757d;
        }
        .contact-info {
            margin-top: 20px;
            padding: 15px;
            background: white;
            border-radius: 5px;
            border: 1px solid #dee2e6;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
            font-weight: 600;
        }
        .password-box {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
            font-family: 'Courier New', monospace;
            font-size: 16px;
            text-align: center;
            letter-spacing: 2px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🔄 Profile Updated</h1>
        <p>Your teacher profile has been updated</p>
    </div>

    <div class="content">
        <div class="greeting">
            Hello {{ $teacher->first_name }} {{ $teacher->last_name }},
        </div>

        <p>We're writing to inform you that your teacher profile has been updated by the administration team.</p>

        @if($hasNewPassword)
            <div class="alert password">
                <strong>🔐 Important: Your Password Has Been Reset</strong>
                <p>A new password has been generated for your account. Please use the password below to log in:</p>
                <div class="password-box">
                    <strong>{{ $newPassword }}</strong>
                </div>
                <p><em>Please change this password after your next login for security purposes.</em></p>
            </div>
        @endif

        @if($hasChanges)
            <div class="alert">
                <strong>📝 The following changes were made to your profile:</strong>
            </div>

            <table class="changes-table">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Previous Value</th>
                        <th>New Value</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($changes as $change)
                        <tr>
                            <td><strong>{{ $change['field'] }}</strong></td>
                            <td class="old-value">{{ $change['old'] ?: 'Not set' }}</td>
                            <td class="new-value">{{ $change['new'] ?: 'Not set' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert">
                <strong>ℹ️ No profile changes were made</strong>
                <p>This notification was sent for administrative purposes, but no actual changes were made to your profile data.</p>
            </div>
        @endif

        <div class="contact-info">
            <h3>📞 Need Help?</h3>
            <p>If you have any questions about these changes or need assistance with your account, please contact:</p>
            <ul>
                <li><strong>Email:</strong> admin@school.edu</li>
                <li><strong>Phone:</strong> (555) 123-4567</li>
                <li><strong>Office Hours:</strong> Monday - Friday, 8:00 AM - 5:00 PM</li>
            </ul>
        </div>

        @if($hasNewPassword)
            <p style="text-align: center; margin: 30px 0;">
                <a href="{{ route('login') }}" class="button">🔐 Login to Your Account</a>
            </p>
        @endif

        <div class="footer">
            <p><strong>Important Security Information:</strong></p>
            <ul>
                <li>If you did not expect this update, please contact the administration immediately</li>
                <li>Never share your login credentials with anyone</li>
                <li>Always log out completely when using shared computers</li>
                @if($hasNewPassword)
                <li>Change your password after logging in with the temporary password provided</li>
                @endif
            </ul>
            
            <hr style="margin: 20px 0; border: none; border-top: 1px solid #ccc;">
            
            <p style="text-align: center; color: #6c757d; font-size: 12px;">
                This email was sent by {{ config('app.name') }} Administration<br>
                <em>This is an automated message, please do not reply to this email.</em><br>
                <small>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</small>
            </p>
        </div>
    </div>
</body>
</html>