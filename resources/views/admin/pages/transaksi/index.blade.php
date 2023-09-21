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
                    <th>Nama pembeli</th>
                    <th>judul buku</th>
                    <th>jenis buku</th>
                    <th>alamat pengiriman</th>
                    <th>total buku</th>
                    <th>biaya</th>
                    <th>status</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['data'] as $item)
                <tr>
                    <td>{{ $item['id'] }}</td>
                    <td>{{ $item['nama_pembeli'] }}</td>
                    <td>{{ $item['judul_buku'] }}</td>
                    <td>{{ $item['jenis_buku'] }}</td>
                    <td>{{ $item['alamat_pengiriman'] }}</td>
                    <td>{{ $item['total_buku'] }}</td>
                    <td>{{ $item['biaya'] }}</td>
                    <?php 
                    if ($item['status'] == "0") {
                        echo '<td>belum dikonfirmasi</td>';
                    } else {
                        echo '<td>dikonfirmasi</td>';
                    }
                    ?>
                    <td>
                    @if ($item['status'] == "0")
                        <form action="{{ route('transaksi.update', $item['id']) }}" method="post" onsubmit="return confirm('Apakah Anda yakin update status ini?');">
                            @csrf
                            @method('put')
                            <input type="hidden" id="status" name="status" value="1">
                            <button type="submit" class="btn btn-primary">update status pembayaran</button>
                        </form>
                    @else
                    <button type="submit" class="btn btn-primary"readonly>tervalidasi</button>
                    @endif
                    <form action="{{ route('transaction.delete', $item['id']) }}" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?');">
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
