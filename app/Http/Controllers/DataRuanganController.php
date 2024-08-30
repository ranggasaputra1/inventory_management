<?php

namespace App\Http\Controllers;

use App\Models\DataRuangan;
use Illuminate\Http\Request;
use App\Models\DataPeminjaman;
use Barryvdh\DomPDF\Facade\Pdf;

class DataRuanganController extends Controller
{
    public function index(Request $request)
    {
        $query = DataRuangan::query();
    
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('kode_ruangan', 'LIKE', "%{$search}%")
                ->orWhere('nama_ruangan', 'LIKE', "%{$search}%")
                ->orWhere('kondisi_ruangan', 'LIKE', "%{$search}%")
                ->orWhere('keterangan', 'LIKE', "%{$search}%");
        }
    
        $dataRuangans = $query->get();
    
        // Sorting manual dengan bubble sort
        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by');
    
            $count = $dataRuangans->count();
            for ($i = 0; $i < $count - 1; $i++) {
                for ($j = 0; $j < $count - $i - 1; $j++) {
                    $current = $dataRuangans[$j];
                    $next = $dataRuangans[$j + 1];
    
                    if ($sortBy === 'newest' && $current->created_at < $next->created_at) {
                        $dataRuangans->put($j, $next);
                        $dataRuangans->put($j + 1, $current);
                    } elseif ($sortBy === 'oldest' && $current->created_at > $next->created_at) {
                        $dataRuangans->put($j, $next);
                        $dataRuangans->put($j + 1, $current);
                    }
                }
            }
        }
    
        return view('dashboard.ruangan.index', [
            'tittle' => 'Daftar Ruangan',
            'active_menu' => 'ruangan'
        ], compact('dataRuangans'));
    }
    

    public function create()
    {
        return view('dashboard.ruangan.create', [
            'tittle' => 'Tambah Ruangan',
            'active_menu' => 'ruangan'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_ruangan' => 'required|string|max:255|unique:data_ruangans',
            'nama_ruangan' => 'required|string|max:255',
            'kondisi_ruangan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        DataRuangan::create([
            'kode_ruangan' => $request->kode_ruangan,
            'nama_ruangan' => $request->nama_ruangan,
            'kondisi_ruangan' => $request->kondisi_ruangan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('ruangan.index')
            ->with('success', 'Data Ruangan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $ruangan = DataRuangan::findOrFail($id);
        return view('dashboard.ruangan.show', [
            'tittle' => 'Detail Ruangan',
            'active_menu' => 'ruangan'
        ], compact('ruangan'));
    }

    public function edit($id)
    {
        $ruangan = DataRuangan::findOrFail($id);
        return view('dashboard.ruangan.edit', [
            'tittle' => 'Edit Ruangan',
            'active_menu' => 'ruangan'
        ], compact('ruangan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_ruangan' => 'required|string|max:255',
            'nama_ruangan' => 'required|string|max:255',
            'kondisi_ruangan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $ruangan = DataRuangan::findOrFail($id);
        $ruangan->update($request->all());

        return redirect()->route('ruangan.index')
            ->with('success', 'Data ruangan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ruangan = DataRuangan::findOrFail($id);

        DataPeminjaman::where('kode_ruangan', $ruangan->id)
            ->update(['kode_ruangan' => null]);

        $ruangan->delete();

        return redirect()->route('ruangan.index')
            ->with('success', 'Data ruangan berhasil dihapus');
    }

    public function print(Request $request, $sort_by)
    {
        $query = DataRuangan::query();

        if ($sort_by === 'newest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort_by === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $dataRuangans = $query->get();

        $pdf = Pdf::loadView('dashboard.ruangan.print', compact('dataRuangans'));
        return $pdf->stream('ruangan.pdf');
    }
}
