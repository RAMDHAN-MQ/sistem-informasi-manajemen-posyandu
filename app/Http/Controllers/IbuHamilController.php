<?php

namespace App\Http\Controllers;

use App\Models\IbuHamil;
use App\Models\PemeriksaanIbuHamil;
use Illuminate\Http\Request;

class IbuHamilController extends Controller
{
    public function index()
    {
        $ibuhamil = IbuHamil::latest()->get();
        return view('admin.ibu.index', compact('ibuhamil'));
    }

    public function create()
    {
        return view('admin.ibu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
        ]);

        IbuHamil::create($request->all());

        return redirect()->route('admin.ibu.index')->with('success', 'Data ibu hamil berhasil ditambahkan');
    }

    public function destroy($id)
    {
        IbuHamil::findOrFail($id)->delete();
        return redirect()->route('admin.ibu.index')->with('success', 'Data ibu hamil berhasil dihapus');
    }

    public function edit($id)
    {
        $ibuhamil = IbuHamil::findOrFail($id);
        return view('admin.ibu.edit', compact('ibuhamil'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
        ]);

        IbuHamil::findOrFail($id)->update($request->all());

        return redirect()->route('admin.ibu.index')->with('success', 'Data ibu hamil berhasil diupdate');
    }

    public function view($id)
    {
        $ibuhamil = IbuHamil::findOrFail($id);
        $pemeriksaan = PemeriksaanIbuHamil::where('ibuhamil_id', $id)->get();
        return view('admin.ibu.view', compact('ibuhamil', 'pemeriksaan'));
    }

    public function create_pemeriksaan()
    {
        $ibuhamil = IbuHamil::all();
        return view('admin.ibu.pemeriksaan', compact('ibuhamil'));
    }

    public function store_pemeriksaan(Request $request)
    {
        $request->validate([
            'ibuhamil_id' => 'required',
            'hpht' => 'required',
            'hpl' => 'required',
            'tensi' => 'required',
            'berat' => 'required',
            'pemeriksaan_darah' => 'required',
        ]);

        // Perbaikan: Menggunakan $request->hpl (bukan hpht)
        PemeriksaanIbuHamil::create([
            'ibuhamil_id'       => $request->ibuhamil_id,
            'hpht'              => $request->hpht,
            'hpl'               => $request->hpl,
            'tensi'             => $request->tensi,
            'berat'             => $request->berat,
            'pemeriksaan_darah' => $request->pemeriksaan_darah,
        ]);

        $role = auth()->user()->role;

        return redirect()->route($role . '.ibu.pemeriksaan.create')->with('success', 'Pemeriksaan berhasil disimpan');
    }
}
