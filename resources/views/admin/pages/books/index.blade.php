@extends('admin.layout.mother')
@section('container')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Tombol Tambah Pendaftaran Beasiswa -->
    <div class="text-right mb-3">
        <a href="{{ route('books.add') }}" class="btn btn-primary">Tambah Jenis buku</a>
    </div>

    <!-- Tabel Pendaftaran Beasiswa -->
    <div class="table-responsive">
        <table class="table table-bordered" id="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>judul buku</th>
                    <th>penulis</th>
                    <th>deskripsi</th>
                    <th>gambar</th>
                    <th>kategori</th>
                    <th>rilis</th>
                    <th>harga</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['data'] as $item)
                <tr>
                    <td>{{ $item['id'] }}</td>
                    <td>{{ $item['title'] }}</td>
                    <td>{{ $item['author'] }}</td>
                    <td>{{ $item['description'] }}</td>
                    <td><img src="{{ asset('storage/' . $item['image']) }}" alt="Image" style="width: 40%; height:30%"></td>
                    <td>{{ $item['kategori'] }}</td>
                    <td>{{ $item['published_date'] }}</td>
                    <td>{{ $item['price'] }}</td>
                    <td>
                    <a href="{{ route('books.edit', $item['id']) }}" class="btn btn-sm btn-warning"data-toggle="modal">Edit</a>
                    <form action="{{ route('books.delete', $item['id']) }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>                                
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
