<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('barang')->get();
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('peminjaman.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'nama_peminjam' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'merk' => 'required',
            'keterangan' => 'nullable'
        ]);

        $barang = Barang::findOrFail($request->barang_id);
        
        if ($barang->stok < $request->jumlah) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        $peminjaman = Peminjaman::create([
            'barang_id' => $request->barang_id,
            'nama_peminjam' => $request->nama_peminjam,
            'jumlah' => $request->jumlah,
            'sisa_jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'merk' => $request->merk,
            'keterangan' => $request->keterangan
        ]);
        
        // Update stok barang
        $barang->update([
            'stok' => $barang->stok - $request->jumlah
        ]);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $barangs = Barang::all();
        return view('peminjaman.edit', compact('peminjaman', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'nama_peminjam' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date',
            'merk' => 'required',
            'keterangan' => 'nullable'
        ]);

        // Jika ada tanggal kembali, berarti barang dikembalikan
        if ($request->tanggal_kembali && !$peminjaman->tanggal_kembali) {
            // Kembalikan stok
            $barang = Barang::findOrFail($request->barang_id);
            $barang->update([
                'stok' => $barang->stok + $peminjaman->sisa_jumlah
            ]);
        }

        $peminjaman->update($request->all());

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        // Jika belum dikembalikan, kembalikan stok
        if (!$peminjaman->tanggal_kembali) {
            $barang = Barang::findOrFail($peminjaman->barang_id);
            $barang->update([
                'stok' => $barang->stok + $peminjaman->sisa_jumlah
            ]);
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil dihapus!');
    }
} 