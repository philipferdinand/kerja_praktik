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

     <!-- Form pencarian -->
<form id="searchForm" action="{{ route('search') }}" method="GET">
    <div class="row mb-3">
        <div class="col">
            <input type="text" class="form-control" placeholder="Search by Name, Email, or Instagram" name="search" id="searchInput">
        </div>
        <div class="col">
            <select class="form-select" name="status" id="statusSelect">
                <option value="">Filter by Status</option>
                <option value="Pending">Pending</option>
                <option value="Cancelled">Cancelled</option>
                <!-- Tambahkan opsi filter sesuai kebutuhan -->
            </select>
        </div>
    </div>
</form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Tanggal Lahir</th>
                <th>Instagram</th>
                <th>LinkedIn</th>
                <th>Twitter</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="userData">
            @foreach($users as $user)
                <tr class="table-warning"> <!-- Tambahkan kelas table-warning untuk warna kuning -->
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>{{ $user->birthdate }}</td>
                    <td id="instagram_{{ $user->id }}">{{ $user->instagram }}</td>
                    <td id="linkedin_{{ $user->id }}">{{ $user->linkedin }}</td>
                    <td id="twitter_{{ $user->id }}">{{ $user->twitter }}</td>
                    <td>
                        <span id="status_{{ $user->id }}">Pending</span>
                    </td>
                    <td>
                        <button type="button" id="analyzeButton_{{ $user->id }}" class="btn btn-primary" onclick="analyzeUser({{ $user->id }})">Analyze</button>
                        <button type="button" id="cancelButton_{{ $user->id }}" class="btn btn-danger" onclick="cancelAnalyze({{ $user->id }})">Cancel</button>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    
    <div class="d-flex justify-content-center">
        {{ $users->links('pagination::bootstrap-4') }}
    </div>

    

</div>

<!-- Script untuk melakukan analisis dan membatalkan analisis -->
<script type="text/javascript">
    // Variabel global untuk status permanen
    var permanentStatus = "Cancelled";

    async function _callService(data){
        const URL = `http://localhost:3000/prompt`
        const response = await fetch(URL, {
            method: "POST", // *GET, POST, PUT, DELETE, etc.
            mode: "cors", // no-cors, *cors, same-origin
            cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
            credentials: "same-origin", // include, *same-origin, omit
            headers: {
      //"Content-Type": "application/json",
      // 'Content-Type': 'application/x-www-form-urlencoded',
    },
        redirect: "follow", // manual, *follow, error
        referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
        body: JSON.stringify(data), // body data type must match "Content-Type" header
  }).then(res=>res.json())
        return response
    }
    function analyzeUser(userId) {
        console.log(userId)
        var instagramUsername = document.getElementById("instagram_"+userId).innerHTML;

        console.log(instagramUsername)

        //service
        _callService({ instagram: instagramUsername})
        .then(res => {
    console.log(res);
    var hasilAnalisis = res.message // <-- hasil analisis ada di sini

    // kirimkan hasil analisis untuk disimpan:
    fetch('/simpan-hasil', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ hasilAnalisis,user_id:userId })
    }).then(res => {
        console.log('Hasil analisis berhasil disimpan');
    }).catch(e => {
        console.log(e);
    })
})
.catch(e => {
    console.log(e);
})

    }


</script>


<!-- Script untuk melakukan analisis dan membatalkan analisis -->
<script type="text/javascript">
    // Fungsi untuk membatalkan analisis
    function cancelAnalyze(userId) {
        // Kirim permintaan AJAX untuk memperbarui status menjadi "Cancelled"
        fetch(`/users/${userId}/update-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ status: 'Cancelled' })
        })
        .then(response => {
            // Periksa status respons
            if (!response.ok) {
                throw new Error('Failed to cancel analysis');
            }
            // Ubah teks status menjadi "Cancelled"
            document.getElementById("status_" + userId).innerText = 'Cancelled';
            // Sembunyikan tombol "Analyze" dan "Cancel"
            document.getElementById("analyzeButton_" + userId).style.display = "none";
            document.getElementById("cancelButton_" + userId).style.display = "none";
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>

<div id="searchResults"></div>

<script>
    // Tambahkan event listener untuk input pencarian
document.getElementById('searchInput').addEventListener('input', function(event) {
    var searchValue = event.target.value;
    var statusValue = document.getElementById('statusSelect').value;

    // Kirim permintaan pencarian menggunakan AJAX
    fetch(`{{ route('search') }}?search=${searchValue}&status=${statusValue}`)
        .then(response => response.text())
        .then(data => {
            // Tampilkan hasil pencarian langsung di tabel
            document.getElementById('userData').innerHTML = data;
        });
});

// Tambahkan event listener untuk select filter status
document.getElementById('statusSelect').addEventListener('change', function(event) {
    var searchValue = document.getElementById('searchInput').value;
    var statusValue = event.target.value;

    // Kirim permintaan pencarian menggunakan AJAX
    fetch(`{{ route('search') }}?search=${searchValue}&status=${statusValue}`)
        .then(response => response.text())
        .then(data => {
            // Tampilkan hasil pencarian langsung di tabel
            document.getElementById('userData').innerHTML = data;
        });
});
</script>

</body>
</html>
