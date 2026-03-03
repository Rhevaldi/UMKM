@extends('layouts.app')

@section('title', 'Detail Order')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Order {{ $order->order_code }}</h5>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary btn-sm">
            Kembali
        </a>
    </div>

    <div class="card-body">

        {{-- INFO ORDER --}}
        <p><strong>Customer:</strong> {{ $order->customer->name }}</p>
        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y H:i') }}</p>
        <p>
            <strong>Status:</strong> 
            <span class="badge 
                {{ $order->status == 'paid' ? 'bg-success' : 
                   ($order->status == 'pending' ? 'bg-warning' : 'bg-danger') }}">
                {{ ucfirst($order->status) }}
            </span>
        </p>

        <hr>

        {{-- ITEM LIST --}}
        <h6>Items:</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th width="80">Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h5 class="mt-3">
            Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}
        </h5>

        <hr>

        {{-- ACTION BUTTONS --}}
        <div class="mt-3">

            @if($order->status == 'pending')
                <a href="{{ route('orders.whatsapp', $order->id) }}" 
                   class="btn btn-success">
                    <i class="fab fa-whatsapp"></i> Kirim ke WhatsApp
                </a>

                <a href="{{ route('payments.create', $order->id) }}" 
                   class="btn btn-primary">
                    <i class="fas fa-credit-card"></i> Proses Pembayaran
                </a>
            @endif

            <button class="btn btn-dark" data-toggle="modal" data-target="#qrisModal">
                <i class="fas fa-qrcode"></i> Lihat QRIS
            </button>
        </div>

        {{-- PAYMENT INFO --}}
        @if ($order->payment)
            <hr>
            <h6>Pembayaran:</h6>
            <p><strong>Metode:</strong> {{ ucfirst($order->payment->payment_method) }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->payment->payment_status) }}</p>
        @endif

    </div>
</div>


{{-- MODAL QRIS --}}
<div class="modal fade" id="qrisModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content text-center p-3">
            <h6>Scan QRIS</h6>
            <img src="{{ asset('qris.png') }}" class="img-fluid">
        </div>
    </div>
</div>

@endsection