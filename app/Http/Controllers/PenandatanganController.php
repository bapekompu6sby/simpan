<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penandatangan;

class PenandatanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Daftar Penandatangan',
            'penandatangan' => Penandatangan::all(),
        ];

        return view('admin.penandatangan.select', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pen = new Penandatangan();
        $pen->nama = $request->nama;
        $pen->nip = $request->nip;
        $pen->jabatan = $request->jabatan;
        $save = $pen->save();

        if ($save) {
            session()->flash('success', 'Berhasil Menambah Data Penandatangan');
            return redirect()->route('admin.penandatangan');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $pen = Penandatangan::find($request->id_penandatangan);
        $pen->nama = $request->nama;
        $pen->nip = $request->nip;
        $pen->jabatan = $request->jabatan;
        $update = $pen->save();

        if ($update) {
            session()->flash('success', 'Berhasil Mengubah Data Penandatangan');
            return redirect()->route('admin.penandatangan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = Penandatangan::destroy($id);
        if ($delete) {
            session()->flash('success', 'Berhasil Menghapus Data Penandatangan');
            return redirect()->route('admin.penandatangan');
        }
    }
}
