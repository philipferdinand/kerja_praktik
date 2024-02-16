<!-- resources/views/layouts/hasil.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-image: url('/images/background.jpg'); /* Sesuaikan path ke gambar background di sini */
            background-size: cover;
            background-position: center;
        }
        /* Gaya untuk tabel */
        table {
            background-color: yellow; /* Warna latar belakang tabel */
            color: black; /* Warna teks pada tabel */
        }

        /* Gaya untuk garis pada tabel */
        table, th, td {
            border: 1px solid black; /* Warna garis tabel */
        }

        h2 {
        color: white; /* Warna teks putih */
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <a href="{{ route('welcome') }}" class="btn btn-primary">Back to Home</a>
    <h2>User Data</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Instagram</th>
                <th>LinkedIn</th>
                <th>Twitter</th>
                <th>Description</th>
                <th>Metaphore</th>
                <th>Core1</th>
                <th>Core2</th>
                <th>Core3</th>
                <th>Core4</th>
                <th>Color</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="table-warning"> <!-- Tambahkan kelas table-warning untuk warna kuning -->
                    <td>{{ $user->nama }}</td>
                    <td id="instagram_{{ $user->id }}">{{ $user->instagram }}</td>
                    <td id="linkedin_{{ $user->id }}">{{ $user->linkedin }}</td>
                    <td id="twitter_{{ $user->id }}">{{ $user->twitter }}</td>
                    <td>
                        @if (count($user->hasilAnalisis)>0)
                        {{$user->hasilAnalisis[0]->description}}
                        @endif
                    </td>
                    <td>
                    @if (count($user->hasilAnalisis)>0)
                        {{$user->hasilAnalisis[0]->metaphor}}
                        @endif
                    </td>
                    <td>
                    @if (count($user->hasilAnalisis)>0)
                        {{$user->hasilAnalisis[0]->core_1}}
                        @endif
                    </td>
                    <td>
                    @if (count($user->hasilAnalisis)>0)
                        {{$user->hasilAnalisis[0]->core_2}}
                        @endif
                    </td>
                    <td>
                    @if (count($user->hasilAnalisis)>0)
                        {{$user->hasilAnalisis[0]->core_3}}
                        @endif
                    </td>
                    <td>
                    @if (count($user->hasilAnalisis)>0)
                        {{$user->hasilAnalisis[0]->core_4}}
                        @endif
                    </td>
                    <td>
                    @if (count($user->hasilAnalisis)>0)
                        {{$user->hasilAnalisis[0]->color}}
                        @endif
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

        <!-- Pagination links -->
    <div class="d-flex justify-content-center">
        {{ $hasilAnalisis->links('pagination::bootstrap-4') }}
    </div>

</div>

<!-- show data analysis -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js" crossorigin="anonymous"></script>


</body>
</html>
