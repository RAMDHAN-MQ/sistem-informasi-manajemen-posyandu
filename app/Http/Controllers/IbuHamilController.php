<?php

namespace App\Http\Controllers;

use App\Models\IbuHamil;
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

        IbuHamil::create([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
        ]);

        return redirect()
            ->route('admin.ibu.index')
            ->with('success', 'Data ibu hamil berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $ibuhamil = IbuHamil::findOrFail($id);

        $ibuhamil->delete();

        return redirect()
            ->route('admin.ibu.index')
            ->with('success', 'Data ibu hamil berhasil dihapus');
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

        $ibuhamil = IbuHamil::findOrFail($id);

        $ibuhamil->update([
            'nama' => $request->nama,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
        ]);

        return redirect()
            ->route('admin.ibu.index')
            ->with('success', 'Data ibu hamil berhasil diupdate');
    }

    public function view($id)
    {
        $ibuhamil = IbuHamil::findOrFail($id);
        return view('admin.ibu.view', compact('ibuhamil'));
    }
}
