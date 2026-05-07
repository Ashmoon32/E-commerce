@extends('layouts.admin')

@section('content')
    <h2>Edit Product</h2>
    <form action="{{ route('admin.products.update', $product) }}" method="POST">
        @csrf @method('PUT')
        <label>Name: <input type="text" name="name" value="{{ old('name', $product->name) }}" required></label><br>
        <label>Description: <textarea
                name="description">{{ old('description', $product->description) }}</textarea></label><br>
        <label>Price: <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                required></label><br>
        <label>Stock: <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required></label><br>
        <label>Category:
            <select name="category_id">
                <option value="">None</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </label><br>
        <button type="submit">Update</button>
    </form>
@endsection