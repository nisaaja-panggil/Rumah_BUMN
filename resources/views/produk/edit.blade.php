@extends('layout.template')
@section('judulh1','Admin - Produk')

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

    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Ubah Data Produk</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('produk.update',$produk->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class=" card-body">
                <div class="form-group">
                      <div class="mb-3">
                        <label for="nama_produk" class="form-label">nama produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{$produk->nama_produk}}">
                      </div>
                      <div class="mb-3">
                        <label for="deskripsi" class="form-label">deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{$produk->deskripsi}}">
                      </div>
                      
                      <div class="mb-3">
                        <label for="stok" class="form-label">stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" value="{{$produk->stok}}">
                      </div>
                      <div class="mb-3">
                        <label for="harga" class="form-label">harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" value="{{$produk->harga}}">
                      </div>
                      <div class="mb-3">
                        <label for="foto" class="form-label">foto</label>
                        <input type="image" class="form-control" id="foto" name="foto" value="{{$produk->foto}}">
                      </div>
                </div>
            </div>
            
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-warning float-right">Ubah</button>
            </div>
        </form>
    </div>


</div>


@endsection
