<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $data = [
            'title'     => 'List Data Kategori',
            'kategori'  => Kategori::all()
        ];

        return view('admin.kategori.select', $data);
    }

    public function insert(Request $request){
        $kategori = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->nama_kategori), '-'));
        $save = $kategori->save();
        
        if ($save) {
            session()->flash('success', 'Berhasil Menambah Data Kategori');
            return redirect()->route('admin.data.kategori');
        }
    }

    public function update(Request $request)
    {
        $kategori = Kategori::find($request->id_kategori);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->nama_kategori), '-'));
        $update = $kategori->save();

        if ($update) {
            session()->flash('success', 'Berhasil Mengubah Data Kategori');
            return redirect()->route('admin.data.kategori');
        }
    }

    public function destroy($id)
    {
        $delete = Kategori::destroy($id);
        if ($delete) {
            session()->flash('success', 'Berhasil Menghapus Data Kategori');
            return redirect()->route('admin.data.kategori');
        }
            
    }
}
