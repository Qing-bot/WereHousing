@extends('layouts.master')

@section('title, checkout')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-semibold mb-6">Checkout</h1>

    <div class="grid grid-cols-3 gap-4">
        <!-- Products Section -->
        <div class="col-span-2">
            <h2 class="text-xl font-medium mb-4">Products</h2>
            <table class="min-w-full bg-white border">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Product</th>
                        <th class="py-2 px-4 border-b">Price</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $product->name }}</td>
                        <td class="py-2 px-4 border-b">Rp.{{ $product->sell_price }}</td>
                        <td class="py-2 px-4 border-b">
                            <form action="{{ route('addToCheckout', $product->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="px-4 py-2 bg-green-500 text-white hover:bg-green-600">Add to Checkout</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Checkout Section -->
        <div class="col-span-1 bg-gray-100 p-4 rounded-lg shadow-md">
            <h2 class="text-xl font-medium mb-4">Checkout Summary</h2>

            @if (!empty($checkoutItems))
                <table class="min-w-full bg-white border mb-4">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Product</th>
                            <th class="py-2 px-4 border-b">Quantity</th>
                            <th class="py-2 px-4 border-b">Price</th>
                            <th class="py-2 px-4 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($checkoutItems as $item)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $item['product']->name }}</td>
                            <td class="py-2 px-4 border-b">
                                <form action="{{ route('updateQuantity', $item['product']->id) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="action" value="decrease" class="px-2 py-1 bg-gray-300 hover:bg-gray-400">-</button>
                                    <span class="w-20 px-2 py-1 border rounded text-center">{{ $item['quantity'] }}</span>
                                    <button type="submit" name="action" value="increase" class="px-2 py-1 bg-gray-300 hover:bg-gray-400">+</button>
                                </form>
                            </td>
                            <td class="py-2 px-4 border-b">Rp.{{ $item['quantity'] * $item['price'] }}</td>
                            <td class="py-2 px-4 border-b">
                                <form action="{{ route('removeItem', $item['product']->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white hover:bg-red-600">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <p class="text-lg font-semibold mb-4">Total Price: Rp.{{ $totalPrice }}</p>
            @else
                <p>No items in the checkout.</p>
            @endif

            <form action="{{ route('processCheckout') }}" method="POST" class="mt-6">
                @csrf
                <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white font-semibold hover:bg-blue-700">Checkout</button>
            </form>
        </div>
    </div>
</div>
@endsection


