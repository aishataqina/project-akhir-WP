@extends('layouts.app')

@section('title', 'Dashboard - Laravel Admin Panel With Login and Registration')

@section('contents')
    <div class="row">
        <div class="col-md-12">
            <h3>Dashboard</h3>
            <p>Jumlah Produk: {{ $productCount }}</p>
        </div>
    </div>
@endsection
