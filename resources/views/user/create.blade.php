<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persona</title>
    <!-- Link CSS Bootstrap -->
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
            padding: 5px;
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
        .mb-3 {
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
        <h1 class="h3 mb-3 font-weight-normal">Welcome to Persona</h1>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form id="yourFormId" action="/user/store" method="post" class="mx-auto">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="md-3">
                            <label for="nama" class="form-label">Nama:</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-3">
                            <input type="text" name="nama" class="form-control" required>
                            @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="md-3">
                            <label for="email" class="form-label">Email:</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-3">
                            <input type="email" name="email" class="form-control" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="md-3">
                            <label for="gender" class="form-label">Gender:</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-3">
                            <select name="gender" class="form-control" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                            @error('gender')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="md-3">
                            <label for="birthdate" class="form-label">Tanggal Lahir:</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-3">
                            <input type="date" name="birthdate" class="form-control" required>
                            @error('birthdate')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="md-3">
                            <label for="instagram" class="form-label">Link Instagram:</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-3">
                            <input type="text" name="instagram" class="form-control">
                            @error('instagram')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="md-3">
                            <label for="linkedin" class="form-label">Link LinkedIn:</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-3">
                            <input type="text" name="linkedin" class="form-control" required>
                            @error('linkedin')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="md-3">
                            <label for="twitter" class="form-label">Link Twitter:</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-3">
                            <input type="text" name="twitter" class="form-control" required>
                            @error('twitter')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row mb-3">
    <div class="col-md-6 offset-md-3">
        <button type="button" class="btn btn-primary" onclick="confirmSubmission()">Submit</button>
    </div>
</div>

<!-- Confirmation back -->
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
                Are you sure you want to go back? Any unsaved data will be lost.
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
    function confirmSubmission() {
        // Display a confirmation dialog
        var isConfirmed = confirm("Apakah yakin ingin membuat data?");

        // If the user clicks "OK" in the confirmation dialog, proceed with the submission
        if (isConfirmed) {
            // Trigger the form submission (assuming you have a form element)
            document.getElementById("yourFormId").submit();
            
        } else {
            // If the user clicks "Cancel" or closes the dialog, redirect back to the create page
            window.location.href = "{{ route('user.create') }}";
        }
    }
</script>

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