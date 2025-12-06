@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-6 text-yellow-500">Edit Barang</h2>

    <form action="{{ route('barang.update', $barang->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input name="nama" value="{{ $barang->nama }}" class="w-full mb-3 p-2 border rounded" required>
        <input name="kategori" value="{{ $barang->kategori }}" class="w-full mb-3 p-2 border rounded" required>
        <input name="stok" type="number" value="{{ $barang->stok }}" class="w-full mb-3 p-2 border rounded" required>
        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
