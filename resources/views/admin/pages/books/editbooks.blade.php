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
            <form action="{{ route('books.update',$data['data']['id']) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Jenis Kategori Buku</label>
                    <select class="form-select" id="id_kategori" name="id_kategori">
                        @foreach ($jbook as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->jenis_buku }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">judul buku</label>
                  <input type="text" class="form-control" id="title" name="title" value="{{$data['data']['title']}}">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">penulis</label>
                  <input type="text" class="form-control" id="author" name="author" value="{{$data['data']['author']}}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">deskripsi</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{$data['data']['description']}}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">harga</label>
                    <input type="text" class="form-control" id="price" name="price" value="{{$data['data']['price']}}">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">tanggal rilis</label>
                    <input type="date" class="form-control" id="published_date" name="published_date" value="{{$data['data']['published_date']}}">
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
