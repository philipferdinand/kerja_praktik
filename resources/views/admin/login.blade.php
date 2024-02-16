<!-- resources/views/admin/login.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <!-- Tambahkan link CSS atau script lainnya jika diperlukan -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-image: url('/images/background.jpg'); /* Sesuaikan path ke gambar background di sini */
            background-size: cover;
            background-position: center;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh; /* Untuk memberikan tinggi 100% pada viewport */
        }

        .card {
            width: 100%;
            max-width: 400px; /* Lebar maksimum card */
            padding: 20px;
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #000000; /* Warna card hitam */
            color: #FFFFFF; /* Warna teks putih pada card */
        }

        .form-signin {
            width: 100%;
        }

        /* Margin untuk memberikan jarak antar elemen */
        .mb-2 {
            margin-bottom: 1rem;
        }

        /* Tengahkankan tombol login */
        .btn-login {
            width: 100%;
            margin-bottom: 1rem; /* Tambahkan margin-bottom di sini */
        }

        /* Jarakkan tombol "Back to Welcome Page" dari tombol login */
        .btn-back {
            margin-top: 1rem; /* Tambahkan margin-top di sini */
        }
    </style>
</head>
<body class="text-center">
    <div class="container">
        <div class="card">
        <div class="card-body text-center">
            <form class="form-signin" action="{{ route('admin.login.post') }}" method="post">
                @csrf
                <h1 class="h3 mb-3 font-weight-normal">Admin Login</h1>

                <!-- Letakkan input untuk username dan placeholder -->
                <div class="mb-2">
                    <label for="inputUsername" class="sr-only">Username</label>
                    <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
                </div>

                <!-- Letakkan input untuk password dan placeholder -->
                <div class="mb-2">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                </div>
                
                <div>
                    <!-- Tombol login -->
                    <button class="btn btn-lg btn-primary btn-login" type="submit">Login</button>
                </div>

                <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to go back?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="goBackToWelcome()">Yes, Go Back</button>
            </div>
        </div>
    </div>
</div>

                <!-- Back Button -->
                <div class="row">
                    <div class="col-md-6 offset-md-3 text-center">
                        <button  type="button" class="btn btn-primary" onclick="openConfirmationModal()">Back</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>

    <!-- Link JS Bootstrap (w/ Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    function goBackToWelcome() {
        // Redirect to the "welcome" page
        window.location.href = "{{ route('welcome') }}";
    }

    function openConfirmationModal() {
        // Open the confirmation modal
        $('#confirmationModal').modal('show');
    }
</script>
</body>
</html>
