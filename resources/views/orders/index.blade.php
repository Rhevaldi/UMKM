@extends('layouts.app')

@section('title', 'Manajemen Order')

@section('content')

    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="content-header mb-3 d-flex justify-content-between align-items-center">

            <h3 class="m-0">
                <i class="fas fa-shopping-cart mr-2"></i>
                Manajemen Order
            </h3>

            <a href="{{ route('orders.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i>
                Buat Order
            </a>

        </div>



        {{-- ALERT --}}
        @if (session('success'))
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

                <h5 class="mb-0">
                    Daftar Order
                </h5>

            </div>


            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover table-striped align-middle mb-0">

                        <thead class="table-dark">

                            <tr>
                                <th width="150">Order Code</th>
                                <th>Tanggal</th>
                                <th>Customer</th>
                                <th width="180">Total</th>
                                <th width="120">Status</th>
                                <th width="220">Aksi</th>
                            </tr>

                        </thead>


                        <tbody>

                            @forelse($orders as $order)
                                <tr>

                                    {{-- CODE --}}
                                    <td>
                                        <strong>
                                            {{ $order->order_code }}
                                        </strong>
                                    </td>


                                    {{-- DATE --}}
                                    <td>

                                        {{ $order->created_at->format('d M Y') }}

                                        <br>

                                        <small class="text-muted">
                                            {{ $order->created_at->format('H:i') }}
                                        </small>

                                    </td>


                                    {{-- CUSTOMER --}}
                                    <td>

                                        {{ $order->customer->name ?? 'Customer' }}

                                    </td>


                                    {{-- TOTAL --}}
                                    <td>

                                        <strong>
                                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                        </strong>

                                    </td>


                                    {{-- STATUS --}}
                                    <td>

                                        @if ($order->status == 'paid')
                                            <span class="badge bg-success">
                                                Paid
                                            </span>
                                        @elseif($order->status == 'pending')
                                            <span class="badge bg-warning">
                                                Pending
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                Cancelled
                                            </span>
                                        @endif

                                    </td>


                                    {{-- ACTION --}}
                                    <td>


                                        {{-- VIEW --}}
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm"
                                            title="Detail">

                                            <i class="fas fa-eye"></i>

                                        </a>



                                        {{-- INVOICE --}}
                                        <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-secondary btn-sm"
                                            title="Invoice">

                                            <i class="fas fa-file-pdf"></i>

                                        </a>



                                        {{-- WHATSAPP --}}
                                        <a href="{{ route('orders.whatsapp', $order->id) }}" class="btn btn-success btn-sm"
                                            title="WhatsApp Customer">

                                            <i class="fab fa-whatsapp"></i>

                                        </a>



                                        {{-- PAYMENT --}}
                                        @if ($order->status == 'pending')
                                            <a href="{{ route('payments.create', $order->id) }}"
                                                class="btn btn-primary btn-sm" title="Pembayaran">

                                                <i class="fas fa-credit-card"></i>

                                            </a>
                                        @endif



                                        {{-- DELETE --}}
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                            class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button onclick="return confirm('Hapus order ini?')"
                                                class="btn btn-danger btn-sm" title="Hapus">

                                                <i class="fas fa-trash"></i>

                                            </button>

                                        </form>


                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="text-center text-muted py-4">

                                        <i class="fas fa-box-open fa-2x mb-2"></i>

                                        <br>

                                        Belum ada order

                                    </td>

                                </tr>
                            @endforelse


                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection
