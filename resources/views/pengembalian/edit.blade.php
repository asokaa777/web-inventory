@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-gradient-to-r from-pink-200 to-pink-400 p-8 rounded-2xl shadow-lg">
    <h2 class="text-3xl font-bold mb-6 text-pink-700 text-center">Edit Pengembalian</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('pengembalian.update', $pengembalian->id) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-pink-700 font-semibold mb-1">Barang</label>
            <input type="text" value="{{ $pengembalian->peminjaman->barang->nama }}" 
                class="w-full p-3 border border-pink-300 rounded-lg bg-gray-100 text-pink-900" readonly>
        </div>

        <div>
            <label class="block text-pink-700 font-semibold mb-1">Peminjam</label>
            <input type="text" value="{{ $pengembalian->peminjaman->nama_peminjam }}" 
                class="w-full p-3 border border-pink-300 rounded-lg bg-gray-100 text-pink-900" readonly>
        </div>

        <div>
            <label class="block text-pink-700 font-semibold mb-1">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" 
                value="{{ old('tanggal_kembali', $pengembalian->tanggal_kembali->format('Y-m-d')) }}"
                class="w-full p-3 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 bg-white text-pink-900" required>
        </div>

        <div>
            <label class="block text-pink-700 font-semibold mb-1">Jumlah Kembali</label>
            <input type="number" name="jumlah_kembali" 
                value="{{ old('jumlah_kembali', $pengembalian->jumlah_kembali) }}" min="1"
                class="w-full p-3 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 bg-white text-pink-900" required>
        </div>

        <div>
            <label class="block text-pink-700 font-semibold mb-1">Kondisi</label>
            <select name="kondisi" class="w-full p-3 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 bg-white text-pink-900" required>
                <option value="">Pilih Kondisi</option>
                <option value="Baik" {{ old('kondisi', $pengembalian->kondisi) == 'Baik' ? 'selected' : '' }}>Baik</option>
                <option value="Rusak" {{ old('kondisi', $pengembalian->kondisi) == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                <option value="Hilang" {{ old('kondisi', $pengembalian->kondisi) == 'Hilang' ? 'selected' : '' }}>Hilang</option>
            </select>
        </div>

        <div>
            <label class="block text-pink-700 font-semibold mb-1">Keterangan</label>
            <textarea name="keterangan" rows="3" placeholder="Keterangan (opsional)"
                class="w-full p-3 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 bg-white text-pink-900">{{ old('keterangan', $pengembalian->keterangan) }}</textarea>
        </div>

        <button type="submit" class="w-full bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-white py-3 rounded-lg font-semibold transition duration-200">
            Update
        </button>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('pengembalian.index') }}" class="text-sm text-pink-700 hover:underline">&larr; Kembali ke Daftar Pengembalian</a>
    </div>
</div>
@endsection 