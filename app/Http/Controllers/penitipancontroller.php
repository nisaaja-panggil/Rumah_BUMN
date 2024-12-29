<?php

namespace App\Http\Controllers;
use App\Models\penitipan;
use App\Models\hutang;
use illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class penitipancontroller extends Controller
{
    //
    public function index()
    {
        return view('penitipan.tabel', [
            "title" => "penitipan",
            "data" => penitipan::all()
        ]);
    }
    public function create():View{
        return view('penitipan.tambah')->with(["title"=>"tambah data penitipan"]);
    }
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        "nama_umkm" => "required",
        "merek" => "required",
        "jumlah_titip" => "required|numeric|min:1",
        "harga_satuan" => "required|numeric|min:0",
        "harga_bayar" => "required|numeric|min:0",
        "status" => "nullable",
        "tanggal" => "required|date",
    ]);

    // Simpan data penitipan
    $penitipan = Penitipan::create($request->all());

    // Cek status penitipan
    if ($penitipan->status !== 'lunas') {
        // Simpan data hutang hanya jika status penitipan belum lunas
        hutang::create([
            'penitipan_id' => $penitipan->id,
            'jumlah_hutang' => $request->harga_bayar, // jumlah_hutang disamakan dengan harga_bayar
            'tanggal' => $request->tanggal,
            'status' => $penitipan->status,
        ]);
    }

    return redirect()->route('penitipan.index')->with('success', 'Data penitipan berhasil ditambahkan');
}



    public function edit(penitipan $penitipan): View {
    return view('penitipan.edit', compact('penitipan'))->with(["title"=>"ubah data penitipan"]);
}

public function update(Request $request, penitipan $penitipan): RedirectResponse {
    $request->validate([
        "nama_umkm"=>"required",
            "merek"=>"required",
            "jumlah_titip"=>"required",
            "harga_satuan"=>"required",
            "harga_bayar"=>"required",
            "status"=>"nullable",
    ]);
    $penitipan->update($request->all());
    return redirect()->route('penitipan.index')->with('updated', 'data umkm berhasil di ubah');
}

    public function destroy($id){
        penitipan::where('id',$id)->Delete();
        return redirect()->route(('penitipan.index'))->with('success', 'produk berhasil dihapus');;
    }
}
