@extends('layouts.app')

@section('title', 'Edit Penghasilan')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Penghasilan</h1>

    <form action="{{ route('incomes.update', $income->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $income->tanggal->format('Y-m-d') }}" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ $income->deskripsi }}" required>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah (Rp)</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $income->jumlah }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Pilih Jenis PPh:</label><br>

            @foreach([21 => 'PPh 21 (21%)', 22 => 'PPh 22 (22%)', 23 => 'PPh 23 (23%)'] as $value => $label)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pph" id="pph{{ $value }}" value="{{ $value }}" {{ $income->pph_type == $value ? 'checked' : '' }}>
                    <label class="form-check-label" for="pph{{ $value }}">{{ $label }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('incomes.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
