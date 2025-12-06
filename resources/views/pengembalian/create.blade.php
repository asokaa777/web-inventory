@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-gradient-to-r from-pink-200 to-pink-400 p-8 rounded-2xl shadow-lg">
    <h2 class="text-3xl font-bold mb-6 text-pink-700 text-center">Tambah Pengembalian</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('pengembalian.store') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-pink-700 font-semibold mb-1">Peminjaman</label>
            <select name="peminjaman_id" class="w-full p-3 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 bg-white text-pink-900" required>
                <option value="">Pilih Peminjaman</option>
                @foreach($peminjaman as $p)
                    <option value="{{ $p->id }}" {{ old('peminjaman_id') == $p->id ? 'selected' : '' }}>
                        {{ $p->barang->nama }} - {{ $p->nama_peminjam }} (Jumlah: {{ $p->jumlah }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-pink-700 font-semibold mb-1">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}"
                class="w-full p-3 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 bg-white text-pink-900" required>
        </div>

        <div>
            <label class="block text-pink-700 font-semibold mb-1">Jumlah Kembali</label>
            <input type="number" name="jumlah_kembali" value="{{ old('jumlah_kembali') }}" min="1"
                class="w-full p-3 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 bg-white text-pink-900" required>
        </div>

        <div>
            <label class="block text-pink-700 font-semibold mb-1">Kondisi</label>
            <select name="kondisi" class="w-full p-3 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 bg-white text-pink-900" required>
                <option value="">Pilih Kondisi</option>
                <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                <option value="Rusak" {{ old('kondisi') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                <option value="Hilang" {{ old('kondisi') == 'Hilang' ? 'selected' : '' }}>Hilang</option>
            </select>
        </div>

        <div>
            <label class="block text-pink-700 font-semibold mb-1">Keterangan</label>
            <textarea name="keterangan" rows="3" placeholder="Keterangan (opsional)"
                class="w-full p-3 border border-pink-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 bg-white text-pink-900">{{ old('keterangan') }}</textarea>
        </div>

        <button type="submit" class="w-full bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-white py-3 rounded-lg font-semibold transition duration-200">
            Simpan
        </button>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('pengembalian.index') }}" class="text-sm text-pink-700 hover:underline">&larr; Kembali ke Daftar Pengembalian</a>
    </div>
</div>
@endsection 