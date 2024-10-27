<?php

namespace App\Http\Controllers;
use App\Models\penitipan;
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
    public function store(Request $request):RedirectResponse{
        $request->validate([
            "nama_umkm"=>"required",
            "merek"=>"required",
            "jumlah_titip"=>"required",
            "harga_satuan"=>"required",
            "tanggal"=>"required",
            "harga_bayar"=>"required",
            "status"=>"nullable",
        ]);
        penitipan::create($request->all());
        return redirect()->route('penitipan.index')->with('success data','data customer berhasil ditambahkan');
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
