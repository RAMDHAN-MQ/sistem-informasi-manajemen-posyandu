<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\PemeriksaanBalita;
use Illuminate\Http\Request;

class BalitaController extends Controller
{
    // --- FUNGSI DASAR ---
    public function index()
    {
        $balita = Balita::latest()->get();
        return view('admin.balita.index', compact('balita'));
    }

    public function create()
    {
        return view('admin.balita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'nama_ortu' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
        ]);

        Balita::create($request->all());
        return redirect()->route('admin.balita.index')->with('success', 'Data balita berhasil ditambahkan');
    }

    public function destroy($id)
    {
        Balita::findOrFail($id)->delete();
        return redirect()->route('admin.balita.index')->with('success', 'Data balita berhasil dihapus');
    }

    public function edit($id)
    {
        $balita = Balita::findOrFail($id);
        return view('admin.balita.edit', compact('balita'));
    }

    public function update(Request $request, $id)
    {
        Balita::findOrFail($id)->update($request->all());
        return redirect()->route('admin.balita.index')->with('success', 'Data balita berhasil diupdate');
    }

    public function view($id)
    {
        $balita = Balita::findOrFail($id);
        $pemeriksaan = PemeriksaanBalita::where('balita_id', $id)->get();
        return view('admin.balita.view', compact('balita', 'pemeriksaan'));
    }

    // --- FUNGSI PEMERIKSAAN ---
    public function create_pemeriksaan()
    {
        $balita = Balita::all();
        return view('admin.balita.pemeriksaan', compact('balita'));
    }

    public function store_pemeriksaan(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'balita_id' => 'required',
            'berat' => 'required',
            'tinggi' => 'required',
            'tanggal_pemeriksaan' => 'required',
        ]);

        // 2. Mengolah Checklist Imunisasi (Menghindari error NULL)
        $imunisasiData = $request->has('imunisasi')
            ? implode(', ', $request->imunisasi)
            : 'Tidak ada';

        // 3. Simpan ke Database
        PemeriksaanBalita::create([
            'balita_id'           => $request->balita_id,
            'berat'               => $request->berat,
            'tinggi'              => $request->tinggi,
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'riwayat_kesehatan'   => $imunisasiData,
        ]);

        // 4. Redirect dengan pesan sukses
        $role = auth()->user()->role;

        return redirect()->route($role.'.balita.pemeriksaan.create')
            ->with('success', 'Pemeriksaan berhasil disimpan!');
    }
}
