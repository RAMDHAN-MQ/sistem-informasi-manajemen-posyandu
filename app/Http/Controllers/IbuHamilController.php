<?php

namespace App\Http\Controllers;

use App\Exports\IbuHamilExport;
use App\Models\IbuHamil;
use App\Models\PemeriksaanIbuHamil;
use App\Models\Tensi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class IbuHamilController extends Controller
{
    public function index()
    {
        $ibuhamil = IbuHamil::latest()->get();
        return view('pages.ibu.index', compact('ibuhamil'));
    }

    public function create()
    {
        return view('pages.ibu.create');
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

        return redirect()->route(auth()->user()->role . '.ibu.index')->with('success', 'Data ibu hamil berhasil ditambahkan');
    }

    public function destroy($id)
    {
        IbuHamil::findOrFail($id)->delete();
        return redirect()->route(auth()->user()->role . '.ibu.index')->with('success', 'Data ibu hamil berhasil dihapus');
    }

    public function edit($id)
    {
        $ibuhamil = IbuHamil::findOrFail($id);
        return view('pages.ibu.edit', compact('ibuhamil'));
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

        return redirect()->route(auth()->user()->role . '.ibu.index')->with('success', 'Data ibu hamil berhasil diupdate');
    }

    public function view($id)
    {
        $ibuhamil = IbuHamil::findOrFail($id);
        $pemeriksaan = PemeriksaanIbuHamil::where('ibuhamil_id', $id)->latest()->first();
        $umur = Carbon::parse($ibuhamil->tgl_lahir)->age;
        $tensi = Tensi::where('ibuhamil_id', $id)->get();
        return view('pages.ibu.view', compact('ibuhamil', 'pemeriksaan', 'umur', 'tensi'));
    }

    public function create_pemeriksaan()
    {
        $ibuhamil = IbuHamil::whereNotIn('id', PemeriksaanIbuHamil::select('ibuhamil_id'))->get();
        return view('pages.ibu.pemeriksaan', compact('ibuhamil'));
    }

    public function store_pemeriksaan(Request $request)
    {
        $request->validate([
            'ibuhamil_id' => 'required',
            'hpht' => 'required|date',
            'hpl' => 'required|date',
            'berat' => 'required',
            'tensi' => 'required',
        ]);

        PemeriksaanIbuHamil::create([
            'ibuhamil_id'       => $request->ibuhamil_id,
            'hpht'              => $request->hpht,
            'hpl'               => $request->hpl,
            'berat'             => $request->berat,
            'pemeriksaan_darah' => $request->pemeriksaan_darah,
            'tanggal_pemeriksaan' => now(),
        ]);

        Tensi::create([
            'ibuhamil_id'   => $request->ibuhamil_id,
            'tensi' => $request->tensi,
            'tanggal_periksa'   => now(),
        ]);

        return redirect()->route(auth()->user()->role . '.ibu.pemeriksaan.create')->with('success', 'Pemeriksaan berhasil disimpan');
    }

    public function create_tensi()
    {
        $ibuhamil = Ibuhamil::all();
        return view('pages.ibu.tensi', compact('ibuhamil'));
    }

    public function store_tensi(Request $request)
    {
        $request->validate([
            'ibuhamil_id' => 'required',
            'tensi' => 'required',
            'tanggal_periksa' => 'required',
        ]);

        Tensi::create([
            'ibuhamil_id'   => $request->ibuhamil_id,
            'tensi' => $request->tensi,
            'tanggal_periksa'   => $request->tanggal_periksa,
        ]);

        return redirect()->route(auth()->user()->role . '.ibu.tensi.create')->with('success', 'Tensi berhasil disimpan');
    }

    public function export(Request $request)
    {
        return Excel::download(
            new IbuHamilExport(
                $request->jenis,
                $request->keterangan
            ),
            'laporan-ibu-hamil.xlsx'
        );
    }
}
