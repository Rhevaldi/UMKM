@extends('layouts.app')

@section('title', 'Produk')

@section('content')

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                <i class="fas fa-box mr-2"></i>
                Daftar Produk
            </h5>

            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Produk
            </a>

        </div>


        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            <div class="table-responsive">

                <table id="productTable" class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                        <tr>
                            <th width="80">Gambar</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th width="150">Harga</th>
                            <th width="100">Stok</th>
                            <th width="120">Status</th>
                            <th width="150" class="text-center">Aksi</th>
                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($products as $item)
                            <tr>

                                <td class="text-center">

                                    @if ($item->image)
                                        <img src="{{ asset($item->image) }}"
                                            style="width:50px;height:50px;object-fit:cover;border-radius:6px">
                                    @else
                                        <img src="{{ asset('images/no-image.png') }}"
                                            style="width:50px;height:50px;object-fit:cover;border-radius:6px">
                                    @endif

                                </td>


                                <td>
                                    <strong>{{ $item->name }}</strong>
                                </td>


                                <td>
                                    {{ $item->category->name ?? '-' }}
                                </td>


                                <td>
                                    <span class="text-success fw-bold">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </span>
                                </td>


                                <td>
                                    <span class="badge bg-info">
                                        {{ $item->stock }}
                                    </span>
                                </td>


                                <td>

                                    @if ($item->is_active)
                                        <span class="badge bg-success">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            Nonaktif
                                        </span>
                                    @endif

                                </td>


                                <td class="text-center">

                                    <a href="{{ route('products.edit', $item->id) }}" class="btn btn-warning btn-sm">

                                        <i class="fas fa-edit"></i>

                                    </a>


                                    <form action="{{ route('products.destroy', $item->id) }}" method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Hapus produk?')" class="btn btn-danger btn-sm">

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

    </div>

@endsection
