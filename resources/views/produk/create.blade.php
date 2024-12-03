@extends('layout.template')
@section('judulh1',' - produk')

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

    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Tambah Data produk</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('produk.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class=" card-body">
              <div class="form-group">
                <label for="penjual" class="form-label">Penjual</label>
                <select class="form-control" name="penitipan_id">
                    <option hidden>--Pilih penjual--</option>
                    @foreach($penitipan as $dt)
                        <option value="{{ $dt->id }}">{{ $dt->nama_umkm }}</option>
                    @endforeach
                </select>
            </div>
              <div class="mb-3">
                <label for="nama_produk" class="form-label">nama produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk">
              </div>
              <div class="mb-3">
                <label for="deskripsi" class="form-label">deskripsi</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi">
              </div>
              
              <div class="mb-3">
                <label for="stok" class="form-label">stok</label>
                <input type="number" class="form-control" id="stok" name="stok">
              </div>
              <div class="mb-3">
                <label for="price" class="form-label">price</label>
                <input type="number" class="form-control" id="price" name="price">
              </div>
              <div class="mb-3">
                <label for="foto" class="form-label">foto</label>
                <input type="file" class="form-control" id="foto" name="foto">
              </div>
                        
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
