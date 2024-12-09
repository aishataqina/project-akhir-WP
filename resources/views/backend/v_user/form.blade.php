@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $judul }}</h1>
        <form action="{{ route('cetakUser') }}" method="POST" class="user">
            @csrf
            <div class="form-group">
                <label for="tanggal_awal">Tanggal Awal</label>
                <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tanggal_akhir">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Cetak</button>
        </form>
    </div>
@endsection
