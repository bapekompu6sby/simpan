<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lokasi;

class LokasiController extends Controller
{
    public function store(Request $request) {
        $lokasi = new Lokasi();
        $lokasi->id_barang = $request->id_barang;
        $lokasi->lokasi = $request->lokasi;
        $lokasi->id_pengguna = session()->get('id');
        $save = $lokasi->save();
        
        if ($save) {
            return redirect()->back()->with('success', 'Berhasil Mengubah Lokasi');
        }
    }

    public function show($id){
        $lokasi = Lokasi::where('id_barang', $id)->orderBy('created_at', 'desc')->first();

        return $lokasi 
            ? response()->json($lokasi->only('lokasi'))
            : response()->json(['lokasi' => null]);
    }
}
