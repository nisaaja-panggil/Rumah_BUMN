@extends('layout.template')
@section('judulh1',' - penitipan')

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
            <h3 class="card-title">Tambah Data penitipan</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('penitipan.store') }}" method="POST">
            @csrf

            <div class=" card-body">
                <div class="form-group">
                    <label for="nama_umkm">Nama umkm</label>
                    <input type="text" class="form-control" id="nama_umkm" name="nama_umkm" placeholder="">
                </div>
                <div class="form-group">
                    <label for="merek">merek</label>
                    <input type="text" class="form-control" id="merek" name="merek">
                </div>
                <div class="form-group">
                    <label for="jumlah_titip">jumlah titip</label>
                    <input type="number" class="form-control" id="jumlah_titip" name="jumlah_titip">
                </div>
                <div class="form-group">
                    <label for="harga_satuan">harga satuan</label>
                    <input type="number" class="form-control" id="harga_satuan" name="harga_satuan">
                </div>
                <div class="form-group">
                    <label for="harga_bayar">harga bayar</label>
                    <input type="number" class="form-control" id="harga_bayar" name="harga_bayar">
                    <div class="form-group">
                        <label for="status" class="form-label">status</label>
                        <select class="form-control" name="status">
                            <option hidden>--Pilih status--</option>
                            
                                <option value="belum_lunas">belum lunas</option>
                                <option value="lunas">lunas</option>
                            
                        </select>
                    </div>
                <div class="form-group">
                    <label for="tanggal">tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                </div>

            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
