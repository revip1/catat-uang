@extends('layouts.app')

@section('title', 'Rekap Revenue 12 Bulan')

@section('content')
<div class="container mt-4">
    <h1>Rekap Revenue 12 Bulan Terakhir</h1>

    <table class="table table-bordered w-50">
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Penghasilan Bersih (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($revenues as $rev)
            <tr>
                <td>{{ \Carbon\Carbon::parse($rev->bulan . '-01')->format('F Y') }}</td>
                <td>{{ number_format($rev->penghasilan_bersih, 2, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="2" class="text-center">Data revenue belum tersedia</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
