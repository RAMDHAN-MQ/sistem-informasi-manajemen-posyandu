<?php

namespace App\Http\Controllers;

use App\Models\Balita;
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
        return view('admin.balita.view', compact('balita'));
    }
}
