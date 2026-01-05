@extends('layouts.app')

@section('title','Edit Kategori')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('categories.update',$category->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="name" value="{{ $category->name }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control">{{ $category->description }}</textarea>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
