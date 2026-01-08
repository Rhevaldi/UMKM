@extends('layouts.app')

@section('title','Buat Order')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Buat Order Baru</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Customer</label>
                <select name="customer_id" class="form-control" required>
                    <option value="">-- Pilih Customer --</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            <hr>
            <h6>Produk</h6>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>
                            <input type="checkbox" name="products[]" value="{{ $product->id }}">
                            {{ $product->name }}
                        </td>
                        <td>Rp {{ number_format($product->price,0,',','.') }}</td>
                        <td>
                            <input type="number" name="quantities[]" value="1" min="1" class="form-control" style="width:80px">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <button class="btn btn-primary">
                <i class="fas fa-save"></i> Buat Order
            </button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
