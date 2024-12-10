@extends('layout.template')
@section('judulh1',' - kas')

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
            <h3 class="card-title">Tambah Data kas</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('kas.store')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class=" card-body">
              <div class="form-group">
                <label for="nama_customer" class="form-label">nama customer</label>
                <select class="form-control" name="penjualan_id">
                    <option hidden>--Pilih nama customer--</option>
                    @foreach($penjualan as $dt)
                    <option value="{{ $dt->id }}" data-total="{{ $dt->total }}">{{ $dt->nama_customer }}</option>
                    @endforeach
                </select>
              @error('penjualan_id')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="arus" class="form-label">arus</label>
              <select class="form-control" name="arus">
                  <option hidden>--Pilih arus--</option>
                  @foreach($penjualan as $dt)
                      <option >masuk</option>
                      <option >keluar</option>
                  @endforeach
              </select>
            </div>
          </div>
          
                        
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
