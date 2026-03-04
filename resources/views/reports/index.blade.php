@extends('layouts.app')

@section('title', 'Laporan Penjualan')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="content-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="m-0">Laporan Penjualan</h3>
        </div>
    </div>


    {{-- GRAFIK PENJUALAN --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0">Grafik Penjualan Bulanan</h5>
        </div>

        <div class="card-body">
            <canvas id="salesChart" height="100"></canvas>
        </div>
    </div>


    {{-- FILTER --}}
    <div class="card mb-4">
        <div class="card-body">

            <form method="GET">
                <div class="row g-3 align-items-end">

                    <div class="col-md-4">
                        <label class="form-label">Filter Tanggal</label>
                        <input type="date"
                               name="date"
                               value="{{ $date }}"
                               class="form-control">
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary w-100">
                            <i class="fas fa-search"></i> Filter
                        </button>
                    </div>

                    <div class="col-md-3">
                        <a href="{{ route('reports.export') }}"
                           class="btn btn-success w-100">

                            <i class="fas fa-file-excel"></i>
                            Download Excel
                        </a>
                    </div>

                </div>
            </form>

        </div>
    </div>


    {{-- SUMMARY BOX --}}
    <div class="row mb-4">

        <div class="col-md-4">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $orders->count() }}</h3>
                    <p>Total Order</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Rp {{ number_format($total) }}</h3>
                    <p>Total Pendapatan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ \Carbon\Carbon::parse($date)->format('d M Y') }}</h3>
                    <p>Tanggal Laporan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar"></i>
                </div>
            </div>
        </div>

    </div>


    {{-- TABLE PENJUALAN --}}
    <div class="card">

        <div class="card-header">
            <h5 class="card-title mb-0">Detail Penjualan</h5>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-striped table-hover mb-0">

                    <thead class="table-dark">
                        <tr>
                            <th width="60">No</th>
                            <th>Order Code</th>
                            <th>Customer</th>
                            <th width="200">Total</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($orders as $order)

                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <strong>{{ $order->order_code }}</strong>
                            </td>

                            <td>
                                {{ $order->customer->name }}
                            </td>

                            <td>
                                <span class="badge bg-success">
                                    Rp {{ number_format($order->total_amount) }}
                                </span>
                            </td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="4" class="text-center text-muted p-4">
                                Tidak ada data penjualan
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


@push('scripts')

<script>

const ctx = document.getElementById('salesChart');

new Chart(ctx,{
    type:'bar',
    data:{
        labels:[
            'Jan','Feb','Mar','Apr','Mei','Jun',
            'Jul','Agu','Sep','Okt','Nov','Des'
        ],
        datasets:[{
            label:'Revenue',
            data:@json(array_values($monthlyRevenue->toArray())),
            backgroundColor:'#28a745'
        }]
    },
    options:{
        responsive:true,
        plugins:{
            legend:{display:false}
        }
    }
});

</script>

@endpush