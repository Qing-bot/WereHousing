@extends('layouts.master')

@section('title, checkout')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl mb-4 text-gray-800 font-semibold">Reduce Stock</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if ($products->isEmpty())
    <div class="bg-yellow-100 text-yellow-800 p-4 rounded mb-4">
        <p>You don't have any products yet.</p>
    </div>
@else


<form action="{{ route('processCheckout') }}" method="POST">
    @csrf
    <table class="table-auto w-full mb-4">
        <thead>
            <tr>
                <th class="px-4 py-2">Product</th>
                <th class="px-4 py-2">Image</th>
                <th class="px-4 py-2">Stock</th>
                <th class="px-4 py-2">Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td class="border px-4 py-2">{{ $product->name }}</td>
                <td class="border px-4 py-2">
                    <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}" class="h-16 w-16 object-cover">
                </td>
                <td class="border px-4 py-2">{{ $product->stock }}</td>
                <td class="border px-4 py-2">
                    <input type="number" name="products[{{ $product->id }}][quantity]" class="border rounded w-full py-2 px-3" min="1" max="{{ $product->stock }}">
                    <input type="hidden" name="products[{{ $product->id }}][id]" value="{{ $product->id }}">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $products->links() }} 
    </div>
    <button type="submit" class="form-control text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Reduce Stock</button>
    <a href="{{ route('index_home') }}" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Back</a> 
</form>
@endif
</div>
@endsection
