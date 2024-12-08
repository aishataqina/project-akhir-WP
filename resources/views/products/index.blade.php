@extends('layouts.app')

@section('title', 'Home Product')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Product</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
    </div>
    <hr />
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Product Code</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($product->count() > 0)
                @foreach ($product as $rs)
                    <tr>
                        {{-- <p class="font-semibold text-blue-500">hhhxhx</p> --}}
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">
                            <img src="{{ asset('storage/' . $rs->image) }}" alt="{{ $rs->title }}"
                                style="width: 50px; height: auto;">
                        </td>
                        <td class="align-middle">{{ $rs->title }}</td>
                        <td class="align-middle">{{ 'Rp ' . number_format($rs->price, 2, ',', '.') }}</td>
                        <td class="align-middle">{{ $rs->stock }}</td>
                        <td class="align-middle">{{ $rs->product_code }}</td>
                        <td class="align-middle">{{ $rs->description }}</td>
                        <td class="align-middle">
                            <div class="btn-group flex gap-3" role="group" aria-label="Basic example">
                                <a href="{{ route('products.show', $rs->id) }}" type="button">
                                    <button class="btn btn-secondary">Detail</button></a>
                                <a href="{{ route('products.edit', $rs->id) }}" type="button">
                                    <button class="btn btn-warning">Edit</button></a></a>
                                <form action="{{ route('products.destroy', $rs->id) }}" method="POST" type="button"
                                    onsubmit="return confirm('Delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">Product not found</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    //message with sweetalert
    @if (session('success'))
        Swal.fire({
            icon: "success",
            title: "BERHASIL",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @elseif (session('error'))
        Swal.fire({
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif
</script>
