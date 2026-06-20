<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::all();
        return view('pages.pengumuman.index', compact('pengumuman'));
    }

    public function create()
    {
        return view('pages.pengumuman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'keterangan' => 'required',
        ]);

        Pengumuman::create([
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
            'status' => 'active',
        ]);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('pages.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'keterangan' => 'required',
        ]);

        $pengumuman = Pengumuman::findOrFail($id);

        $pengumuman->update([
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Pengumuman::findOrFail($id)->delete();
        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }

    public function change_status(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $pengumuman->status = $request->status;
        $pengumuman->save();

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diubah'
        ]);
    }
}
