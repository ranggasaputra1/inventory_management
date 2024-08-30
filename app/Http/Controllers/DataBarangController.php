<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use App\Models\DataRuangan;
use Illuminate\Http\Request;
use App\Models\DataPeminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class DataBarangController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $sortBy = $request->input('sort_by');
    
    // Ambil data dari database tanpa sorting
    $query = DataBarang::with('dataRuangan');
    
    if ($search) {
        $query->where('nama_barang', 'like', "%{$search}%")
            ->orWhere('kode_barang', 'like', "%{$search}%")
            ->orWhere('data_ruangan_id', 'like', "%{$search}%")
            ->orWhere('merk_barang', 'like', "%{$search}%")
            ->orWhere('jenis_barang', 'like', "%{$search}%")
            ->orWhere('satuan_barang', 'like', "%{$search}%")
            ->orWhere('status_barang', 'like', "%{$search}%");
    }

    $dataBarangs = $query->get();

    // Sorting manual dengan bubble sort
    if ($sortBy) {
        $count = $dataBarangs->count();
        for ($i = 0; $i < $count - 1; $i++) {
            for ($j = 0; $j < $count - $i - 1; $j++) {
                $current = $dataBarangs[$j];
                $next = $dataBarangs[$j + 1];

                if ($sortBy === 'newest' && $current->created_at < $next->created_at) {
                    $dataBarangs->put($j, $next);
                    $dataBarangs->put($j + 1, $current);
                } elseif ($sortBy === 'oldest' && $current->created_at > $next->created_at) {
                    $dataBarangs->put($j, $next);
                    $dataBarangs->put($j + 1, $current);
                }
            }
        }
    }

    return view('dashboard.barang.index', [
        'tittle' => 'Data Barang',
        'active_menu' => 'barang'
    ], compact('dataBarangs'));
}


    public function print($sortBy)
    {
        $query = DataBarang::with('dataRuangan');

        if ($sortBy === 'newest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sortBy === 'oldest') {
            $query->orderBy('created_at', 'asc');
        }

        $dataBarangs = $query->get();

        $pdf = Pdf::loadView('dashboard.barang.print', compact('dataBarangs'));

        return $pdf->stream('data_barang.pdf');
    }

    public function create()
    {
        $dataRuangans = DataRuangan::all();
        
        return view('dashboard.barang.create', [
            'tittle' => 'Tambah Barang',
            'active_menu' => 'barang'
        ], compact('dataRuangans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|unique:data_barangs',
            'kode_ruangan' => 'required|exists:data_ruangans,id',
            'nama_barang' => 'required',
            'merk_barang' => 'required',
            'jenis_barang' => 'required',
            'satuan_barang' => 'required',
            'foto_barang' => 'required|image|max:2048',
            'jumlah_barang' => 'required|integer',
            'kondisi_barang' => 'required',
            'status_barang' => 'required',
            'keterangan' => 'required',
        ]);

        if ($request->hasFile('foto_barang')) {
            $foto = $request->file('foto_barang')->store('public/foto_barang');
            $validated['foto_barang'] = basename($foto);
        }

        DataBarang::create([
            'kode_barang' => $validated['kode_barang'],
            'data_ruangan_id' => $validated['kode_ruangan'],
            'nama_barang' => $validated['nama_barang'],
            'merk_barang' => $validated['merk_barang'],
            'jenis_barang' => $validated['jenis_barang'],
            'satuan_barang' => $validated['satuan_barang'],
            'foto_barang' => $validated['foto_barang'],
            'jumlah_barang' => $validated['jumlah_barang'],
            'kondisi_barang' => $validated['kondisi_barang'],
            'status_barang' => $validated['status_barang'],
            'keterangan' => $validated['keterangan'],
        ]);

        return redirect()->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan!');
    }

    public function show($id)
    {
        $barang = DataBarang::findOrFail($id);
        return view('dashboard.barang.show', [
            'tittle' => 'Detail Barang',
            'active_menu' => 'barang'
        ], compact('barang'));
    }

    public function edit($id)
    {
        $barang = DataBarang::with('dataRuangan')->findOrFail($id);
        $ruangan = DataRuangan::all(); // Ambil semua data ruangan untuk dropdown
        return view('dashboard.barang.edit', [
            'tittle' => 'Edit Barang',
            'active_menu' => 'barang'
        ], compact('barang', 'ruangan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_barang' => 'required|unique:data_barangs,kode_barang,' . $id,
            'data_ruangan_id' => 'required|exists:data_ruangans,id',
            'nama_barang' => 'required',
            'merk_barang' => 'required',
            'jenis_barang' => 'required',
            'satuan_barang' => 'required',
            'foto_barang' => 'nullable|image|max:2048',
            'jumlah_barang' => 'required|integer',
            'kondisi_barang' => 'required',
            'status_barang' => 'required',
            'keterangan' => 'required',
        ]);

        $barang = DataBarang::findOrFail($id);
        $barang->kode_barang = $request->kode_barang;
        $barang->data_ruangan_id = $request->data_ruangan_id;
        $barang->nama_barang = $request->nama_barang;
        $barang->merk_barang = $request->merk_barang;
        $barang->jenis_barang = $request->jenis_barang;
        $barang->satuan_barang = $request->satuan_barang;
        $barang->jumlah_barang = $request->jumlah_barang;
        $barang->kondisi_barang = $request->kondisi_barang;
        $barang->status_barang = $request->status_barang;
        $barang->keterangan = $request->keterangan;

        if ($request->hasFile('foto_barang')) {
            if ($barang->foto_barang && Storage::exists('public/foto_barang/' . $barang->foto_barang)) {
                Storage::delete('public/foto_barang/' . $barang->foto_barang);
            }
            $file = $request->file('foto_barang');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto_barang', $filename);
            $barang->foto_barang = $filename;
        }

        $barang->save();

        return redirect()->route('barang.index')
            ->with('success', 'Data barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang = DataBarang::findOrFail($id);
        
        DataPeminjaman::where('kode_barang', $id)->update(['jumlah' => null]);

        if ($barang->foto_barang) {
            Storage::delete('public/foto_barang/' . $barang->foto_barang);
        }

        $barang->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Data barang berhasil dihapus.');
    }
}
