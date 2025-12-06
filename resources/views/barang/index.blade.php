@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Barang</h1>
    <a href="{{ url('/barang/tambah') }}" class="bg-pink-500 text-white px-4 py-2 rounded">+ Tambah</a>

    <table class="w-full mt-4 table-auto border">
        <thead>
            <tr class="bg-pink-100">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Nama</th>
                <th class="p-2 border">Kategori</th>
                <th class="p-2 border">Stok</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barang as $b)
            <tr>
                <td class="border p-2">{{ $b->id }}</td>
                <td class="border p-2">{{ $b->nama }}</td>
                <td class="border p-2">{{ $b->kategori }}</td>
                <td class="border p-2">{{ $b->stok }}</td>
                <td class="border p-2">
                    <a href="{{ url('/barang/edit/'.$b->id) }}" class="text-yellow-500">Edit</a> |
                    <form action="{{ url('/barang/'.$b->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin?')" class="text-red-500">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
