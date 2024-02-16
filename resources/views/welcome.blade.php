<!-- resources/views/welcome.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-image: url('/images/background.jpg'); /* Sesuaikan path ke gambar background di sini */
            background-size: cover;
            background-position: center;
            color: #fff; /* Warna teks putih */
        }

        #sidebar {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 150px;
            background-color: #fff; /* Warna sidebar putih */
            padding: 20px;
            transition: margin-left 0.5s;
        }

        #content {
            margin-left: 150px;
            padding: 20px;
        }

        .btn {
            margin-bottom: 10px;
        }

        #toggle-btn {
            position: fixed;
            top: 10px;
            left: 10px;
            cursor: pointer;
            width: 30px; /* Adjust the size as needed */
            height: 30px; /* Adjust the size as needed */
            background: none;
            border: none;
            padding: 0;
        }

        #toggle-btn span {
            display: block;
            width: 20px;
            height: 2px;
            margin: 6px 0;
            background-color: #888; /* Color of the menu icon bars */
        }


        #sidebar h4 {
            color: #000; /* Warna teks hitam pada elemen h4 */
            margin-bottom: 50px; /* Menambahkan jarak ke bawah antara h4 dan tombol */
        }

        #sidebar button {
            margin-bottom: 20px; /* Menambahkan jarak ke bawah antara tombol */
        }


    </style>
</head>
<body>
    <div id="sidebar">
        <h4>Menu</h4>
            <button onclick="window.location='{{ route('user.create') }}'" class="btn btn-primary">User</button>
            <button onclick="window.location='{{ route('admin.login') }}'" class="btn btn-success">Admin</button>
            <button onclick="window.location='{{ route('analisis.hasil') }}'" class="btn btn-primary">Hasil</button>
    </div>

    <div id="content">
        <h2>Selamat Datang di Persona</h2>
    </div>

    <button id="toggle-btn">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <script>
        document.getElementById('toggle-btn').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.style.marginLeft = (sidebar.style.marginLeft === '0px' || sidebar.style.marginLeft === '') ? '-150px' : '0';
        });
    </script>
</body>
</html>
