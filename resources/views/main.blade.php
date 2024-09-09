@extends('layouts.master')

@section('title', 'Home Page')

@section('content')
<div class="w-full flex flex-col md:flex-row items-center justify-center h-auto md:h-36 bg-blue-300 p-4 md:p-0">
    <div class="flex flex-col md:flex-row items-center justify-center py-2 w-full">
        <form class="flex flex-col md:flex-row gap-3 w-full md:w-auto" action="{{ url('/main/search') }}" method="GET">
            <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                <input type="text" name="search" placeholder="Search Product"
                    class="w-2/3 md:w-80 px-3 h-10 rounded-l border-2 border-blue-600 focus:outline-none focus:border-grey-700"
                    value="{{ request()->input('search') }}">
                <select id="pricingType" name="type"
                    class="w-1/3 md:w-40 h-10 border-2 border-blue-600 focus:outline-none focus:border-gray-700 text-gray-700 rounded px-2 md:px-3 py-0 md:py-1 tracking-wider">
                    <option value="All" {{ request()->input('type') == 'All' ? 'selected' : '' }}>All</option>
                    
                        @foreach ($allTypes as $type)
                            <option value="{{ $type }}" {{ request()->input('type') == $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    
                </select>
            </div>
        </form>
        
        <div class="flex flex-col md:flex-row gap-2 md:gap-3 mt-3 md:mt-0 w-full md:w-auto">
            <a href="{{ route('createProduct') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-full md:w-auto">
                Produk Baru
            </a>
            <div class="flex flex-row gap-2 md:gap-3 w-full md:w-auto">
                <a href="{{ route('viewCheckout') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-1/2 md:w-auto">
                    Checkout
                </a>
                <a href="{{ route('addStockPage') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-1/2 md:w-auto">
                    Tambah Stok
                </a>
            </div>
        </div>
    </div>
</div>

@foreach ($products as $product)
    <div class="text-center">
        @if ($product->stock < 10)
            <h5 class="mb-2 lg:text-lg sm:text-base font-bold tracking-tight text-red-600">Stok barang ini: "{{ $product->name }}" sisa: {{ $product->stock }}, segera pesan.</h5>
        @endif
    </div>
@endforeach

<div class="h-full w-full flex flex-col items-center bg-blue-100">
    @if ($products->isNotEmpty())
        <div class="w-full flex justify-center">
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($products as $product)
                <div class="flex justify-center p-3">
                    <div class="max-w-[18rem] bg-white border border-gray-200 rounded-lg shadow p-3">
                        <a href="{{ route('productDetail', ['id' => $product->id]) }}">
                            <img class="h-28 w-20 object-center" src="{{ asset('storage/images/' . $product->image) }}" alt="Image Not Found">
                        </a>
                        <div class="">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $product->name }}</h5>
                            <p class="mb-3 font-normal text-gray-700">Stok:</p>
                            <div class="flex items-center mb-3">
                                <!-- Ensure the form is pointing to the correct route -->
                                <form action="{{ route('updateStock', ['id' => $product->id]) }}" method="POST" class="flex items-center">
                                    @csrf
                                    <button type="submit" name="action" value="decrease" class="bg-red-500 text-white px-2 py-1 rounded">-</button>
                                    <input type="text" name="quantity" value="{{ $product->stock }}" class="w-12 text-center mx-2 border border-gray-300 rounded">
                                    <button type="submit" name="action" value="increase" class="bg-green-500 text-white px-2 py-1 rounded">+</button>
                                </form>
                            </div>
                            <p class="mb-3 font-normal text-gray-700 truncate-overflow">{{$product->description}}</p>
                            <p class="mb-3 font-normal text-gray-700 truncate-overflow">Rp: {{$product->sell_price}}</p>
                            <p class="mb-3 font-normal text-gray-700 truncate-overflow">Expired Date: {{$product->expired_date}}</p>
                        </div>
                        <div class="">
                            <a href="{{ route('productDetail', ['id' => $product->id]) }}" class="btn btn-primary mx-2 my-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Detail barang</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="mt-4 w-full flex justify-center">
            {{ $products->links() }}
        </div>
    @else
        <p class="text-center text-3xl font-medium">Produk tidak ditemukan</p>
        <a href="{{ route('createProduct') }}" class="mx-2 my-0 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center animate-pulse">
            Tambahkan Barang
        </a>
    @endif
</div>
<script>
    document.getElementById('pricingType').addEventListener('change', function() {
        this.form.submit();
    });
</script>
@endsection






