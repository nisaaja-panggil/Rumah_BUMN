@extends('layout.template')
@section('judulh1', 'produk umkm')
@section('konten')
    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-3">
                <a href="{{ route('produk.create') }}" class="btn btn-md btn-success">Tambah Data produk</a>
            </div>
            <div class="col-lg-9">
                <form action="{{ route('cariproduk') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari..." name="cari"
                            value="{{ request('cari') }}">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- atas --}}
        <div class="row mt-5" >
        @foreach ($data as $produk)
            <div class="col-lg-6" >
                <div class="card mb-3" style="max-width: 500px;" >
                    <div class="row g-0" >
                        <div class="col-md-4 d-flex align-items-center">
                            @if($produk->foto)
                        <img src="{{ asset('storage/' . $produk->foto) }}" class="img-fluid rounded-start ml-3" style="height: 250px; object-fit: foto;">
                        @else
                        <img src="{{ asset('img/logo.png') }}" class="img-fluid rounded-start ml-3" style="height: 250px; object-fit: foto;">      
                        @endif
                    </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                
                                <p class="card-text">nama produk : {{ $produk->nama_produk }}</p>
                                <p class="@if($produk->stok <= 0) text-danger @endif"> stok : {{ $produk->stok }}</p>
                                  <p>price : @money($produk->price) </p>
                               
                                <p class="card-text">penjual : {{ $produk->penitipan->nama_umkm }}</p>
                                
                                <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <a href="{{ route('produk.show',$produk->id) }}" class="btn btn-sm btn-success">Show</a>
                                <a href="{{ route('produk.create',$produk->id) }}" class="btn btn-sm btn-success">Beli</a>
                                <form action="{{ route('produk.destroy', $produk->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-sm btn-danger" value="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <br>
        {{ $data->links() }}
    </div>
@endsection