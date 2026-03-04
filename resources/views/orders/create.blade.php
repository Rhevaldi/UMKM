@extends('layouts.app')

@section('title', 'Buat Order')

@section('content')

    <div class="container-fluid">

        <div class="content-header mb-3">
            <h3 class="m-0">Buat Order Baru</h3>
        </div>

        <div class="card shadow-sm">

            <div class="card-body">

                <form action="{{ route('orders.store') }}" method="POST">

                    @csrf

                    <div class="row">

                        <div class="col-lg-4">

                            <div class="form-group mb-4">

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

                        </div>

                    </div>

                    <hr>

                    <h5 class="mb-3">Pilih Produk</h5>

                    <div class="table-responsive">

                        <table class="table table-bordered align-middle">

                            <thead class="table-light">

                                <tr>
                                    <th width="250">Produk</th>
                                    <th width="200">Harga</th>
                                    <th width="120">Qty</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($products as $product)
                                    <tr>

                                        <td>

                                            <label>

                                                <input type="checkbox" name="products[]" value="{{ $product->id }}"
                                                    class="me-2">

                                                {{ $product->name }}

                                            </label>

                                        </td>

                                        <td>

                                            Rp {{ number_format($product->price, 0, ',', '.') }}

                                        </td>

                                        <td>

                                            <input type="number" name="quantities[]" value="1" min="1"
                                                class="form-control" style="width:100px">

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>

                    <div class="mt-3">

                        <button class="btn btn-primary">

                            <i class="fas fa-save"></i>
                            Buat Order

                        </button>

                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">

                            Kembali

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
