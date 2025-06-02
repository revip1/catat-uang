<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Revenue;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan', date('Y-m'));

        $incomes = Income::whereYear('tanggal', substr($bulan, 0, 4))
                         ->whereMonth('tanggal', substr($bulan, 5, 2))
                         ->get();

        $tarifPajak = 0.21;

        $total_pendapatan = $incomes->sum('jumlah');
        $total_pajak = $incomes->sum(fn($inc) => $inc->jumlah * $tarifPajak);
        $penghasilan_bersih = $total_pendapatan - $total_pajak;

        $revenue = Revenue::where('bulan', $bulan)->first();

        return view('revenues.index', compact('bulan', 'penghasilan_bersih', 'revenue'));
    }

    public function generateMonthlyRevenue(Request $request)
    {
        $bulan = $request->input('bulan');

        if (!$bulan) {
            return redirect()->back()->with('error', 'Pilih bulan terlebih dahulu.');
        }

        $incomes = Income::whereYear('tanggal', substr($bulan, 0, 4))
                         ->whereMonth('tanggal', substr($bulan, 5, 2))
                         ->get();

        if ($incomes->isEmpty()) {
            return redirect()->back()->with('error', "Tidak ada data income untuk bulan $bulan");
        }

        $tarifPajak = 0.21;
        $total_pendapatan = $incomes->sum('jumlah');
        $total_pajak = $incomes->sum(fn($inc) => $inc->jumlah * $tarifPajak);
        $penghasilan_bersih = $total_pendapatan - $total_pajak;

        Revenue::updateOrCreate(
            ['bulan' => $bulan],
            ['penghasilan_bersih' => $penghasilan_bersih]
        );

        return redirect()->back()->with('success', "Revenue bulan $bulan berhasil digenerate.");
    }

    public function annualReport()
    {
        $startMonth = now()->subMonths(11)->format('Y-m');

        $revenues = Revenue::where('bulan', '>=', $startMonth)
                           ->orderBy('bulan')
                           ->get();

        return view('revenues.annual_simple', compact('revenues'));
    }
}
