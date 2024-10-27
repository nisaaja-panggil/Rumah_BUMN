@extends('layout.template')
@section('judulh1','Admin - penitipan')

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
            <h3 class="card-title">Ubah Data penitipan</h3>
        </div>
        <form action="{{route('penitipan.update',$penitipan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class=" card-body">
                <div class="form-group">
                <label for="nama_umkm">Nama umkm</label>
                <input type="text" class="form-control" id="nama_umkm" name="nama_umkm" placeholder="" value="{{ $penitipan->nama_umkm }}">
            </div>
            <div class="form-group">
                <label for="merek">merek</label>
                <input type="text" class="form-control" id="merek" name="merek" value="{{ $penitipan->merek }}">
            </div>
            <div class="form-group">
                <label for="jumlah_titip">jumlah titip</label>
                <input type="number" class="form-control" id="jumlah_titip" name="jumlah_titip" value="{{ $penitipan->jumlah_titip }}">
            </div>
            <div class="form-group">
                <label for="harga_satuan">harga satuan</label>
                <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" value="{{ $penitipan->harga_satuan}}">
            </div>
            <div class="form-group">
                <label for="harga_bayar">harga bayar</label>
                <input type="number" class="form-control" id="harga_bayar" name="harga_bayar" value="{{ $penitipan->harga_bayar }}">
            </div>
            
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-warning float-right">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
