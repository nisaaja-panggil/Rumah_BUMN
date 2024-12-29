<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hutang;
use App\Models\kasn;
use App\Models\penitipan;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class hutangcontroller extends Controller
{
    public function index(): View
    {
        $title = 'Hutang';
        $hutang = hutang::with('penitipan')->get();
        return view('hutang.index', compact('hutang', 'title'));
    }

    public function create(): View
    {
        $title = 'Tambah Hutang';
        $penitipan = penitipan::all();
        return view('hutang.create', compact('penitipan', 'title'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'penitipan_id' => 'required|exists:penitipans,id',
            'jumlah_hutang' => 'required|numeric|min:0',
            'jumlah_bayar' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ]);

        // Buat hutang baru
        hutang::create([
            'penitipan_id' => $request->penitipan_id,
            'jumlah_hutang' => $request->jumlah_hutang,
            'jumlah_bayar' => $request->jumlah_bayar,
            'tanggal' => $request->tanggal,
            'status' => $request->jumlah_hutang <= $request->jumlah_bayar ? 'lunas' : 'belum_lunas', // Atur status
        ]);

        return redirect()->route('hutang.index')->with('success', 'Data hutang berhasil ditambahkan');
    }

    public function edit(hutang $hutang): View
    {
        $title = 'Edit Hutang';
        $penitipan = penitipan::all();
        return view('hutang.edit', compact('hutang', 'penitipan', 'title'));
    }

    public function update(Request $request, hutang $hutang): RedirectResponse
{
    $request->validate([
        'penitipan_id' => 'required|exists:penitipans,id',
        'jumlah_hutang' => 'required|numeric|min:0',
        'jumlah_bayar' => 'required|numeric|min:0',
        'tanggal' => 'required|date',
    ]);

    // Ambil total arus masuk yang tersedia
    $totalArusMasuk = kasn::where('arus', 'masuk')->sum('total');

    // Pastikan jumlah bayar tidak melebihi total arus masuk
    if ($request->jumlah_bayar > $totalArusMasuk) {
        return redirect()->back()->withErrors(['jumlah_bayar' => 'Saldo Anda tidak cukup untuk melakukan pembayaran.']);
    }

    // Menghitung total bayar dan sisa hutang
    $totalBayar = $hutang->jumlah_bayar + $request->jumlah_bayar;
    $sisaHutang = $hutang->jumlah_hutang - $totalBayar;

    // Tentukan status hutang
    $status = $sisaHutang <= 0 ? 'lunas' : 'belum_lunas';

    // Update data hutang
    $hutang->update([
        'penitipan_id' => $request->penitipan_id,
        'jumlah_bayar' => $totalBayar,
        'tanggal' => $request->tanggal,
        'status' => $status,
    ]);

    // Cek jika hutang sudah lunas dan buat pencatatan kas keluar
    if ($status == 'lunas') {
        $totalHutangAsli = $hutang->jumlah_hutang;
        $penitipan = penitipan::find($request->penitipan_id);
        if ($penitipan) {
            $penitipan->update(['status' => 'lunas']);
        }
    

        kasn::create([
            'penjualan_id' => null, // Tidak terkait dengan penjualan
            'hutang_id' => $hutang->id, // Terkait dengan hutang
            'arus' => 'keluar', // Menandakan arus keluar
            'total' => $totalHutangAsli, // Total hutang asli
            'tanggal' => now(), // Tanggal transaksi
        ]);
    }

    // Mengurangi total arus masuk sesuai dengan jumlah bayar
    $kas = kasn::where('arus', 'masuk')->first(); // Menemukan transaksi kas yang pertama (sesuaikan jika lebih dari satu)
    if ($kas) {
        $kas->total -= $request->jumlah_bayar; // Kurangi saldo kas
        $kas->save();
    }


    // Update total kas (ars masuk dan keluar)
    $totalArusMasuk -= $request->jumlah_bayar;

    // Kembalikan ke halaman hutang dengan pesan sukses
    return redirect()->route('hutang.index')->with('success', 'Data hutang berhasil diubah');
}



    public function destroy(hutang $hutang): RedirectResponse
    {
        $hutang->delete();
        return redirect()->route('hutang.index')->with('success', 'Data hutang berhasil dihapus');
    }
}
