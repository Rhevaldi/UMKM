@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="container-fluid">

        {{-- PAGE HEADER --}}
        <div class="content-header mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="m-0">Dashboard</h3>
                <span class="text-muted">{{ now()->format('d F Y') }}</span>
            </div>
        </div>


        {{-- STAT BOX --}}
        <div class="row">

            <div class="col-lg-3 col-md-6 col-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalProduk }}</h3>
                        <p>Total Produk</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <a href="{{ route('products.index') }}" class="small-box-footer">
                        Kelola Produk <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalPenjualan }}</h3>
                        <p>Total Order</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-12">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>Rp {{ number_format($revenueMonth) }}</h3>
                        <p>Revenue Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-12">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $ordersToday }}</h3>
                        <p>Order Hari Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                </div>
            </div>

        </div>


        {{-- MAIN CONTENT --}}
        <div class="row">

            {{-- SALES CHART --}}
            <div class="col-lg-7">

                <div class="card shadow-sm mb-4">

                    <div class="card-header">
                        <h5 class="mb-0">Grafik Penjualan Bulan Ini</h5>
                    </div>

                    <div class="card-body">
                        <canvas id="salesChart" height="120"></canvas>
                    </div>

                </div>

            </div>


            {{-- TOP PRODUCTS --}}
            <div class="col-lg-5">

                <div class="card shadow-sm mb-4">

                    <div class="card-header">
                        <h5 class="mb-0">Produk Terlaris</h5>
                    </div>

                    <div class="card-body p-0">

                        <div class="table-responsive">

                            <table class="table table-striped table-hover mb-0">

                                <thead class="table-light">
                                    <tr>
                                        <th width="50">No</th>
                                        <th>Produk</th>
                                        <th width="120">Terjual</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @forelse($topProducts as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td>
                                                <strong>{{ $item->product->name }}</strong>
                                            </td>

                                            <td>
                                                <span class="badge bg-success">
                                                    {{ $item->total }}
                                                </span>
                                            </td>

                                        </tr>

                                    @empty

                                        <tr>
                                            <td colspan="3" class="text-center text-muted p-4">
                                                Belum ada data penjualan
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- LOW STOCK --}}
        <div class="row">

            <div class="col-lg-6">

                <div class="card shadow-sm">

                    <div class="card-header">
                        <h5 class="mb-0">Produk Hampir Habis</h5>
                    </div>

                    <div class="card-body p-0">

                        <div class="table-responsive">

                            <table class="table table-striped table-hover mb-0">

                                <thead class="table-light">
                                    <tr>
                                        <th width="50">No</th>
                                        <th>Produk</th>
                                        <th>Gambar</th>
                                        <th width="120">Stok</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @forelse($lowStock as $product)
                                        <tr>

                                            <td>{{ $loop->iteration }}</td>

                                            <td>{{ $product->name }}</td>

                                            <td><img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width:30px;height:30px;object-fit:cover;border-radius:6px"></td>
                                            
                                            <td>
                                                <span class="badge bg-danger">
                                                    {{ $product->stock }}
                                                </span>
                                            </td>

                                        </tr>

                                    @empty

                                        <tr>
                                            <td colspan="3" class="text-center text-muted p-4">
                                                Tidak ada produk dengan stok rendah
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('salesChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($dailySales->pluck('date')),
                datasets: [{
                    label: 'Revenue',
                    data: @json($dailySales->pluck('total')),
                    borderColor: '#28a745',
                    backgroundColor: 'rgba(40,167,69,0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
