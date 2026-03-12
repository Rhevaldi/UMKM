@extends('layouts.app')

@section('title', 'Manajemen Penjualan')

@section('content')

    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-3">

            <h3 class="m-0 font-weight-bold">
                <i class="fas fa-shopping-cart text-primary mr-2"></i>
                Manajemen Penjualan
            </h3>

            <a href="{{ route('orders.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus mr-1"></i>
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
        <div class="card shadow-sm border-0">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="bg-dark text-white">

                            <tr>
                                <th width="150">Kode</th>
                                <th width="180">Tanggal</th>
                                <th>Customer</th>
                                <th width="120">Item</th>
                                <th width="180">Total</th>
                                <th width="120">Status</th>
                                <th width="220" class="text-center">Aksi</th>
                            </tr>

                        </thead>


                        <tbody>

                            @forelse($orders as $order)
                                <tr>

                                    {{-- KODE --}}
                                    <td>
                                        <strong>{{ $order->order_code }}</strong>
                                    </td>



                                    {{-- TANGGAL --}}
                                    <td>

                                        {{ $order->created_at->format('d M Y') }}

                                        <br>

                                        <small class="text-muted">
                                            {{ $order->created_at->format('H:i') }}
                                        </small>

                                    </td>



                                    {{-- CUSTOMER --}}
                                    <td>

                                        <i class="fas fa-user text-muted mr-1"></i>

                                        {{ $order->customer->name ?? '-' }}

                                    </td>



                                    {{-- ITEM --}}
                                    <td>

                                        <span class="badge badge-info px-3 py-2">

                                            {{ $order->items->count() }} Item

                                        </span>

                                    </td>



                                    {{-- TOTAL --}}
                                    <td>

                                        <strong class="text-success">

                                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}

                                        </strong>

                                    </td>



                                    {{-- STATUS --}}
                                    <td>

                                        @if ($order->status == 'paid')
                                            <span class="badge badge-success px-3 py-2">
                                                Paid
                                            </span>
                                        @elseif($order->status == 'pending')
                                            <span class="badge badge-warning px-3 py-2">
                                                Pending
                                            </span>
                                        @else
                                            <span class="badge badge-danger px-3 py-2">
                                                Cancelled
                                            </span>
                                        @endif

                                    </td>



                                    {{-- ACTION --}}
                                    <td class="text-center">

                                        <div class="btn-group btn-group-sm">

                                            {{-- DETAIL --}}
                                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info"
                                                title="Detail">

                                                <i class="fas fa-eye"></i>

                                            </a>



                                            {{-- INVOICE --}}
                                            <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-secondary"
                                                title="Invoice">

                                                <i class="fas fa-file-pdf"></i>

                                            </a>



                                            {{-- VERIFIKASI --}}
                                            @if ($order->status == 'pending')
                                                <form action="{{ route('orders.verify', $order->id) }}" method="POST"
                                                    class="d-inline">

                                                    @csrf

                                                    <button class="btn btn-success"
                                                        onclick="return confirm('Verifikasi pesanan ini?')"
                                                        title="Verifikasi">

                                                        <i class="fas fa-check"></i>

                                                    </button>

                                                </form>
                                            @endif



                                            {{-- DELETE --}}
                                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                                class="d-inline">

                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger" onclick="return confirm('Hapus order ini?')"
                                                    title="Hapus">

                                                    <i class="fas fa-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td colspan="7" class="text-center py-5">

                                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>

                                        <p class="text-muted mb-0">
                                            Belum ada penjualan
                                        </p>

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
