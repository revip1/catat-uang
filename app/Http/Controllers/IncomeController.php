<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incomes = Income::all();

        $total_income = 0;
        $total_tax = 0;

        foreach ($incomes as $income) {
            $tarif = match((int)$income->pph_type) {
                22 => 0.22,
                23 => 0.23,
                default => 0.21
            };

            $income->estimated_tax = $income->jumlah * $tarif;
            $total_income += $income->jumlah;
            $total_tax += $income->estimated_tax;
        }

        return view('incomes.index', compact('incomes', 'total_income', 'total_tax'));
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
            'pph' => 'required|in:21,22,23',
        ]);

        Income::create([
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'pph_type' => $request->pph,
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
            'pph' => 'required|in:21,22,23',
        ]);

        $income = Income::findOrFail($id);
        $income->update([
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'pph_type' => $request->pph,
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
