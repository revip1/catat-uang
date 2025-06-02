@extends('layouts.app')

@section('title', 'Tambah Penghasilan')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah Penghasilan</h1>

    <form action="{{ route('incomes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah (Rp)</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
        </div>

        {{-- Pilihan jenis PPh dengan radio button --}}
        <div class="mb-3">
            <label class="form-label">Pilih Jenis PPh:</label><br>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="pph" id="pph21" value="21" checked>
                <label class="form-check-label" for="pph21">PPh 21 (21%)</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="pph" id="pph22" value="22">
                <label class="form-check-label" for="pph22">PPh 22 (22%)</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="pph" id="pph23" value="23">
                <label class="form-check-label" for="pph23">PPh 23 (23%)</label>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('incomes.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
