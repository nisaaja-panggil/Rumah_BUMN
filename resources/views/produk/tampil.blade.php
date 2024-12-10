@extends('layout.template')
@section('judulh1','Data - Produk')

@section('konten')
<div class="col-md-6">
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Data Buku</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="d-flex justify-content-center mb-3">
                    <img src="{{ asset('storage/' . $produk->foto) }}" class="img-fluid rounded-start" style="height: 250px; object-fit: cover;">
                </div>
                <div class="form-group">
                    <label for="nama_produk" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ $produk->nama_produk }}">
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ $produk->deskripsi }}">
                </div>
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" class="form-control" id="stok" name="stok" value="{{ $produk->stok }}">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $produk->price }}">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer d-flex justify-content-end">
                <a href="{{ route('produk.index', $produk->id) }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
