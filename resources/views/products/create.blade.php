@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

    <div class="card">

        <div class="card-header">
            <h5 class="card-title">Tambah Produk</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="form-group">
                    <label>Kategori</label>

                    <select name="category_id" class="form-control" required>

                        <option value="">-- Pilih Kategori --</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>
                </div>



                <div class="form-group">
                    <label>Nama Produk</label>

                    <input type="text" name="name" class="form-control" required>
                </div>



                <div class="form-group">
                    <label>Harga</label>

                    <input type="number" name="price" class="form-control" required>
                </div>



                <div class="form-group">
                    <label>Stok</label>

                    <input type="number" name="stock" class="form-control" required>
                </div>



                <div class="form-group">
                    <label>Deskripsi</label>

                    <textarea name="description" class="form-control">
</textarea>
                </div>



                <div class="form-group">
                    <label>Gambar Produk</label>

                    <input type="file" name="image" class="form-control">

                    <small class="text-muted">
                        Upload gambar produk (jpg/png)
                    </small>

                </div>



                <div class="form-group">
                    <label>Status</label>

                    <select name="is_active" class="form-control">

                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>

                    </select>
                </div>



                <button class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>

                <a href="{{ route('products.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>

    </div>

@endsection
