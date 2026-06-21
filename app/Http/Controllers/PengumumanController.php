<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use DOMDocument;

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
        $oldGambar = $this->ekstrakgambarhtml($pengumuman->keterangan);
        $pengumuman->update([
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
        ]);
        $newGambar = $this->ekstrakgambarhtml($request->keterangan);
        $normalize = function ($url) {
            return parse_url($url, PHP_URL_PATH);
        };

        $oldGambar = array_map($normalize, $oldGambar);
        $newGambar = array_map($normalize, $newGambar);

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
        $gambar = $this->ekstrakgambarhtml($pengumuman->keterangan);
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
        if (!$request->hasFile('upload')) {
            return response()->json(['uploaded' => false], 400);
        }
        $file = $request->file('upload');
        $filename = time() . '.webp';
        $path = 'uploads/' . $filename;
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file)
            ->resize(null, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->toWebp(75);
        Storage::disk('public')->put($path, $image);
        return response()->json([
            "uploaded" => true,
            "url" => asset('storage/' . $path)
        ]);
    }

    private function ekstrakgambarhtml($html)
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
}
