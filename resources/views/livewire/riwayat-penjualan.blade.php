@extends('layout.template')

@section('judulh1')
Riwayat Penjualan
@endsection

@section('konten')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Riwayat Penjualan</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Customer</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($riwayatPenjualan as $penjualan)
                    @foreach($penjualan->detail_penjualan as $detail)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($penjualan->created_at)->format('d-m-Y') }}</td>
                            <td>{{ $penjualan->nama_customer }}</td>
                            <td>{{ $detail->produk->nama_produk }}</td>
                            <td>{{ $detail->qty }}</td>
                            <td>{{ number_format($detail->qty * $detail->price, 2) }}</td>
                            
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
