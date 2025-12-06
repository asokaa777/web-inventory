@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4">
    <div class="bg-gradient-to-r from-pink-200 to-pink-400 p-8 rounded-2xl shadow-lg mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-pink-800">
                    Inventaris Barang
                </h1>
                <p class="text-sm text-pink-700">Kelola stok barang elektronikmu dengan mudah 💼</p>
            </div>
            <a href="{{ route('barang.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-white font-semibold px-4 py-2 rounded-md shadow transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Barang
            </a>
        </div>
    </div>

    <div class="bg-gradient-to-r from-pink-200 to-pink-400 rounded-xl shadow-md">
        <table class="w-full divide-y divide-pink-300 text-pink-900">
            <thead class="bg-gradient-to-r from-pink-500 to-pink-600 text-white text-sm uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4 text-left">ID</th>
                    <th class="px-6 py-4 text-left">Nama</th>
                    <th class="px-6 py-4 text-left">Kategori</th>
                    <th class="px-6 py-4 text-left">Stok</th>
                    <th class="px-6 py-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-pink-300 bg-white">
                @forelse($barangs as $b)
                    <tr class="hover:bg-pink-100 transition duration-200">
                        <td class="px-6 py-4">{{ $b->id }}</td>
                        <td class="px-6 py-4">{{ $b->nama }}</td>
                        <td class="px-6 py-4">{{ $b->kategori }}</td>
                        <td class="px-6 py-4">{{ $b->stok }}</td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('barang.edit', $b->id) }}" class="bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-white px-3 py-1 rounded-md text-sm transition">
                                Edit
                            </a>
                            <form action="{{ route('barang.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-gradient-to-r from-red-400 to-red-500 hover:from-red-500 hover:to-red-600 text-white px-3 py-1 rounded-md text-sm transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-pink-300">Belum ada data barang.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
