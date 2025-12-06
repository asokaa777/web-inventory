@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-gradient-to-r from-pink-200 to-pink-400 p-8 rounded-2xl shadow-lg">
    <h2 class="text-3xl font-bold mb-6 text-pink-700 text-center">Edit Barang</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barang.update', $barang->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-pink-700 font-semibold mb-1">Nama Barang</label>
            <input name="nama" value="{{ $barang->nama }}" placeholder="Nama Barang" 
                class="w-full p-3 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 bg-white text-pink-900" required>
        </div>

        <div>
            <label class="block text-pink-700 font-semibold mb-1">Kategori</label>
            <input name="kategori" value="{{ $barang->kategori }}" placeholder="Kategori" 
                class="w-full p-3 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 bg-white text-pink-900" required>
        </div>

        <div>
            <label class="block text-pink-700 font-semibold mb-1">Stok</label>
            <input name="stok" type="number" value="{{ $barang->stok }}" placeholder="Stok" 
                class="w-full p-3 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 bg-white text-pink-900" required>
        </div>

        <button type="submit" class="w-full bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-white py-3 rounded-lg font-semibold transition duration-200">
            Update
        </button>
    </form>
</div>
@endsection
