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
    <div>
        <main>
            <form action="{{ route('kategori.post') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nama Buku</label>
                  <input type="text" class="form-control" id="nama_buku" name="nama_buku" value="{{ old('nama_buku') }}">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Jenis Buku</label>
                  <input type="text" class="form-control" id="jenis_buku" name="jenis_buku" value="{{ old('jenis_buku') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar Buku</label>
                    <input type="file" class="form-control foto" id="gambar" name="gambar">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </main>
    </div>
@endsection
