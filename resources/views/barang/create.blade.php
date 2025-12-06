@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <h2 class="text-xl font-bold mb-4">Tambah Barang</h2>
    <form action="{{ url('/barang') }}" method="POST" class="space-y-4">
        @csrf
        <input name="nama" class="w-full border p-2" placeholder="Nama Barang" required>
        <input name="kategori" class="w-full border p-2" placeholder="Kategori" required>
        <input name="stok" type="number" class="w-full border p-2" placeholder="Stok" required>
        <button class="bg-pink-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
