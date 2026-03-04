@extends('layouts.app')

@section('title', 'Profile')

@section('content')

    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="content-header mb-4">
            <h3 class="m-0">Profile Settings</h3>
        </div>

        <div class="row">

            {{-- PROFILE CARD --}}
            <div class="col-lg-4">

                <div class="card shadow-sm">

                    <div class="card-body text-center">

                        <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('adminlte/dist/img/user2-160x160.jpg') }}"
                            class="img-circle elevation-2 mb-3" width="120" height="120" style="object-fit:cover">

                        <h4 class="mb-1">{{ auth()->user()->name }}</h4>

                        <p class="text-muted">

                            @if (auth()->user()->role == 'admin')
                                <span class="badge bg-danger">Admin</span>
                            @elseif(auth()->user()->role == 'kasir')
                                <span class="badge bg-warning">Kasir</span>
                            @else
                                <span class="badge bg-info">Owner</span>
                            @endif

                        </p>

                    </div>

                </div>

            </div>



            {{-- UPDATE PROFILE --}}
            <div class="col-lg-8">

                <div class="card shadow-sm">

                    <div class="card-header">
                        <h5 class="mb-0">Update Profile</h5>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">

                            @csrf
                            @method('PATCH')

                            {{-- NAME --}}
                            <div class="form-group mb-3">
                                <label>Nama</label>

                                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                                    class="form-control" required>

                            </div>


                            {{-- EMAIL --}}
                            <div class="form-group mb-3">

                                <label>Email</label>

                                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                                    class="form-control" required>

                            </div>


                            {{-- AVATAR --}}
                            <div class="form-group mb-3">

                                <label>Foto Profil</label>

                                <input type="file" name="avatar" class="form-control">

                            </div>


                            <button class="btn btn-primary">

                                Update Profile

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>



        {{-- PASSWORD --}}
        <div class="row mt-3">

            <div class="col-lg-6">

                <div class="card shadow-sm">

                    <div class="card-header">
                        <h5 class="mb-0">Update Password</h5>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('password.update') }}">

                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">

                                <label>Password Lama</label>

                                <input type="password" name="current_password" class="form-control" required>

                            </div>


                            <div class="form-group mb-3">

                                <label>Password Baru</label>

                                <input type="password" name="password" class="form-control" required>

                            </div>


                            <div class="form-group mb-3">

                                <label>Konfirmasi Password</label>

                                <input type="password" name="password_confirmation" class="form-control" required>

                            </div>

                            <button class="btn btn-success">

                                Update Password

                            </button>

                        </form>

                    </div>

                </div>

            </div>



            {{-- DELETE ACCOUNT --}}
            <div class="col-lg-6">

                <div class="card border-danger shadow-sm">

                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">Delete Account</h5>
                    </div>

                    <div class="card-body">

                        <p class="text-muted">

                            Menghapus akun akan menghapus semua data secara permanen.

                        </p>

                        <form method="POST" action="{{ route('profile.destroy') }}">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger" onclick="return confirm('Yakin hapus akun?')">

                                Delete Account

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
