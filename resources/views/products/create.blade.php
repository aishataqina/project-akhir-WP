@extends('layouts.app')

@section('title', 'Create Product')

@section('contents')
    <h1 class="mb-0">Add Product</h1>
    <hr />
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <label class="font-weight-bold">IMAGE</label>
            <input type="file" class="form-control pb-5 @error('image') is-invalid @enderror" name="image">

            <!-- error message untuk image -->
            @error('image')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="row mb-3">
            <div class="col">
                <label class="font-weight-bold">PRODUCT NAME</label>
                <input type="text" name="title" class="form-control" placeholder="Title">
            </div>
            <div class="col">
                <label class="font-weight-bold">PRICE</label>
                <input type="text" name="price" class="form-control" placeholder="Price">
            </div>
            <div class="col">
                <label class="font-weight-bold">STOCK</label>
                <input type="text" name="stock" class="form-control" placeholder="Stock">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label class="font-weight-bold">PRODUCT CODE</label>
                <input type="text" name="product_code" class="form-control" placeholder="Product Code">
            </div>
            <div class="col">
                <label class="font-weight-bold">DESCRIPTION</label>
                <textarea class="form-control" name="description" placeholder="Description"></textarea>
            </div>
        </div>

        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
