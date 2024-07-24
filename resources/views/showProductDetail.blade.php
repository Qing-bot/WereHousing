@extends('layouts.master')

@section('document_title', 'Product Details')

@section('content')
<div class="flex justify-center">
    <div class="block max-w-[24rem] rounded-lg text-surface border-2 border-blue-900">
        <div class="relative overflow-hidden bg-cover bg-no-repeat border border-gray-700 rounded-lg">
            <img src="{{ asset('storage/images/' . $product->image) }}" alt="Image Not Found" class="img-fluid img-thumbnail">
        </div>
        <div class="p-6 text-wrap bg-blue-100 border rounded-lg border-gray-600">
            <h5 class="mb-2 text-xl font-medium leading-tight shadow-md">
                {{ $product->name }}
            </h5>
            <p class="mt-2 text-base text-wrap shadow-md">
                {{ $product->description }}
            </p>
            <p class="mt-2 text-sm font-medium leading-tight shadow-md border border-blue-900">
                Stok: {{ $product->stock }}
            </p>
        </div>
        <div class="bg-blue-100 border rounded-lg border-gray-600">
            <ul class="w-full border-t-2 border-gray-900">
                <div class="w-full flex justify-center px-6 py-3">
                    <a type="button" href="{{ route('editProduct', ['id' => $product->id]) }}" class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-2 text-center">
                        Ubah Produk
                    </a>
                </div>
                <li class="w-full">
                    <form class="flex justify-center" action="{{ route('deleteProduct', ['id' => $product->id]) }}" method="POST" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mt-2 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center">Hapus Produk</button>
                    </form>
                </li>
            </ul>
            <div class="w-full flex justify-center px-6 py-3 ">
                <a type="button" href="{{ route('index_home') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>


@endsection
