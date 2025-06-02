@extends('layouts.app')

@section('title', 'Revenue Bulanan')

@section('content')
<div class="container mt-4">
    <h1>Revenue Bulanan</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="d-flex mb-3">
        <form method="GET" action="{{ route('revenues.index') }}" class="form-inline mr-3">
            <label for="bulan" class="mr-2">Pilih Bulan:</label>
            <input type="month" id="bulan" name="bulan" value="{{ $bulan }}" class="form-control mr-2">
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <form method="POST" action="{{ route('revenues.generate') }}">
            @csrf
            <input type="hidden" name="bulan" value="{{ $bulan }}">
            <button type="submit" class="btn btn-success align-self-center">Generate Revenue Bulanan</button>
        </form>
    </div>

    <h4>Hasil Revenue Bulan: {{ \Carbon\Carbon::parse($bulan . '-01')->format('F Y') }}</h4>

    <table class="table table-bordered w-50">
        <thead>
            <tr>
                <th>Penghasilan Bersih (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ number_format($revenue->penghasilan_bersih ?? $penghasilan_bersih ?? 0, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
