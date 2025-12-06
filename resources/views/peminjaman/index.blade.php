@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-pink-700">Daftar Peminjaman</h1>
        <a href="{{ route('peminjaman.create') }}" class="bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-white px-4 py-2 rounded-lg transition duration-200">
            + Tambah Peminjaman
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="overflow-x-auto bg-gradient-to-r from-pink-200 to-pink-400 rounded-xl shadow-md">
        <table class="min-w-full divide-y divide-pink-300 text-pink-900">
            <thead class="bg-gradient-to-r from-pink-500 to-pink-600 text-white text-sm uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-4 text-left">ID</th>
                    <th class="px-6 py-4 text-left">Barang</th>
                    <th class="px-6 py-4 text-left">Peminjam</th>
                    <th class="px-6 py-4 text-left">Jumlah</th>
                    <th class="px-6 py-4 text-left">Merk</th>
                    <th class="px-6 py-4 text-left">Tanggal Pinjam</th>
                    <th class="px-6 py-4 text-left">Tanggal Kembali</th>
                    <th class="px-6 py-4 text-left">Status</th>
                    <th class="px-6 py-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-pink-300 bg-white">
                @forelse($peminjamans as $peminjaman)
                    <tr class="hover:bg-pink-100 transition duration-200">
                        <td class="px-6 py-4">{{ $peminjaman->id }}</td>
                        <td class="px-6 py-4">{{ $peminjaman->barang->nama }}</td>
                        <td class="px-6 py-4">{{ $peminjaman->nama_peminjam }}</td>
                        <td class="px-6 py-4">{{ $peminjaman->jumlah }}</td>
                        <td class="px-6 py-4">{{ $peminjaman->merk }}</td>
                        <td class="px-6 py-4">{{ $peminjaman->tanggal_pinjam->format('d/m/Y') }}</td>
                        <td class="px-6 py-4">{{ $peminjaman->tanggal_kembali ? $peminjaman->tanggal_kembali->format('d/m/Y') : '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $peminjaman->tanggal_kembali ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $peminjaman->tanggal_kembali ? 'Dikembalikan' : 'Dipinjam' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('peminjaman.edit', $peminjaman->id) }}" class="bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-white px-3 py-1 rounded-md text-sm transition">
                                Edit
                            </a>
                            <form action="{{ route('peminjaman.destroy', $peminjaman->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus peminjaman ini?')">
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
                        <td colspan="9" class="px-6 py-10 text-center text-pink-300">Belum ada data peminjaman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-8 text-center">
        <a href="/" class="text-sm text-pink-600 hover:underline">&larr; Kembali ke Halaman Utama</a>
    </div>
</div>
@endsection 