@extends('layouts.master')

@section('title', 'Home Page')

@section('content')
<div class="w-full flex flex-col md:flex-row items-center justify-center h-auto md:h-36 bg-blue-300 p-4 md:p-0">
    <div class="flex flex-col md:flex-row items-center justify-center py-2 w-full">
        <form class="flex flex-col md:flex-row gap-3 w-full md:w-auto" action="{{ url('/main/search') }}" method="GET">
            <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                <input type="text" name="search" placeholder="Cari Barang"
                    class="w-full md:w-80 px-3 h-10 rounded-l border-2 border-blue-600 focus:outline-none focus:border-grey-700"
                    value="{{ request()->input('search') }}">
                <select id="pricingType" name="type"
                    class="w-full md:w-40 h-10 border-2 border-blue-600 focus:outline-none focus:border-gray-700 text-gray-700 rounded px-2 md:px-3 py-0 md:py-1 tracking-wider">
                    <option value="All" selected>All</option>
                    @foreach ($products->unique('type') as $product)
                        <option value="{{ $product->type }}" {{ request()->input('type') == $product->type ? 'selected' : '' }}>
                            {{ $product->type }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full md:w-auto">
                    Filter
                </button>
            </div>
        </form>
        <div class="flex flex-col md:flex-row gap-2 md:gap-3 mt-3 md:mt-0 w-full md:w-auto">
            <a href="{{ route('createProduct') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-full md:w-auto">
                Produk Baru
            </a>
            <div class="flex flex-row gap-2 md:gap-3 w-full md:w-auto">
                <a href="{{ route('checkout') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-1/2 md:w-auto">
                    Kurangi Stok
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
                                <p class="mb-3 font-normal text-gray-700">Stok: {{$product->stock}}</p>
                                <p class="mb-3 font-normal text-gray-700 truncate-overflow">{{$product->description}}</p>
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

@endsection




