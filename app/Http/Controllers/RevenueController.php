<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Income;
use App\Models\Revenue;
use Illuminate\Http\Request;

class RevenueController extends Controller
{


   public function index(Request $request)
    {
        $tarifPajak = 0.21;
        $selectedYear = $request->input('year', now()->year);

        $months = collect();
        $total_kotor = 0;
        $total_pajak = 0;
        $total_bersih = 0;

        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::createFromDate($selectedYear, $month, 1);
            $label = $date->format('F Y');

            $incomes = Income::whereYear('tanggal', $selectedYear)
                            ->whereMonth('tanggal', $month)
                            ->get();

            $kotor = $incomes->sum('jumlah');
            $pajak = $incomes->sum(fn($inc) => $inc->jumlah * match($inc->pph_type) {
                22 => 0.22, 23 => 0.23, default => 0.21
            });
            $bersih = $kotor - $pajak;

            $months->push([
                'label' => $label,
                'pendapatan_kotor' => $kotor,
                'pajak' => $pajak,
                'pendapatan_bersih' => $bersih,
            ]);

            $total_kotor += $kotor;
            $total_pajak += $pajak;
            $total_bersih += $bersih;
        }

        $availableYears = Income::selectRaw('YEAR(tanggal) as year')
                                ->distinct()
                                ->orderByDesc('year')
                                ->pluck('year');

        return view('revenues.index', compact('months', 'selectedYear', 'availableYears', 'total_kotor', 'total_pajak', 'total_bersih'));
    }


}
