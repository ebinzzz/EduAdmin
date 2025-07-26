<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $user->role ?? 'Dashboard' }}</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #4a4aef;
            padding: 1rem;
            color: white;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 2rem auto;
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        .btn {
            background-color: #4a4aef;
            border: none;
            color: white;
            padding: 10px 20px;
            margin-top: 1rem;
            text-decoration: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #3333cc;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            padding: 5px 0;
        }
    </style>
</head>
<body>

<div class="navbar">
    <h2>{{ ucfirst($user->role) }} Dashboard</h2>
</div>

<div class="container">
    <h3>Welcome, {{ $user->name }}!</h3>

    @yield('content')

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn" type="submit">Logout</button>
    </form>
</div>

</body>
</html>
