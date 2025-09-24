<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Lokasi;
use App\Models\Pengguna;
use App\Models\Penandatangan;
use App\Exports\PeminjamanExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title'     => 'Peminjaman Sedang Berlangsung',
            'peminjaman' => Peminjaman::where('status', '0')->get()
        ];
        return view('admin.peminjaman.select',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dateRange = $request->tanggal;

        if (strpos($dateRange, ' - ') !== false) {
            list($tanggal_pinjam, $tanggal_kembali) = explode(' - ', $dateRange);
        } else {
            $tanggal_pinjam = $dateRange;
            $tanggal_kembali = $dateRange;
        }

        $tanggal_pinjam = Carbon::createFromFormat('d/m/Y', $tanggal_pinjam)->format('Y-m-d');
        $tanggal_kembali = Carbon::createFromFormat('d/m/Y', $tanggal_kembali)->format('Y-m-d');

        $peminjaman = new Peminjaman();
        $peminjaman->peminjam = $request->peminjam;
        $peminjaman->nip = $request->nip;
        $peminjaman->instansi = $request->instansi;
        $peminjaman->alamat = $request->alamat;
        $peminjaman->no_telp = $request->no_telp;
        $peminjaman->tanggal_pinjam = $tanggal_pinjam;
        $peminjaman->tanggal_kembali = $tanggal_kembali;
        $peminjaman->deskripsi = $request->deskripsi;
        $peminjaman->tipe = $request->tipe;
        $peminjaman->id_petugas = session()->get('id');
        
        $penandatangan = Penandatangan::find($request->id_penandatangan);
        if ($penandatangan) {
            $peminjaman->nama_penandatangan = $penandatangan->nama;
            $peminjaman->nip_penandatangan = $penandatangan->nip;
            $peminjaman->jabatan_penandatangan = $penandatangan->jabatan;
        }
        $peminjaman->save();

        $id = $peminjaman->id_peminjaman;

        // Store ke tabel Detail Peminjaman Dan Lokasi
        foreach ($request->nup as $key => $item_id) {
            $detailpeminjaman = new DetailPeminjaman();
            $detailpeminjaman->id_peminjaman    = $id;
            $detailpeminjaman->id_barang        = $request->nup[$key];
            $detailpeminjaman->lokasi_awal      = $request->lokasi_awal[$key];
            $detailpeminjaman->lokasi_akhir     = $request->lokasi_akhir[$key];
            $detailpeminjaman->deskripsi        = $request->deskripsi_barang[$key];
            $detailpeminjaman->save();

            $lokasi = new Lokasi();
            $lokasi->id_barang      = $request->nup[$key];
            $lokasi->id_peminjaman  = $id;
            $lokasi->lokasi         = $request->lokasi_akhir[$key];
            $lokasi->save();
        }

        session()->flash('success', 'Berhasil Menambah Data Peminjaman');
        return redirect()->route('admin.peminjaman');
    }

    public function storeKendaraan(Request $request)
    {
        $dateRange = $request->tanggal;

        if (strpos($dateRange, ' - ') !== false) {
            list($tanggal_pinjam, $tanggal_kembali) = explode(' - ', $dateRange);
        } else {
            $tanggal_pinjam = $dateRange;
            $tanggal_kembali = $dateRange;
        }

        $tanggal_pinjam = Carbon::createFromFormat('d/m/Y', $tanggal_pinjam)->format('Y-m-d');
        $tanggal_kembali = Carbon::createFromFormat('d/m/Y', $tanggal_kembali)->format('Y-m-d');

        $peminjaman = new Peminjaman();
        $peminjaman->peminjam = $request->peminjam;
        $peminjaman->nip = $request->nip;
        $peminjaman->jabatan = $request->jabatan;
        $peminjaman->tanggal_pinjam = $tanggal_pinjam;
        $peminjaman->tanggal_kembali = $tanggal_kembali;
        $peminjaman->deskripsi = $request->deskripsi;
        $peminjaman->tipe = $request->tipe;
        $peminjaman->id_petugas = session()->get('id');
        $penandatangan = Penandatangan::find($request->id_penandatangan);
        if ($penandatangan) {
            $peminjaman->nama_penandatangan = $penandatangan->nama;
            $peminjaman->nip_penandatangan = $penandatangan->nip;
            $peminjaman->jabatan_penandatangan = $penandatangan->jabatan;
        }

        $peminjaman->save();

        $id = $peminjaman->id_peminjaman;

        // Store ke tabel Detail Peminjaman Dan Lokasi
        foreach ($request->nup as $key => $item_id) {
            $detailpeminjaman = new DetailPeminjaman();
            $detailpeminjaman->id_peminjaman    = $id;
            $detailpeminjaman->id_barang        = $request->nup[$key];
            $detailpeminjaman->lokasi_awal      = $request->lokasi_awal[$key];
            $detailpeminjaman->lokasi_akhir     = $request->lokasi_akhir[$key];
            $detailpeminjaman->save();

            $lokasi = new Lokasi();
            $lokasi->id_barang      = $request->nup[$key];
            $lokasi->id_peminjaman  = $id;
            $lokasi->lokasi         = $request->lokasi_akhir[$key];
            $lokasi->save();
        }

        session()->flash('success', 'Berhasil Menambah Data Peminjaman');
        return redirect()->route('admin.peminjaman');
    }

    public function storeLaptop(Request $request)
    {
        $dateRange = $request->tanggal;

        if (strpos($dateRange, ' - ') !== false) {
            list($tanggal_pinjam, $tanggal_kembali) = explode(' - ', $dateRange);
        } else {
            $tanggal_pinjam = $dateRange;
            $tanggal_kembali = $dateRange;
        }

        $tanggal_pinjam = Carbon::createFromFormat('d/m/Y', $tanggal_pinjam)->format('Y-m-d');
        $tanggal_kembali = Carbon::createFromFormat('d/m/Y', $tanggal_kembali)->format('Y-m-d');

        $peminjaman = new Peminjaman();
        $peminjaman->peminjam = $request->peminjam;
        $peminjaman->nip = $request->nip;
        $peminjaman->instansi = $request->instansi;
        $peminjaman->jabatan = $request->jabatan;
        $peminjaman->tanggal_pinjam = $tanggal_pinjam;
        $peminjaman->tanggal_kembali = $tanggal_kembali;
        $peminjaman->alamat = $request->alamat;
        $peminjaman->tipe = $request->tipe;
        $peminjaman->id_petugas = session()->get('id');

        $penandatangan = Penandatangan::find($request->id_penandatangan);
        if ($penandatangan) {
            $peminjaman->nama_penandatangan = $penandatangan->nama;
            $peminjaman->nip_penandatangan = $penandatangan->nip;
            $peminjaman->jabatan_penandatangan = $penandatangan->jabatan;
        }
        $peminjaman->save();

        $id = $peminjaman->id_peminjaman;

        // Store ke tabel Detail Peminjaman Dan Lokasi
        $detailpeminjaman = new DetailPeminjaman();
        $detailpeminjaman->id_peminjaman    = $id;
        $detailpeminjaman->id_barang        = $request->nup;
        $detailpeminjaman->lokasi_awal      = $request->lokasi_awal;
        $detailpeminjaman->lokasi_akhir     = $request->lokasi_akhir;
        $detailpeminjaman->deskripsi        = $request->deskripsi_barang;
        $detailpeminjaman->save();

        $lokasi = new Lokasi();
        $lokasi->id_barang      = $request->nup;
        $lokasi->id_peminjaman  = $id;
        $lokasi->lokasi         = $request->lokasi_akhir;
        $lokasi->save();

        session()->flash('success', 'Berhasil Menambah Data Peminjaman');
        return redirect()->route('admin.peminjaman');
    }

    public function create()
    {
        $data = [
            'title'     => 'Tambah Peminjaman Aset BMN',
            'nama_barang'    => Barang::select('nama_barang')->distinct()->get(),
            'penandatangan'  => Penandatangan::all(),
        ];

        return view('admin.peminjaman.tambah-bmn',$data);
    }

    public function createKendaraan()
    {
        $data = [
            'title'        => 'Tambah Peminjaman Aset Kendaraan',
            'nama_barang'  => Barang::select('merek')->whereNotNull('no_polisi')->distinct()->get(),
            'penandatangan' => Penandatangan::all(),
        ];


        return view('admin.peminjaman.tambah-kendaraan', $data);
    }

    public function createLaptop()
    {
        $data = [
            'title'     => 'Tambah Peminjaman Aset Laptop/Notebook',
            'nama_barang'    => Barang::select('nama_barang')->where('nama_barang', 'LIKE', '%Lap Top%')->orWhere('nama_barang', 'LIKE', '%Note Book%')->distinct()->get(),
            'penandatangan'  => Penandatangan::all(),
        ];

        return view('admin.peminjaman.tambah-laptop',$data);
    }

    public function status($id)
    {
        $peminjaman = Peminjaman::find($id);
        $peminjaman->status = '1';
        $update = $peminjaman->save();

        $detailpeminjaman = DetailPeminjaman::where('id_peminjaman', $id)->get();
        foreach ($detailpeminjaman as $item) {
            $lokasi = new Lokasi();
            $lokasi->id_barang      = $item->id_barang;
            $lokasi->id_peminjaman  = $item->id_peminjaman;
            $lokasi->lokasi         = $item->lokasi_awal;
            $lokasi->status         = '1';
            $lokasi->save();
        }

        if ($update) {
            session()->flash('success', 'Berhasil Mengubah Status Peminjaman');
            return redirect()->route('admin.peminjaman');
        }
    }

    public function laporan()
    {
        $data = [
            'title'     => 'Laporan Riwayat Peminjaman',
            'peminjaman' => Peminjaman::orderBy('created_at', 'desc')->get()
        ];
        return view('admin.peminjaman.laporan',$data);
    }

    public function export(){
        $name = 'Export Peminjaman '. Carbon::now()->format('d-m-Y');
        return Excel::download(new PeminjamanExport(), $name.'.xlsx');
    }

    public function show($id) {
        $data = [
            'title'     => 'Detail Peminjaman',
            'peminjaman' => Peminjaman::with(['detailPeminjaman.barang'])->where('id_peminjaman', $id)->get()
        ];

        return view('admin.peminjaman.detail',$data);
    }

    public function printPdf($id) {
        $path = public_path().'/assets/media/pupr.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);

        $data = [
            'logo' => 'data:image/'. $type . ';base64,'. base64_encode($data),
            'peminjaman' => Peminjaman::with(['detailPeminjaman.barang'])->where('id_peminjaman', $id)->get(),
        ];
        $data['petugas'] = Pengguna::where('id_pengguna', $data['peminjaman'][0]->id_petugas)->get();

        if ($data['peminjaman'][0]->tipe === "BMN") {
            $pdf = Pdf::loadView('admin.peminjaman.viewPdf',$data);
        }elseif ($data['peminjaman'][0]->tipe === "Kendaraan") {
            $pdf = Pdf::loadView('admin.peminjaman.viewPdfKendaraan',$data);
        }else{
            $pdf = Pdf::loadView('admin.peminjaman.viewPdfPeminjamanPC',$data);
        }

        return $pdf->stream();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = Peminjaman::destroy($id);
        if ($delete) {
            session()->flash('success', 'Berhasil Menghapus Data Peminjaman');
            return redirect()->route('admin.peminjaman');
        }
    }
}
