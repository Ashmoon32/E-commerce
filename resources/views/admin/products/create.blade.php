@extends('layouts.admin')

@section('content')
    <h2>Add Product</h2>
    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf
        <label>Name: <input type="text" name="name" required></label><br>
        <label>Description: <textarea name="description"></textarea></label><br>
        <label>Price: <input type="number" step="0.01" name="price" required></label><br>
        <label>Stock: <input type="number" name="stock" value="0"></label><br>
        <label>Category:
            <select name="category_id">
                <option value="">None</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </label><br>
        <button type="submit">Save</button>
    </form>
@endsection