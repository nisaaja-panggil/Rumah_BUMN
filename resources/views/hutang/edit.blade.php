@extends('layout.template')
@section('judulh1', 'Admin - Edit Hutang')

@section('konten')
<div class="col-md-6">
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    

    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Data Hutang</h3>
        </div>
        <form action="{{ route('hutang.update', $hutang->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="penitipan_id">Penitipan</label>
                    <select class="form-control" id="penitipan_id" name="penitipan_id">
                        @foreach ($penitipan as $p)
                        <option value="{{ $p->id }}" {{ $hutang->penitipan_id == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_umkm }} - {{ $p->merek }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="jumlah_hutang">Jumlah Hutang</label>
                    <input type="number" class="form-control" id="jumlah_hutang" name="jumlah_hutang" value="{{ $hutang->jumlah_hutang }}">
                </div>
                <div class="form-group">
                    <label for="jumlah_bayar">Jumlah Bayar</label>
                    <input type="number" class="form-control" id="jumlah_bayar" name="jumlah_bayar" value="{{ old('jumlah_bayar', $hutang->jumlah_bayar) }}">
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $hutang->tanggal }}">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-warning float-right">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
