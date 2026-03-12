@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')

    <div class="container-fluid">

        <div class="card shadow-sm">

            <div class="card-header d-flex justify-content-between">

                <h5 class="mb-0">
                    Detail Penjualan {{ $order->order_code }}
                </h5>

                <a href="{{ route('orders.index') }}" class="btn btn-secondary btn-sm">
                    Kembali
                </a>

            </div>

            <div class="card-body">

                <p>
                    <strong>Customer :</strong>
                    {{ $order->customer->name }}
                </p>

                <p>
                    <strong>Tanggal :</strong>
                    {{ $order->created_at->format('d M Y H:i') }}
                </p>

                <p>
                    <strong>Status :</strong>

                    @if ($order->status == 'paid')
                        <span class="badge badge-success">Paid</span>
                    @else
                        <span class="badge badge-warning">Pending</span>
                    @endif

                </p>

                <hr>

                <h6>Daftar Produk</h6>

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

                        @foreach ($order->items as $item)
                            <tr>

                                <td>{{ $item->product->name }}</td>

                                <td>{{ $item->quantity }}</td>

                                <td>
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

                <h5 class="text-right mt-3">

                    Total :

                    <span class="text-success">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </span>

                </h5>

            </div>

        </div>

    </div>

@endsection
