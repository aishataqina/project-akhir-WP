@extends('layouts.app')

@section('title', 'Profile')

@section('contents')
    <h1 class="mb-0">Profile</h1>
    <hr />

    <form method="POST" enctype="multipart/form-data" id="profile_setup_frm"action="{{ route('profile') }}">
        @csrf
        <div class="row">
            <div class="col-md-12 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row" id="res"></div>
                    <div class="row mt-2">

                        <div class="col-md-6">
                            <label class="labels">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="first name"
                                value="{{ auth()->user()->name }}">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Email</label>
                            <input type="text" name="email" disabled class="form-control"
                                value="{{ auth()->user()->email }}" placeholder="Email">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="Phone Number"
                                value="{{ auth()->user()->phone }}">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Address</label>
                            <input type="text" name="address" class="form-control" value="{{ auth()->user()->address }}"
                                placeholder="Address">
                        </div>
                    </div>

                    <div class="mt-5 text-center"><button id="btn"
                            class="btn bg-pink-200 hover:bg-pink-300 btn-user font-semibold hover:text-black"
                            type="submit">Save Profile</button></div>
                </div>
            </div>

        </div>

    </form>
@endsection


@if (session('success'))
    <div class = "alert alert-success" role = "alert">
        {{ session('success') }} </div>
@endif

@if (session('error'))
    <div class = "alert alert-danger" role = "alert">
        {{ session('error') }} </div>
@endif


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if (session('success'))
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @elseif (session('error'))
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif
</script>
