@extends('layouts.app')

@section('title','Pengaturan Pembayaran')

@section('content')

<div class="container-fluid">

    {{-- PAGE HEADER --}}
    <div class="content-header mb-3">
        <div class="d-flex justify-content-between align-items-center">

            <h3 class="m-0">
                <i class="fas fa-credit-card mr-2"></i>
                Pengaturan Pembayaran
            </h3>

        </div>
    </div>



    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>

    @endif



    {{-- CARD --}}
    <div class="card shadow-sm">

        <div class="card-header">

            <h5 class="card-title mb-0">
                Informasi Pembayaran
            </h5>

        </div>


        <form method="POST"
              action="{{ route('payment.settings.update') }}"
              enctype="multipart/form-data">

            @csrf

            <div class="card-body">

                <div class="row">


                    {{-- BANK --}}
                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Nama Bank
                            </label>

                            <input type="text"
                                   name="bank_name"
                                   class="form-control"
                                   placeholder="Contoh : BCA"
                                   value="{{ $setting->bank_name ?? '' }}">

                        </div>

                    </div>



                    {{-- NO REKENING --}}
                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Nomor Rekening
                            </label>

                            <input type="text"
                                   name="account_number"
                                   class="form-control"
                                   placeholder="Contoh : 1234567890"
                                   value="{{ $setting->account_number ?? '' }}">

                        </div>

                    </div>



                    {{-- NAMA PEMILIK --}}
                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Nama Pemilik Rekening
                            </label>

                            <input type="text"
                                   name="account_name"
                                   class="form-control"
                                   placeholder="Contoh : UMKM Digital"
                                   value="{{ $setting->account_name ?? '' }}">

                        </div>

                    </div>



                    {{-- QRIS --}}
                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Upload QRIS
                            </label>

                            <input type="file"
                                   name="qris_image"
                                   class="form-control">

                            <small class="text-muted">
                                Upload QRIS terbaru jika ingin mengganti
                            </small>

                        </div>

                    </div>

                </div>



                {{-- PREVIEW QRIS --}}
                @if(!empty($setting->qris_image))

                <div class="mt-3">

                    <label class="mb-2">
                        Preview QRIS
                    </label>

                    <div class="border rounded p-3 text-center bg-light">

                        <img src="{{ asset($setting->qris_image) }}"
                             style="max-width:220px">

                    </div>

                </div>

                @endif


            </div>



            {{-- FOOTER --}}
            <div class="card-footer text-right">

                <button class="btn btn-primary">

                    <i class="fas fa-save mr-1"></i>
                    Simpan Pengaturan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection