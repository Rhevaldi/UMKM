@extends('layouts.app')

@section('title','Edit Produk')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Edit Produk</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Kategori</label>
                <select name="category_id" class="form-control" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="name"
                       value="{{ $product->name }}"
                       class="form-control" required>
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="price"
                       value="{{ $product->price }}"
                       class="form-control" required>
            </div>

            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stock"
                       value="{{ $product->stock }}"
                       class="form-control" required>
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control">{{ $product->description }}</textarea>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="is_active" class="form-control">
                    <option value="1" {{ $product->is_active ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ !$product->is_active ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <button class="btn btn-primary">
                <i class="fas fa-save"></i> Update
            </button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>
    </div>
</div>
@endsection
