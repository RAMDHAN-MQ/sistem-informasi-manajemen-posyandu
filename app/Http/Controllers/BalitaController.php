<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\PemeriksaanBalita;
use Illuminate\Http\Request;

class BalitaController extends Controller
{
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

        Balita::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'nama_ortu' => $request->nama_ortu,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
        ]);

        return redirect()
            ->route('admin.balita.index')
            ->with('success', 'Data balita berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $balita = Balita::findOrFail($id);

        $balita->delete();

        return redirect()
            ->route('admin.balita.index')
            ->with('success', 'Data balita berhasil dihapus');
    }

    public function edit($id)
    {
        $balita = Balita::findOrFail($id);
        return view('admin.balita.edit', compact('balita'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'nama_ortu' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
        ]);

        $balita = Balita::findOrFail($id);

        $balita->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'nama_ortu' => $request->nama_ortu,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
        ]);

        return redirect()
            ->route('admin.balita.index')
            ->with('success', 'Data balita berhasil diupdate');
    }

    public function view($id)
    {
        $balita = Balita::findOrFail($id);
        $pemeriksaan = PemeriksaanBalita::where('balita_id', $id)->get();
        return view('admin.balita.view', compact('balita', 'pemeriksaan'));
    }

    public function create_pemeriksaan()
    {
        $balita = Balita::all(); 
        
        return view('admin.balita.pemeriksaan', compact('balita'));
    }

    public function store_pemeriksaan(Request $request)
    {
        $request->validate([
            'balita_id' => 'required',
            'berat' => 'required',
            'tinggi' => 'required',
        ]);

        PemeriksaanBalita::create([
            'balita_id' => $request->balita_id,
            'berat' => $request->berat,
            'tinggi' => $request->tinggi,
            'riwayat_kesehatan' => $request->riwayat_kesehatan,
        ]);

        return redirect()->route('admin.balita.pemeriksaan.create')->with('success', 'Pemeriksaan berhasil disimpan');
    }
}
