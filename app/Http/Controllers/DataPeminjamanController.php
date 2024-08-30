<?php

namespace App\Http\Controllers;

use App\Models\DataPeminjaman;
use App\Models\DataBarang;
use App\Models\DataRuangan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DataPeminjamanController extends Controller
{
    public function index(Request $request)
{
    $query = DataPeminjaman::query();

    // Handle search
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('nama_peminjam', 'LIKE', "%{$search}%")
              ->orWhere('status', 'LIKE', "%{$search}%")
              ->orWhere('kode_barang', 'LIKE', "%{$search}%")
              ->orWhere('kode_ruangan', 'LIKE', "%{$search}%")
              ->orWhere('jumlah', 'LIKE', "%{$search}%");
    }
    $dataPeminjaman = $query->get();

    // Sorting manual menggunakan bubble sort
    if ($request->has('sort_by')) {
        $sortBy = $request->input('sort_by');
        $count = $dataPeminjaman->count();
        
        for ($i = 0; $i < $count - 1; $i++) {
            for ($j = 0; $j < $count - $i - 1; $j++) {
                $current = $dataPeminjaman[$j];
                $next = $dataPeminjaman[$j + 1];

                if ($sortBy === 'newest' && $current->created_at < $next->created_at) {
                    $dataPeminjaman[$j] = $next;
                    $dataPeminjaman[$j + 1] = $current;
                } elseif ($sortBy === 'oldest' && $current->created_at > $next->created_at) {
                    $dataPeminjaman[$j] = $next;
                    $dataPeminjaman[$j + 1] = $current;
                }
            }
        }
    } else {
        $count = $dataPeminjaman->count();
        
        for ($i = 0; $i < $count - 1; $i++) {
            for ($j = 0; $j < $count - $i - 1; $j++) {
                $current = $dataPeminjaman[$j];
                $next = $dataPeminjaman[$j + 1];

                if ($current->created_at > $next->created_at) {
                    $dataPeminjaman[$j] = $next;
                    $dataPeminjaman[$j + 1] = $current;
                }
            }
        }
    }

    return view('dashboard.peminjaman.index', [
        "tittle" => "Daftar Peminjaman",
        "active_menu" => "peminjaman",
        'dataPeminjaman' => $dataPeminjaman
    ]);
}


    public function create()
    {
        // Mengambil data dari tabel data_barangs dan data_ruangans
        $dataBarangs = DataBarang::all();
        $dataRuangan = DataRuangan::all();

        return view('dashboard.peminjaman.create', [
            "tittle" => "Tambah Peminjaman",
            "active_menu" => "peminjaman",
            'dataBarangs' => $dataBarangs,
            'dataRuangan' => $dataRuangan
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'tgl_peminjaman' => 'required|date',
            'tgl_pengembalian' => 'required|date',
            'nama_peminjam' => 'required|string',
            'kode_barang' => 'required|exists:data_barangs,id',
            'kode_ruangan' => 'required|exists:data_ruangans,id',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required|string'
        ]);

        // Dapatkan data barang berdasarkan kode_barang
        $barang = DataBarang::findOrFail($request->input('kode_barang'));

        if ($barang->jumlah_barang < $request->input('jumlah')) {
            return redirect()->back()->withErrors(['jumlah' => 'Jumlah barang yang akan dipinjam melebihi stok yang tersedia.']);
        }

        // Kurangi jumlah barang
        $barang->jumlah_barang -= $request->input('jumlah');
        $barang->save();

        // Simpan data peminjaman
        DataPeminjaman::create([
            'tgl_peminjaman' => $request->input('tgl_peminjaman'),
            'tgl_pengembalian' => $request->input('tgl_pengembalian'),
            'nama_peminjam' => $request->input('nama_peminjam'),
            'kode_barang' => $request->input('kode_barang'),
            'kode_ruangan' => $request->input('kode_ruangan'),
            'jumlah' => $request->input('jumlah'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('peminjaman.index')
                         ->with('success', 'Data Peminjaman berhasil ditambahkan dan Jumlah Barang Berhasil Diperbarui.');
    }

    public function show(DataPeminjaman $id)
    {
        return view('dashboard.peminjaman.show', [
            'tittle' => 'Detail Peminjaman',
            'active_menu' => 'peminjaman',
            'peminjaman' => $id
        ]);
    }

    public function edit($id)
    {
        $peminjaman = DataPeminjaman::findOrFail($id);
        $dataBarangs = DataBarang::all();
        $dataRuangan = DataRuangan::all();

        return view('dashboard.peminjaman.edit', [
            'tittle' => 'Edit Peminjaman',
            'active_menu' => 'peminjaman',
            'peminjaman' => $peminjaman,
            'dataBarangs' => $dataBarangs,
            'dataRuangan' => $dataRuangan
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'tgl_peminjaman' => 'required|date',
            'tgl_pengembalian' => 'required|date',
            'nama_peminjam' => 'required|string|max:255',
            'kode_barang' => 'required|exists:data_barangs,id',
            'kode_ruangan' => 'required|exists:data_ruangans,id',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required|string|max:255',
        ]);

        $peminjaman = DataPeminjaman::findOrFail($id);
        $barang = DataBarang::findOrFail($request->input('kode_barang'));

        // Hitung selisih jumlah
        $selisihJumlah = $request->input('jumlah') - $peminjaman->jumlah;

        // Cek jika selisih positif (penambahan jumlah peminjaman)
        if ($selisihJumlah > 0) {
            // Jika stok tidak mencukupi
            if ($barang->jumlah_barang < $selisihJumlah) {
                return redirect()->back()->withErrors(['jumlah' => 'Jumlah Barang yang akan dipinjam melebihi stok yang tersedia!']);
            }
            $barang->jumlah_barang -= $selisihJumlah;
        } 
        // Jika selisih negatif (pengurangan jumlah peminjaman)
        elseif ($selisihJumlah < 0) {
            $barang->jumlah_barang += abs($selisihJumlah);
        }

        // Simpan perubahan stok barang
        $barang->save();

        // Update data peminjaman
        $peminjaman->tgl_peminjaman = $request->input('tgl_peminjaman');
        $peminjaman->tgl_pengembalian = $request->input('tgl_pengembalian');
        $peminjaman->nama_peminjam = $request->input('nama_peminjam');
        $peminjaman->kode_barang = $request->input('kode_barang');
        $peminjaman->kode_ruangan = $request->input('kode_ruangan');
        $peminjaman->jumlah = $request->input('jumlah');
        $peminjaman->status = $request->input('status');
        $peminjaman->save();

        // Jika status peminjaman 'Dikembalikan'
        if ($request->input('status') === 'Dikembalikan') {
            // Tambahkan kembali jumlah barang yang dikembalikan
            $barang->jumlah_barang += $peminjaman->jumlah;
            $barang->save();

            // Hapus data peminjaman dari daftar aktif
            $peminjaman->delete();

            return redirect()->route('peminjaman.index')
                             ->with('success', 'Data peminjaman berhasil diperbarui, jumlah barang berhasil dikembalikan, dan data disimpan ke riwayat.');
        }

        return redirect()->route('peminjaman.index')
                         ->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function print(Request $request, $sort_by)
    {
        $query = DataPeminjaman::query();

        // Handle sorting
        if ($sort_by === 'newest') {
            $query->orderBy('tgl_peminjaman', 'desc');
        } elseif ($sort_by === 'oldest') {
            $query->orderBy('tgl_peminjaman', 'asc');
        } else {
            $query->orderBy('tgl_peminjaman', 'desc');
        }

        $dataPeminjamen = $query->with(['dataBarang', 'dataRuangan'])->get(); // Include relationships

        $pdf = Pdf::loadView('dashboard.peminjaman.print', compact('dataPeminjamen'));
        return $pdf->stream('peminjaman.pdf');
    }

    public function history()
    {
        // Mengambil data yang telah dihapus
        $dataHistories = DataPeminjaman::onlyTrashed()->get();
        return view('dashboard.peminjaman.history', [
            "tittle" => "Daftar Peminjaman",
            "active_menu" => "peminjaman",
            'dataHistories' => $dataHistories
        ]);
    }

    public function destroy($id)
    {
        try {
            $dataPeminjaman = DataPeminjaman::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('peminjaman.index')
                             ->with('error', 'Data Peminjaman tidak ditemukan.');
        }

        $barang = DataBarang::find($dataPeminjaman->kode_barang);
        if ($barang) {
            $barang->jumlah_barang += $dataPeminjaman->jumlah;
            $barang->save();
        }

        $dataPeminjaman->forceDelete();

        return redirect()->route('peminjaman.index')
                         ->with('success', 'Data Peminjaman berhasil dihapus dan jumlah barang berhasil diperbarui.');
    }

    public function printHistory(Request $request, $sort_by)
    {
        $query = DataPeminjaman::onlyTrashed();
    
        // Handle sorting
        if ($sort_by === 'newest') {
            $query->orderBy('deleted_at', 'desc');
        } elseif ($sort_by === 'oldest') {
            $query->orderBy('deleted_at', 'asc');
        }
    
        $dataHistories = $query->with(['dataBarang', 'dataRuangan'])->get();
    
        $pdf = Pdf::loadView('dashboard.peminjaman.history_print', compact('dataHistories'));
        return $pdf->stream('history_peminjaman.pdf');
    }
}
