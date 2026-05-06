@extends('layouts.admin')

@section('content')
    <h2>Add Product</h2>
    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf
        <label>Name: <br> <input type="text" name="name" required></label><br><br>
        <label>Description: <br> <textarea name="description"></textarea></label><br><br>
        <label>Price: <br> <input type="number" step="0.01" name="price" required></label><br><br>
        <label>Stock: <br> <input type="number" name="stock" value="0"></label><br><br>
        <label>Category: <br>
            <select name="category_id">
                <option value="">None</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </label><br><br>
        <button type="submit">Save</button>
    </form>
@endsection