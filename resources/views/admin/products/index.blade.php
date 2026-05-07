@extends('layouts.admin')

@section('content')
    <h2>Product List</h2>
    <a href="{{ route('admin.products.create') }}">Add New Product</a>
    <table border="1" cellpadding="10" cellspacing="2" style="margin-top: 20px; width: 100%;">
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>${{ number_format($product->price, 2) }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product) }}">Edit</a> |
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $products->links() }}
@endsection