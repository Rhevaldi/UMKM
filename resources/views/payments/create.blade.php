@extends('layouts.app')

@section('title','Pembayaran')

@section('content')

<div class="card">
    <div class="card-header">
        <h5>Pembayaran Order {{ $order->order_code }}</h5>
    </div>

    <div class="card-body">

        <div class="mb-3">
            <strong>Customer:</strong> {{ $order->customer->name }}
        </div>

        <div class="mb-4">
            <strong>Total:</strong>
            <span class="text-success fw-bold">
                Rp {{ number_format($order->total_amount,0,',','.') }}
            </span>
        </div>

        <form action="{{ route('payments.store',$order->id) }}" method="POST">
            @csrf

            {{-- METODE PEMBAYARAN --}}
            <div class="form-group mb-3">
                <label>Metode Pembayaran</label>
                <select name="payment_method"
                        id="payment_method"
                        class="form-control"
                        required>

                    <option value="">-- Pilih --</option>
                    <option value="cash">Cash</option>
                    <option value="transfer">Transfer Bank</option>
                    <option value="qris">QRIS</option>

                </select>
            </div>

            {{-- TRANSFER BANK --}}
            <div id="bank_fields" style="display:none">

                <div class="form-group mb-3">
                    <label>Bank</label>
                    <input type="text"
                           name="bank_name"
                           class="form-control"
                           placeholder="Contoh: BCA / Mandiri">
                </div>

                <div class="form-group mb-3">
                    <label>No Rekening</label>
                    <input type="text"
                           name="account_number"
                           class="form-control"
                           placeholder="Nomor rekening">
                </div>

            </div>

            {{-- QRIS --}}
            <div id="qris_box" style="display:none" class="text-center mb-3">

                <p class="fw-bold">Scan QRIS untuk pembayaran</p>

                <img src="{{ asset('qris.jpeg') }}"
                     alt="QRIS"
                     width="220"
                     class="img-fluid mb-2">

                <div class="form-group">
                    <label>Referensi QRIS</label>
                    <input type="text"
                           name="qris_ref"
                           class="form-control"
                           placeholder="Kode transaksi QRIS">
                </div>

            </div>

            <button class="btn btn-success">
                Konfirmasi Pembayaran
            </button>

            <a href="{{ route('orders.show',$order->id) }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>

@endsection


@section('scripts')

<script>

document.getElementById('payment_method').addEventListener('change', function(){

    let method = this.value;

    let bank = document.getElementById('bank_fields');
    let qris = document.getElementById('qris_box');

    bank.style.display = 'none';
    qris.style.display = 'none';

    if(method === 'transfer'){
        bank.style.display = 'block';
    }

    if(method === 'qris'){
        qris.style.display = 'block';
    }

});

</script>

@endsection