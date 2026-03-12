@extends('layouts.app')

@section('title', 'Edit Pengaturan Pembayaran')

@section('content')

    <div class="container-fluid">

        <div class="content-header mb-3">

            <div class="d-flex justify-content-between align-items-center">

                <h3 class="m-0">

                    <i class="fas fa-edit mr-2"></i>
                    Edit Pengaturan Pembayaran

                </h3>

                <a href="{{ route('payment.settings.index') }}" class="btn btn-secondary">

                    <i class="fas fa-arrow-left mr-1"></i>
                    Kembali

                </a>

            </div>

        </div>



        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">

                <i class="fas fa-check-circle mr-2"></i>

                {{ session('success') }}

                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>

            </div>
        @endif



        <div class="card shadow-sm">

            <div class="card-body">

                <form method="POST" action="{{ route('payment.settings.update') }}" enctype="multipart/form-data">

                    @csrf


                    <div class="row">


                        {{-- BANK --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Nama Bank</label>

                                <input type="text" name="bank_name" class="form-control"
                                    value="{{ $setting->bank_name ?? '' }}" placeholder="Contoh: BCA">

                            </div>

                        </div>



                        {{-- REKENING --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Nomor Rekening</label>

                                <input type="text" name="account_number" class="form-control"
                                    value="{{ $setting->account_number ?? '' }}" placeholder="Contoh: 1234567890">

                            </div>

                        </div>



                        {{-- PEMILIK --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Nama Pemilik Rekening</label>

                                <input type="text" name="account_name" class="form-control"
                                    value="{{ $setting->account_name ?? '' }}" placeholder="Contoh: UMKM Digital">

                            </div>

                        </div>



                        {{-- WHATSAPP --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>WhatsApp Admin</label>

                                <input type="text" name="admin_whatsapp" class="form-control"
                                    value="{{ $setting->admin_whatsapp ?? '' }}" placeholder="Contoh: 6281234567890">

                                <small class="text-muted">

                                    Nomor WhatsApp yang menerima konfirmasi pembayaran

                                </small>

                            </div>

                        </div>



                        {{-- QRIS --}}
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Upload QRIS</label>

                                <input type="file" name="qris_image" class="form-control">

                                <small class="text-muted">

                                    Upload QRIS jika ingin mengganti

                                </small>

                            </div>

                        </div>


                    </div>



                    @if (!empty($setting->qris_image))
                        <div class="mt-3">

                            <label>Preview QRIS</label>

                            <div class="border rounded p-3 text-center bg-light">

                                <img src="{{ asset($setting->qris_image) }}" style="max-width:220px">

                            </div>

                        </div>
                    @endif



                    <div class="text-right mt-4">

                        <button class="btn btn-primary">

                            <i class="fas fa-save mr-1"></i>
                            Simpan Pengaturan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
