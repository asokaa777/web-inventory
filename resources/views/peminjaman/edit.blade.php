@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-gradient-to-r from-pink-200 to-pink-400 p-8 rounded-2xl shadow-lg">
    <h2 class="text-3xl font-bold mb-6 text-pink-700 text-center">Edit Peminjaman</h2>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-pink-700 font-semibold mb-1">Barang</label>
            <select name="barang_id" class="w-full p-3 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 bg-white text-pink-900" required>
                <option value="">Pilih Barang</option>
                @foreach($barangs as $barang)
                    <option value="{{ $barang->id }}" {{ $peminjaman->barang_id == $barang->id ? 'selected' : '' }}>
                        {{ $barang->nama }} (Stok: {{ $barang->stok }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-pink-700 font-semibold mb-1">Nama Peminjam</label>
            <input name="nama_peminjam" value="{{ $peminjaman->nama_peminjam }}" placeholder="Nama Peminjam" 
                class="w-full p-3 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 bg-white text-pink-900" required>
        </div>

        <div>
            <label class="block text-pink-700 font-semibold mb-1">Jumlah</label>
            <input name="jumlah" type="number" min="1" value="{{ $peminjaman->jumlah }}" placeholder="Jumlah" 
                class="w-full p-3 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 bg-white text-pink-900" required>
        </div>

        <div>
            <label class="block text-pink-700 font-semibold mb-1">Merk</label>
            <input name="merk" value="{{ $peminjaman->merk }}" placeholder="Merk Barang" 
                class="w-full p-3 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 bg-white text-pink-900" required>
        </div>

        <div>
            <label class="block text-pink-700 font-semibold mb-1">Tanggal Pinjam</label>
            <input name="tanggal_pinjam" type="date" value="{{ $peminjaman->tanggal_pinjam->format('Y-m-d') }}" 
                class="w-full p-3 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 bg-white text-pink-900" required>
        </div>

        <div>
            <label class="block text-pink-700 font-semibold mb-1">Tanggal Kembali</label>
            <input name="tanggal_kembali" type="date" value="{{ $peminjaman->tanggal_kembali ? $peminjaman->tanggal_kembali->format('Y-m-d') : '' }}" 
                class="w-full p-3 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 bg-white text-pink-900">
        </div>

        <div>
            <label class="block text-pink-700 font-semibold mb-1">Keterangan</label>
            <textarea name="keterangan" placeholder="Keterangan (opsional)" 
                class="w-full p-3 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 bg-white text-pink-900" rows="3">{{ $peminjaman->keterangan }}</textarea>
        </div>

        <button type="submit" class="w-full bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-white py-3 rounded-lg font-semibold transition duration-200">
            Update
        </button>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('peminjaman.index') }}" class="text-sm text-pink-700 hover:underline">&larr; Kembali ke Daftar Peminjaman</a>
    </div>
</div>
@endsection 