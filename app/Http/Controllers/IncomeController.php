<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $incomes = Income::all();
        
        // Ambil jenis pajak dari request (default ke 21%)
        $pph = $request->input('pph', 21);
        $tarifPajak = 0.21;

        // Tentukan tarif pajak berdasarkan jenis pph
        if ($pph == 22) {
            $tarifPajak = 0.22;
        } elseif ($pph == 23) {
            $tarifPajak = 0.23;
        }

        // Hitung pajak sesuai tarif
        $total_income = 0;
        $total_tax = 0;
        foreach ($incomes as $income) {
            $income->estimated_tax = $income->jumlah * $tarifPajak;
            $income->pph_type = $pph; // Menambahkan informasi jenis PPh
            $total_income += $income->jumlah;
            $total_tax += $income->estimated_tax;
        }

        return view('incomes.index', compact('incomes', 'pph', 'total_income', 'total_tax'));
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('incomes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string|max:255',
            'jumlah' => 'required|numeric',
        ]);

        Income::create([
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('incomes.index')->with('success', 'Penghasilan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $income = Income::findOrFail($id);
        return view('incomes.edit', compact('income'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string|max:255',
            'jumlah' => 'required|numeric',
        ]);

        $income = Income::findOrFail($id);
        $income->update([
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('incomes.index')->with('success', 'Penghasilan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $income = Income::findOrFail($id);
        $income->delete();

        return redirect()->route('incomes.index')->with('success', 'Penghasilan berhasil dihapus.');
    }
}
