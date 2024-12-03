<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\penitipan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class barangcontroller extends Controller
{
    //
    public function index(){
        return view('produk.index',["title" => "produk umkm","data"=>produk::paginate(8)]);
       
    }

    public function cari(Request $request){
        $cari=$request->cari;
        $produk=produk::where('nama_produk','LIKE','%'.$cari.'%')
                      ->paginate(8);
        return view( 'produk.index',['data'=>$produk])->with(["title"=>"cari produk"]);
    }
    public function create(){
        $penitipan = penitipan::all(); // Ambil semua data penjual
        return view('produk.create', compact('penitipan'))->with(["title"=>"tambah data produk"]);   
    }
    public function store(Request $request){
        $validasi = $request->validate([
            "nama_produk" => "required",
            "penitipan_id" => "nullable",
            "price" => "required",
            "stok" => "required",
            "deskripsi" => "required",
            "foto" => "image|file" // Ubah ukuran maksimum
        ]);
    
        if ($request->file('foto')) {
            // Simpan gambar dan ambil path-nya
            $validasi['foto'] = $request->file('foto')->store('img');
        }
    
        produk::create($validasi);
        return redirect()->route('produk.index');
    }
    public function edit(produk $produk): View {
        return view('produk.edit', compact('produk'))->with(["title"=>"ubah data produk"]);
    }
    public function update(produk $produk, Request $request){
        $validasi = $request->validate([
            "nama_produk" => "required",
            "price" => "required",
            "stok" => "required",
            "deskripsi" => "required",
            "foto" => "image|file" // Ubah ukuran maksimum
        ]);
    
        if ($request->file('foto')) {
            $validasi['foto'] = $request->file('foto')->store('img');
        }
        
        $produk->update($validasi);
        return redirect()->route('produk.index')->with(["title" => "edit data produk"]);
    }
    
    public function destroy($id){
        produk::where('id',$id)->Delete();
        return redirect()->route(('produk.index'))->with('success', 'produk berhasil dihapus');;
    }
    public function show(produk $produk):View{
        return view('produk.tampil',compact('produk'))
                          ->with(["title"=>"data produk"]);
    }
}
