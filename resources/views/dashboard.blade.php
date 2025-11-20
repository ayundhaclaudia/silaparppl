<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

    <h2>Selamat Datang di Halaman Utama</h2>

    <p>Anda login sebagai: {{ auth()->user()->name }}</p>

    <form action="/logout" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

</body>
</html>
