<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pengumuman;
use App\Models\Edukasi; 
use Illuminate\Http\Request;
use Carbon\Carbon;

class LandingPageController extends Controller
{
    public function index()
    {
        $jadwal = Layanan::where('status', 'active')->get();

        $jadwal->map(function ($j) {
            $carbonDate = Carbon::parse($j->tanggal);
            $j->hari = $carbonDate->format('d');
            $j->bulan_tahun = $carbonDate->translatedFormat('M y');
            return $j;
        });

        $pengumuman = Pengumuman::where('status', 'active')->get();
        
        // 2. Ambil data edukasi
        $edukasi = Edukasi::latest()->get(); 

        // 3. Tambahkan 'edukasi' ke dalam compact
        return view('landing_page', compact('jadwal', 'pengumuman', 'edukasi'));
    }

    public function show($id) {
        $edukasi = \App\Models\Edukasi::findOrFail($id);
        return view('edukasi_detail', compact('edukasi'));
    }
}
