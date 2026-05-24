<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Balita;
use App\Models\IbuHamil;
use App\Models\Layanan;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return $this->getData('admin.dashboard');
    }

    public function dashboard_kader()
    {
        return $this->getData('kader.dashboard');
    }

    private function getData($viewName)
    {
        $jumlahBalita = Balita::count();
        $jumlahIbuHamil = IbuHamil::count();
        
        
        $kegiatanAkanDatang = Layanan::whereDate('created_at', '>=', now())->count();
        $kegiatanSelesai = Layanan::whereDate('created_at', '<', now())->count();
        
        $chartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
        $dataSehat = [110, 112, 115, 118, 120, $jumlahBalita]; 
        $dataStunting = [10, 8, 5, 5, 4, 2];

        return view($viewName, compact(
            'jumlahBalita', 
            'jumlahIbuHamil', 
            'kegiatanAkanDatang', 
            'kegiatanSelesai',
            'chartLabels',
            'dataSehat',
            'dataStunting'
        ));
    }
}