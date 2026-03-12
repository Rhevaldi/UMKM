@extends('frontend.layouts.app')

@section('title', 'Pembayaran')

@section('content')

    <section class="py-5 bg-light">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-6">

                    <div class="card shadow-lg border-0">

                        <div class="card-body text-center p-5">

                            <h3 class="mb-3">Instruksi Pembayaran</h3>

                            <p class="text-muted">
                                Silakan lakukan pembayaran sesuai total berikut
                            </p>

                            <hr>

                            <h2 class="text-success mb-3">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </h2>

                            <p>
                                Order Code :
                                <strong>{{ $order->order_code }}</strong>
                            </p>

                            <hr>


                        
                            <h5 class="mb-3">Scan QRIS</h5>

                            @if ($setting && $setting->qris_image)
                                <img src="{{ asset($setting->qris_image) }}" style="max-width:250px" class="mb-4">
                            @else
                                <div class="alert alert-warning">
                                    Penjual belum menyertakan QRIS untuk pembayaran.
                                  
                                </div>
                            @endif


                            <hr>


                            <h5>Transfer Bank</h5>

                            @if ($setting && $setting->bank_name && $setting->account_number)
                                <p class="mb-1">
                                    {{ $setting->bank_name }}
                                    : <strong>{{ $setting->account_number }}</strong>
                                </p>

                                <p class="mb-4">
                                    a.n {{ $setting->account_name }}
                                </p>
                            @else
                                <div class="alert alert-warning">
                                    Penjual belum menyertakan nomor rekening tujuan.
                                    Silakan hubungi admin untuk informasi pembayaran.
                                </div>
                            @endif


                            <hr>




                            <a href="{{ route('order.whatsapp', $order->id) }}" class="btn btn-success btn-lg w-100">

                                <i class="fab fa-whatsapp"></i>
                                Kirim Bukti Pembayaran

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection
