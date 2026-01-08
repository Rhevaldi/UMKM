@extends('layouts.app')

@section('title','Daftar Order')

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('orders.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Buat Order
        </a>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Kode Order</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->order_code }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>Rp {{ number_format($order->total_amount,0,',','.') }}</td>
                    <td>
                        <span class="badge 
                            {{ $order->status=='paid' ? 'bg-success' : ($order->status=='pending' ? 'bg-warning':'bg-danger') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('orders.show',$order->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        @if($order->status=='pending')
                        <a href="{{ route('payments.create',$order->id) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-credit-card"></i> Bayar
                        </a>
                        @endif
                        <form action="{{ route('orders.destroy',$order->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Hapus order?')" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
