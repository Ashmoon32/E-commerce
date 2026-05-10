@extends('layouts.admin')

@section('content')
    <h2 class="text-3xl font-light mb-6">Edit Product</h2>
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="max-w-lg space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-medium mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:border-black">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Description</label>
            <textarea name="description" rows="3"
                class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:border-black">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Price</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required
                    class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:border-black">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                    class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:border-black">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Category</label>
            <select name="category_id"
                class="w-full border border-gray-300 px-3 py-2 bg-white focus:outline-none focus:border-black">
                <option value="">None</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Product Image</label>
            @if($product->image)
                <div class="mb-2">
                    <img src="{{ $product->image }}" class="w-24 h-24 object-cover border">
                </div>
            @endif
            <input type="file" name="image" accept="image/*" class="w-full border border-gray-300 px-3 py-2">
        </div>
        <button type="submit" class="bg-black text-white px-6 py-2 text-sm hover:bg-gray-800 transition">Update
            Product</button>
    </form>
@endsection