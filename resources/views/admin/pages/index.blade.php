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
        <a href="" class="btn btn-primary">Tambah Jenis Sampah</a>
    </div>

    <!-- Tabel Pendaftaran Beasiswa -->
    <div class="table-responsive">
        <table class="table table-bordered" id="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Jenis Sampah</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Harga/kg</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>   <img src="{{ asset('storage/' . $item->foto) }}" alt="Image" style="width: 50%; height:30%"></td>
                        <td>{{ $item->harga }}</td>
                        <td>
                            <a href="{{ route('admin.edit', $item->id) }}" class="btn btn-sm btn-warning"
                                data-toggle="modal">Edit</a>
                                <form action="{{ route('admin.delete', $item->id) }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>
@endsection
