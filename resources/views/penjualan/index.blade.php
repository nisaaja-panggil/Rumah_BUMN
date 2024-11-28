@extends('layout.template')
@section('judulh1', 'Produk UMKM')
@section('konten')
    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-6">
                <form action="{{ route('penjualan.store') }}" method="POST">
                    @csrf
                    <div class="form-row mb-3">
                        <div class="col-md-4">
                            <label>Date</label>
                            <input type="date" class="form-control" name="tanggal" value="{{ date('Y-m-d') }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Cashier</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label>Customer</label>
                            <input type="text" class="form-control" name="nama_customer" value="Umum">
                        </div>
                    </div>
                    
                    <div class="form-row mb-3">
                        <div class="col-md-6">
                            <label>Product</label>
                            <select name="produk_id" class="form-control">
                                @foreach ($produks as $produk)
                                    <option value="{{ $produk->id }}">{{ $produk->nama_produk }} - Rp{{ number_format($produk->harga, 0, ',', '.') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Qty</label>
                            <input type="number" class="form-control" name="jumlah" value="1" min="1">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary mt-4">Add</button>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Discount</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penjualans as $index => $penjualan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $penjualan->produk->nama_produk }}</td>
                                <td>Rp{{ number_format($penjualan->produk->harga, 0, ',', '.') }}</td>
                                <td>{{ $penjualan->jumlah }}</td>
                                <td>Rp{{ number_format($penjualan->diskon, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($penjualan->total - $penjualan->diskon, 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('penjualan.destroy', $penjualan->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Sidebar for Subtotal, Discount, Grand Total, Cash, Change -->
            <div class="col-lg-6">
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label>Sub Total</label>
                        <input type="text" class="form-control" value="9000" readonly>
                    </div>
                    <div class="col-md-4">
                        <label>Discount</label>
                        <input type="text" class="form-control" name="diskon" value="1000">
                    </div>
                    <div class="col-md-4">
                        <label>Grand Total</label>
                        <input type="text" class="form-control" value="8000" readonly>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <label>Cash</label>
                        <input type="text" class="form-control" name="uang_bayar" placeholder="Input Cash">
                    </div>
                    <div class="col-md-4">
                        <label>Change</label>
                        <input type="text" class="form-control" value="2000" readonly>
                    </div>
                    <div class="col-md-4">
                        <label>Note</label>
                        <textarea class="form-control" placeholder="Optional"></textarea>
                    </div>
                </div>

                <div class="mt-3">
                    <button class="btn btn-secondary">Cancel</button>
                    <button class="btn btn-success">Process Payment</button>
                </div>
            </div>
        </div>
    </div>
@endsection
