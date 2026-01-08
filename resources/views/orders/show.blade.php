@extends('layouts.app')

@section('title','Detail Order')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Detail Order {{ $order->order_code }}</h5>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary btn-sm float-right">Kembali</a>
    </div>

    <div class="card-body">
        <p><strong>Customer:</strong> {{ $order->customer->name }}</p>
        <p><strong>Tanggal:</strong> {{ $order->order_date }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

        <h6>Items:</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->price,0,',','.') }}</td>
                    <td>Rp {{ number_format($item->subtotal,0,',','.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p><strong>Total:</strong> Rp {{ number_format($order->total_amount,0,',','.') }}</p>

        @if($order->payment)
        <h6>Pembayaran:</h6>
        <p>Metode: {{ ucfirst($order->payment->payment_method) }}</p>
        <p>Status: {{ ucfirst($order->payment->payment_status) }}</p>
        @endif
    </div>
</div>
@endsection
