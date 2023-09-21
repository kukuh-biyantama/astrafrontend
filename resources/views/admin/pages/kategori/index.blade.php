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
        <a href="{{ route('kategori.addkat') }}" class="btn btn-primary">Tambah Jenis kategori</a>
    </div>

    <!-- Tabel Pendaftaran Beasiswa -->
    <div class="table-responsive">
        <table class="table table-bordered" id="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Buku</th>
                    <th>Jenis Buku</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['data'] as $item)
                <tr>
                    <td>{{ $item['id'] }}</td>
                    <td>{{ $item['nama_buku'] }}</td>
                    <td>{{ $item['jenis_buku'] }}</td>
                    <td><img src="{{ asset('storage/' . $item['gambar']) }}" alt="Image" style="width: 40%; height:30%"></td>
                    <td>
                    <a href="{{ route('kategori.edit', $item['id']) }}" class="btn btn-sm btn-warning"data-toggle="modal">Edit</a>
                    <form action="{{ route('kategori.delete', $item['id']) }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?');">
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
