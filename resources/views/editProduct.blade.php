@extends('layouts.master')

@section('document_title', 'Edit Product')

@section('content')
<div class="container flex h-screen w-screen justify-center">
    <div id="edititem" class="justify-center items-center w-screen h-full m-4">
        <div class="container flex justify-center h-auto p-4 w-full max-w-2xl">
            <div class="bg-slate-500 rounded-lg shadow-md">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Ubah Produk
                    </h3>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    @if ($errors->any())
                        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form class="space-y-6" action="{{ route('updateProduct', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div>
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nama Produk</label>
                            <div class="form-group mt-2">
                                <input id="name" name="name" value="{{ old('name', $product->name) }}" type="text" required class="form-group block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>

                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="z-0 w-full my-3 group">
                                    <label for="type" class="columns-2 justify-start text-sm font-medium leading-6 text-gray-900">Kategori</label>
                                    <select id="type" name="type" class="form-group block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type }}" {{ $type == $product->type ? 'selected' : '' }}>{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="z-0 w-full my-3 group">
                                    <input type="checkbox" id="enable_new_type" name="enable_new_type" class="form-group mr-2">
                                    <label for="enable_new_type" class="text-sm font-medium leading-6 text-gray-900">Kategori Baru</label>
                                </div>
                                <div class="z-0 w-full my-3 group">
                                    <label for="new_type" class="columns-2 justify-start text-sm font-medium leading-6 text-gray-900">Kategori Baru</label>
                                    <input id="new_type" name="new_type" value="{{ old('new_type') }}" type="text" class="form-group block rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Kategori Baru" disabled>
                                </div>
                                <div class="z-0 w-full my-3 group">
                                    <label for="stock" class="columns-2 justify-start text-sm font-medium leading-6 text-gray-900">Jumlah Produk</label>
                                    <input id="stock" name="stock" value="{{ old('stock', $product->stock) }}" type="number" required class="form-group block min-w-9 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <label for="description" class="form-control block text-sm font-medium leading-6 text-gray-900">Deskripsi</label>
                            <div class="max-w-sm mx-auto justify-start">
                                <textarea id="description" name="description" rows="4" class="form-group block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter description">{{ old('description', $product->description) }}</textarea>
                            </div>
                            <label class="form-control block mb-2 text-sm font-medium text-gray-900" for="image">Gambar Produk</label>
                            <input name="image" class="form-group block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="image_path" type="file">
                            <p class="mt-1 text-sm" id="image">SVG, PNG, JPG or GIF.</p>
                        </div>
                        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button type="submit" class="form-control text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Perbarui Produk</button>
                            <a href="{{ route('productDetail', ['id' => $product->id]) }}" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const enableNewTypeCheckbox = document.getElementById('enable_new_type');
        const newTypeInput = document.getElementById('new_type');
        const typeSelect = document.getElementById('type');

        enableNewTypeCheckbox.addEventListener('change', function() {
            if (this.checked) {
                newTypeInput.disabled = false;
                typeSelect.disabled = true;
            } else {
                newTypeInput.disabled = true;
                typeSelect.disabled = false;
            }
        });
    });
</script>
@endsection
