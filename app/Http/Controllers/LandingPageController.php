<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
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

        return view('landing_page', compact('jadwal'));
    }
}
