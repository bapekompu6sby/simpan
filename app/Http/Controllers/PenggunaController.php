<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title'     => 'List Data Pengguna',
            'pengguna'  => Pengguna::all()
        ];

        return view('admin.pengguna.select', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pengguna = new Pengguna();
        $pengguna->nama = $request->nama;
        $pengguna->username = $request->username;
        $pengguna->email = $request->email;
        $pengguna->nip = $request->nip;
        $pengguna->password = Hash::make($request->password);
        $save = $pengguna->save();
        
        if ($save) {
            session()->flash('success', 'Berhasil Menambah Data Pengguna');
            return redirect()->route('admin.data.pengguna');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $pengguna = Pengguna::find($request->id_pengguna);
        $pengguna->nama = $request->nama;
        $pengguna->username = $request->username;
        $pengguna->email = $request->email;
        $pengguna->nip = $request->nip;

        if ($request->password) {
            $pengguna->password = Hash::make($request->password);
        }

        $update = $pengguna->save();

        if ($update) {
            session()->flash('success', 'Berhasil Mengubah Data Pengguna');
            return redirect()->route('admin.data.pengguna');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = Pengguna::destroy($id);
        if ($delete) {
            session()->flash('success', 'Berhasil Menghapus Data Pengguna');
            return redirect()->route('admin.data.pengguna');
        }
            
    }
}
