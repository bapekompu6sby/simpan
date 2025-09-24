<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AsetImport;
use App\Models\Barang;
use App\Models\Lokasi;
use App\Models\Kategori;
use DataTables;
use App\Exports\AsetExport;
use Carbon\Carbon;

class AsetController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Barang::with('kategori')->withLatestLokasi();

            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->addColumn('kategori', function ($row) {
                    return $row->kategori->nama_kategori;
                })
                ->addColumn('lokasi', function ($row) {
                    $lokasi = $row->lokasi ? $row->lokasi : '-';
                    $editButton = '<button type="button" class="btn btn-sm editButton" data-id="' . $row->id_barang . '" data-lokasi="' . $row->lokasi . '"><i class="fa fa-fw fa-pencil-alt"></i></button>';
                    return $lokasi . ' ' . $editButton;
                })
                ->addColumn('aksi', function ($row) {
                    $detail = '<a href="' . route('admin.detail.aset', $row->id_barang) . '" class="btn btn-sm btn-warning"><i class="fas fa-info-circle"></i></a>';
                    $delete = '<a href="' . route('admin.aset.delete', ['id' => $row->id_barang]) . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Apakah Anda yakin ingin menghapus barang ini? Menghapus barang akan berpengaruh terhadap data yang berelasi\')"><i class="fa fa-fw fa-trash"></i></a>';
                    return $detail . ' ' . $delete;
                })
                ->rawColumns(['lokasi', 'aksi'])
                ->make(true);
        }

        return view('admin.aset.select', [
            'title' => 'List Data Aset',
            'kategori' => Kategori::all(),
        ]);
    }

    public function viewImport()
    {
        $data = [
            'title' => 'Import Data Aset',
            'kategori' => Kategori::all(),
        ];
        return view('admin.aset.import', $data);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|max:5000|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');
        $id_kategori = $request->id_kategori;

        if (!$file->isValid()) {
        return redirect()->back()->withErrors(['file' => 'File tidak valid atau gagal diunggah.']);
    }

    try {
        Excel::import(new AsetImport($id_kategori), $file);
        session()->flash('success', 'Berhasil Mengimport Data Aset');
        return redirect()->route('admin.data.aset');
    } catch (\Exception $e) {
        // Tangani error jika terjadi masalah saat impor
        return redirect()->back()->withErrors(['file' => 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage()]);
    }
}

    public function showByKategori(Request $request, $slug)
    {
        $kategori = Kategori::where('slug', $slug)->firstOrFail();
        if ($request->ajax()) {
            $query = Barang::with('kategori')->withLatestLokasi()->where('id_kategori', $kategori->id_kategori);

            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->addColumn('kategori', function ($row) {
                    return $row->kategori->nama_kategori;
                })
                ->addColumn('lokasi', function ($row) {
                    $lokasi = $row->lokasi ? $row->lokasi : '-';
                    $editButton = '<button type="button" class="btn btn-sm editButton" data-id="' . $row->id_barang . '" data-lokasi="' . $row->lokasi . '"><i class="fa fa-fw fa-pencil-alt"></i></button>';
                    return $lokasi . ' ' . $editButton;
                })
                ->addColumn('aksi', function ($row) {
                    $detail = '<a href="' . route('admin.detail.aset', $row->id_barang) . '" class="btn btn-sm btn-warning"><i class="fas fa-info-circle"></i></a>';
                    $delete = '<a href="' . route('admin.aset.delete', ['id' => $row->id_barang]) . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Apakah Anda yakin ingin menghapus barang ini? Menghapus barang akan berpengaruh terhadap data yang berelasi\')"><i class="fa fa-fw fa-trash"></i></a>';
                    return $detail . ' ' . $delete;
                })
                ->rawColumns(['lokasi', 'aksi'])
                ->make(true);
        }

        return view('admin.aset.selectbykategori', [
            'title' => 'List Data Aset ' . $kategori->nama_kategori,
            'kategori' => Kategori::all(),
            'kategoriNow' => $slug
        ]);
    }

    public function show($id = null)
    {
        $data = [
            'title' => 'List Data Aset ',
            'barang' => Barang::with('kategori')->withLatestLokasi()->find($id),
            'lokasi' => Lokasi::where('id_barang', '=', $id)->orderBy('created_at', 'desc')->with('peminjaman')->get(),
            'pemindah' => Lokasi::with('pengguna')->get()
        ];

        //echo json_encode($data['lokasi']);
        return view('admin.aset.detail', $data);
    }

    public function getNupByName(Request $request)
    {
        $name = $request->input('name');
        $nup = Barang::select('nup','id_barang')->where('nama_barang', $name)->get();
        return response()->json($nup);
    }

    function getNoPolisiByMerek(Request $request) {
        $merek = $request->input('merek');
        $no_polisi = Barang::select('no_polisi','id_barang')->where('merek', $merek)->get();
        return response()->json($no_polisi);
    }

    public function export()
    {
        $dateTime = Carbon::now('Asia/Jakarta')->format('d-m-Y'); 
        $filename = "{$dateTime}_data aset.xlsx";
        return Excel::download(new AsetExport(), $filename);
    }

    public function exportByKategori($slug) {
        $kategori = Kategori::where('slug', $slug)->firstOrFail();
        $dateTime = Carbon::now('Asia/Jakarta')->format('d-m-Y'); 
        $filename = "{$dateTime}_data aset {$slug}.xlsx";
        return Excel::download(new AsetExport($kategori->id_kategori), $filename);
    }

    public function destroy($id){
        $delete = Barang::destroy($id);
        if ($delete) {
            return redirect()->back()->with('success', 'Berhasil Menghapus Data Barang');
        }
            
    }
}
