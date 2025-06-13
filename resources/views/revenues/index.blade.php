@extends('layouts.app')

@section('title', 'Catatan Penghasilan')

@section('content')
<div class="container mt-4">
    <h1>Catatan Penghasilan Tahunan</h1>

    <form method="GET" action="{{ route('revenues.index') }}" class="form-inline mb-3">
        <label for="year" class="mr-2">Pilih Tahun:</label>
        <select name="year" id="year" class="form-control mr-2">
            @foreach($availableYears as $year)
                <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Tampilkan</button>
    </form>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Bulan</th>
                <th>Pendapatan Kotor (Rp)</th>
                <th>Pajak (Rp)</th>
                <th>Pendapatan Bersih (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($months as $m)
            <tr>
                <td>{{ $m['label'] }}</td>
                <td>{{ number_format($m['pendapatan_kotor'], 0, ',', '.') }}</td>
                <td>{{ number_format($m['pajak'], 0, ',', '.') }}</td>
                <td>{{ number_format($m['pendapatan_bersih'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="font-weight-bold">
                <td>Total {{ $selectedYear }}</td>
                <td>{{ number_format($total_kotor, 0, ',', '.') }}</td>
                <td>{{ number_format($total_pajak, 0, ',', '.') }}</td>
                <td>{{ number_format($total_bersih, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
