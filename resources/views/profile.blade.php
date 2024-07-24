@extends('layouts.master')

@section('title', 'Profile Page')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl mb-4">Profil</h2>
    <div class="bg-white shadow-md rounded-lg p-4">
        <p class="mb-2"><strong>Pengguna:</strong> {{ $user->username }}</p>
        <p class="mb-2"><strong>Email:</strong> {{ $user->email }}</p>
        <a type="button" href="{{ route('editProfile') }}" class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-yellow-400 dark:hover:bg-yellow-500 dark:focus:ring-yellow-600">
            Ubah Profil
        </a>
    </div>
</div>
@endsection