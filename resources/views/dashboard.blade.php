<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
<h1>Welcome, {{ $user->name }}!</h1>

<form action="{{ route('logout') }}" method="POST">
  @csrf
  <button type="submit">Logout</button>
</form>

</body>
</html>
