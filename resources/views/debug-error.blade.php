<!-- Create this file: resources/views/debug-error.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .debug-container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .error {
            color: #d32f2f;
            background: #ffebee;
            padding: 15px;
            border-radius: 4px;
            border-left: 4px solid #d32f2f;
            margin-bottom: 20px;
        }
        .info {
            color: #1976d2;
            background: #e3f2fd;
            padding: 15px;
            border-radius: 4px;
            border-left: 4px solid #1976d2;
            margin-bottom: 20px;
        }
        .success {
            color: #388e3c;
            background: #e8f5e8;
            padding: 15px;
            border-radius: 4px;
            border-left: 4px solid #388e3c;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #1976d2;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 10px 5px 0 0;
        }
        .btn:hover {
            background: #1565c0;
        }
        .btn-danger {
            background: #d32f2f;
        }
        .btn-danger:hover {
            background: #c62828;
        }
    </style>
</head>
<body>
    <div class="debug-container">
        <h1>🐛 Authentication Debug Information</h1>
        
        @if($error)
            <div class="error">
                <strong>Error:</strong> {{ $error }}
            </div>
        @endif

        @if($authenticated)
            <div class="success">
                <strong>✅ User is authenticated</strong>
            </div>
        @else
            <div class="error">
                <strong>❌ User is NOT authenticated</strong>
            </div>
        @endif

        <h2>User Information</h2>
        <table>
            <tr>
                <th>Property</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Authenticated</td>
                <td>{{ $authenticated ? 'Yes' : 'No' }}</td>
            </tr>
            <tr>
                <td>User ID</td>
                <td>{{ $user_id ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $user_email ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Model Class</td>
                <td>{{ $user_class ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Detected Role</td>
                <td>{{ $detected_role ?? 'NULL' }}</td>
            </tr>
            <tr>
                <td>Expected Role</td>
                <td>{{ $expected_role ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Role Match</td>
                <td>{{ $role_match ? 'Yes' : 'No' }}</td>
            </tr>
        </table>

        <h2>Possible Issues & Solutions</h2>
        <div class="info">
            @if(!$authenticated)
                <p><strong>Issue:</strong> User is not authenticated</p>
                <p><strong>Solution:</strong> Please log in first</p>
            @elseif(!$detected_role)
                <p><strong>Issue:</strong> Could not detect user role</p>
                <p><strong>Solution:</strong> Check if the getUserRole() method is working correctly</p>
            @elseif(!$role_match)
                <p><strong>Issue:</strong> Role mismatch</p>
                <p><strong>Solution:</strong> Expected "{{ $expected_role }}" but got "{{ $detected_role }}"</p>
            @else
                <p><strong>Status:</strong> Everything looks good! This should work.</p>
            @endif
        </div>

        <h2>Actions</h2>
        <a href="/login" class="btn">Back to Login</a>
        <a href="/teacher/dashboard" class="btn">Try Teacher Dashboard Again</a>
        <a href="/" class="btn btn-danger">Home</a>
    </div>
</body>
</html>