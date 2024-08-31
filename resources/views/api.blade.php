<!-- resources/views/data/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Data dari API</title>
</head>
<body>
    <h1>Data dari API</h1>

    @if(isset($data))
        <ul>
            @foreach($data as $item)
                <li>{{ $item['field_name'] }}</li> <!-- Ganti 'field_name' sesuai dengan struktur data yang diterima -->
            @endforeach
        </ul>
    @else
        <p>Tidak ada data yang ditemukan.</p>
    @endif
</body>
</html>
