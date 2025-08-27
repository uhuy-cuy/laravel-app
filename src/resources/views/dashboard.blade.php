<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MyApp</a>
    <div class="d-flex">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-outline-light btn-sm">Logout</button>
        </form>
    </div>
  </div>
</nav>

<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="card-title">Selamat Datang 🎉</h3>
            <p class="card-text">
                Halo <strong>{{ $user['nama'] ?? $user['email'] }}</strong>, kamu berhasil login.
            </p>
        </div>
    </div>
</div>

</body>
</html>
