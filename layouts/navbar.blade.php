<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    </head>
<body>
        <nav class="bg-gray-400 border-gray-200 flex justify-between">
            <div class="w-[100%] flex flex-wrap items-center justify-between mx-4 p-3">
                <a class="flex space-x-3">
                    <span class="text-4xl font-semibold whitespace-nowrap">WEREHOUSING</span>
                </a>
                </button>
                <div class="flex w-[25%]" id="navbar-default justify-end items-center overflow-">
                    <ul class="font-medium flex p-1 border border-gray-100 rounded-lg">
                        <li>
                        <a href="{{ route('index_home') }}" class="block py-2 px-2 text-gray-600 rounded" aria-current="page">Home</a>
                        </li>
                        <li>
                        <a href="{{ route('index_profile') }}" class="block py-2 px-2 text-gray-600 rounded" aria-current="page">Profile</a>
                        </li>
                        <li>
                        <a href="#" class="block py-2 px-2 text-gray-600 rounded" aria-current="page">Profile</a>
                        </li>
                        <li>
                        <a href="#" class="block py-2 px-2 text-gray-600 rounded" aria-current="page">Home</a>
                        </li>
                        <li>
                        <a href="#" class="block py-2 px-2 text-gray-600 rounded" aria-current="page">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <div class="container">
        @yield('content')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
