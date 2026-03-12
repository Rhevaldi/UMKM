@extends('layouts.app')

@section('title', 'Buat Order')

@section('content')

    <div class="container-fluid">

        <h3 class="mb-3">
            <i class="fas fa-plus-circle mr-2"></i>
            Buat Order Baru
        </h3>

        <div class="card shadow-sm">

            <div class="card-body">

                <form action="{{ route('orders.store') }}" method="POST">

                    @csrf

                    <div class="form-group">

                        <label>Customer</label>

                        <select name="customer_id" class="form-control" required>

                            <option value="">-- Pilih Customer --</option>

                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">
                                    {{ $customer->name }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    <hr>

                    <h5>Pilih Produk</h5>

                    <table class="table table-bordered">

                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th width="120">Qty</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($products as $product)
                                <tr>

                                    <td>

                                        <label>
                                            <input type="checkbox" name="products[]" value="{{ $product->id }}">
                                            {{ $product->name }}
                                        </label>

                                    </td>

                                    <td>
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </td>

                                    <td>

                                        <input type="number" name="quantities[]" value="1" min="1"
                                            class="form-control">

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                    <button class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Simpan Order
                    </button>

                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                </form>

            </div>
        </div>

    </div>

@endsection
