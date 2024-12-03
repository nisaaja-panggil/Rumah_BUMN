<?php

namespace App\Http\Controllers;

use App\Models\penjualan;
use App\Models\detail_penjualan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CetakController extends Controller
{
    //
    public function receipt():View{
        $id=session()->get('id');
        $penjualan=penjualan::find($id);
        $detail_penjualan=detail_penjualan::where('penjualan_id',$id)->get();
        return view('penjualan.receipt')->with([
            'dataOrder'=>$penjualan,
            'dataOrderDetail'=>$detail_penjualan
        ]);
    }
}