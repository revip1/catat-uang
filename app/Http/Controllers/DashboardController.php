<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
   public function index()
    {
        $tarifPajak = 0.21; // Default PPh 21

        $monthlyIncome = Income::selectRaw('
                DATE_FORMAT(tanggal, "%Y-%m") as periode,
                DATE_FORMAT(tanggal, "%M %Y") as bulan,
                SUM(jumlah) as total_kotor,
                SUM(jumlah * ?) as total_pajak
            ', [$tarifPajak])
            ->groupBy('periode', 'bulan')
            ->orderBy('periode')
            ->get();

        // Hitung pendapatan bersih
        foreach ($monthlyIncome as $item) {
            $item->total_bersih = $item->total_kotor - $item->total_pajak;
        }

        return view('dashboard', compact('monthlyIncome'));
    }

}
