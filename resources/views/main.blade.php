<script>
$collection = collect(['aaaaaaaaaa'])
</script>
@extends('layouts.navbar')

@section('title', 'Home Page')

@section('content')
<div class="container mx-auto flex items-center justify-center">
    <div class="flex items-center justify-center py-2">
        <form class="flex flex-row gap-3">
            <div class="flex">
                <input type="text" placeholder="Search for the tool you like"
                    class="w-[50%] md:w-80 px-3 h-10 rounded-l border-2 border-gray-700 focus:outline-none focus:border-grey-700"
                    >
                <button type="submit" class="h-10 bg-gray-700 text-white rounded-r px-2 md:px-3 py-0 md:py-1">Search</button>
            </div>
            <select id="pricingType" name="pricingType"
		    class="w-full h-10 border-2 border-sky-500 focus:outline-none focus:border-sky-500 text-sky-500 rounded px-2 md:px-3 py-0 md:py-1 tracking-wider">
                <option value="1" selected="">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
	        </select>
        </form>

        <!-- Modal toggle -->
        <button data-modal-target="additem" data-modal-toggle="additem" class="mx-2 my-0 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        Add Items
        </button>
        <!-- Main modal -->
            <div id="additem" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Add items
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="additem">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <form class="space-y-6" action="#" method="POST">
                        <div>
                            <label for="itemname" class="block text-sm font-medium leading-6 text-gray-900">Nama Barang</label>
                            <div class="mt-2">
                                <input id="itemname" name="itemname" type="text" autocomplete="Item Name" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>

                            <label for="itemtype" class="block text-sm font-medium leading-6 text-gray-900">Jenis & Jumlah Barang</label>
                            <div class="flex justify-evenly imt-2">
                                <input id="itemtype" name="itemtype" type="text" autocomplete="Item Type" required class="block w-[77%] rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <input id="itemqty" name="itemqty" type="number" autocomplete="Item Quantity" required class="block w-[20%] rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>

                            <label for="itemdesc" class="block text-sm font-medium leading-6 text-gray-900">Detail Barang</label>
                            <form class="max-w-sm mx-auto">
                                <textarea id="itemdesc" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Deskripsi Barang"></textarea>
                            </form>
                            <label class="block mb-2 text-sm font-medium text-gray-900" for="itempic">Gambar Barang</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="itempict" type="file">
                            <p class="mt-1 text-sm" id="itempictdet">SVG, PNG, JPG or GIF.</p>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="additem" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Item</button>
                        <button data-modal-hide="additem" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="flex justify-center">
    <div class="col-auto content-center">
         @if (collect()->isEmpty())
            <div class="text-3xl font-bold w-full text-gray-700 bg-gray-500">No data found</div>
        @else
            @foreach (collect() as $item)
                <div class="text-3xl font-bold text-gray-700">{{ $item->name }}</div>
            @endforeach
        @endif
    </div>
</div>
@endsection
