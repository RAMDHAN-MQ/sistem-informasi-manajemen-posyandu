<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use DOMDocument;
use Illuminate\Support\Facades\Storage;

function ekstrakgambarhtml($html)
{
    $gambar = [];

    if (!$html) return $gambar;

    libxml_use_internal_errors(true);

    $dom = new DOMDocument();
    $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    libxml_clear_errors();

    foreach ($dom->getElementsByTagName('img') as $img) {
        $gambar[] = $img->getAttribute('src');
    }

    return $gambar;
}

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
        $pengumuman = Pengumuman::findOrFail($id);
        $oldGambar = ekstrakgambarhtml($pengumuman->keterangan);
        $pengumuman->update([
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
        ]);
        $newGambar = ekstrakgambarhtml($request->keterangan);
        $deleteGambar = array_diff($oldGambar, $newGambar);
        foreach ($deleteGambar as $src) {
            $path = parse_url($src, PHP_URL_PATH);
            $path = str_replace('/storage/', '', $path);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diupdate.');
    }

    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $gambar = ekstrakgambarhtml($pengumuman->keterangan);
        foreach ($gambar as $src) {
            $path = parse_url($src, PHP_URL_PATH);
            $path = str_replace('/storage/', '', $path);

            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
        $pengumuman->delete();
        return redirect()->route('admin.pengumuman.index')
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

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');

            $filename = time() . '_' . $file->getClientOriginalName();

            // simpan ke storage/app/public/uploads
            $path = $file->storeAs('uploads', $filename, 'public');

            $url = asset('storage/' . $path);

            return response()->json([
                "uploaded" => true,
                "url" => $url
            ]);
        }

        return response()->json([
            "uploaded" => false,
            "error" => ["message" => "No file uploaded"]
        ], 400);
    }
}
