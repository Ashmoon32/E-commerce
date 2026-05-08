@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-light">Products</h2>
        <a href="{{ route('admin.products.create') }}"
            class="bg-black text-white px-4 py-2 text-sm hover:bg-gray-800 transition">Add New Product</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left p-3 font-normal">Name</th>
                    <th class="text-left p-3 font-normal">Price</th>
                    <th class="text-left p-3 font-normal">Stock</th>
                    <th class="text-left p-3 font-normal">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3">{{ $product->name }}</td>
                        <td class="p-3">${{ number_format($product->price, 2) }}</td>
                        <td class="p-3">{{ $product->stock }}</td>
                        <td class="p-3 space-x-2">
                            <a href="{{ route('admin.products.edit', $product) }}"
                                class="underline text-sm hover:no-underline">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="underline text-sm hover:no-underline"
                                    onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $products->links() }}
    </div>
@endsection