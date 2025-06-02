@extends('layouts.app')

@section('title', 'Daftar Penghasilan')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tembak Pajak</h1>

    <a href="{{ route('incomes.create') }}" class="btn btn-primary mb-3">Tambah Penghasilan</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Keterangan</th>
                <th>Bulan</th>
                <th>Jumlah (Rp)</th>
                <th>Estimasi Pajak (Rp)</th> {{-- Kolom ini yang diubah --}}
                <th>Penghasilan Bersih (Rp)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($incomes as $income)
            <tr>
                <td>{{ $income->id }}</td>
                <td>{{ $income->deskripsi }}</td>
                <td>{{ \Carbon\Carbon::parse($income->tanggal)->format('F Y') }}</td>
                <td>{{ number_format($income->jumlah, 0, ',', '.') }}</td>

                {{-- Estimasi Pajak beserta PPh --}}
                <td>
                    {{ number_format($income->estimated_tax, 0, ',', '.') }} 
                    @if($income->pph_type == 21)
                        (PPh 21%)
                    @elseif($income->pph_type == 22)
                        (PPh 22%)
                    @elseif($income->pph_type == 23)
                        (PPh 23%)
                    @else
                        (Tidak Diketahui)
                    @endif
                </td>

                <td>{{ number_format($income->jumlah - $income->estimated_tax, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('incomes.edit', $income->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('incomes.destroy', $income->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th colspan="2" class="text-center">Total Keseluruhan</th>
                <th>{{ number_format($total_income, 0, ',', '.') }}</th>
                <th>{{ number_format($total_tax, 0, ',', '.') }}</th>
                <th>{{ number_format($total_income - $total_tax, 0, ',', '.') }}</th>
                <th></th>
            </tr>
        </tfoot>
    </table>

</div>
@endsection
