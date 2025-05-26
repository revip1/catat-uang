@extends('layouts.app')

@section('title', 'Daftar Penghasilan')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Daftar Penghasilan</h1>

    <a href="{{ route('incomes.create') }}" class="btn btn-primary mb-3">Tambah Penghasilan</a>

    <table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Keterangan</th>
            <th>Jumlah (Rp)</th>
            <th>Perkiraan Pajak (Rp)</th> <!-- Kolom baru -->
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($incomes as $income)
        <tr>
            <td>{{ $income->id }}</td>
            <td>{{ $income->deskripsi }}</td>
            <td>{{ number_format($income->jumlah, 0, ',', '.') }}</td>
            <td>{{ number_format($income->estimated_tax, 0, ',', '.') }}</td> <!-- Pajak dinamis -->
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
</table>

</div>
@endsection
