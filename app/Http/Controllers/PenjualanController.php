<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        $penjualans = Penjualan::with('produk')->get(); // Mengambil data penjualan beserta relasi produk
        return view('penjualan.index', compact('produks', 'penjualans'))->with('title', 'Data Penjualan');
    }
    
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // Ambil data produk berdasarkan ID
            $produk = Produk::findOrFail($request->produk_id);

            // Hitung total sebelum diskon
            $subtotal = $produk->harga * $request->jumlah;
            $diskon = $request->diskon ?? 0;
            $grandTotal = $subtotal - $diskon;

            // Hitung uang kembali
            $uangBayar = $request->uang_bayar;
            $uangKembali = $uangBayar - $grandTotal;

            // Simpan data penjualan
            $penjualan = Penjualan::create([
                'produk_id' => $produk->id,
                'nama_customer' => $request->nama_customer,
                'jumlah' => $request->jumlah,
                'total' => $subtotal,
                'diskon' => $diskon,
                'uang_bayar' => $uangBayar,
                'tanggal' => now(),
            ]);

            // Update stok produk
            $produk->stok -= $request->jumlah;
            $produk->save();

            DB::commit();
            return redirect()->route('penjualan.index')->with('success', 'Transaksi berhasil diproses!')
                ->with('title', 'Data penitipan dan hutang berhasil ditambahkan');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
