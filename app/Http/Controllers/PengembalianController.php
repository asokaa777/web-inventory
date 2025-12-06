<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalian = Pengembalian::with(['peminjaman.barang'])->get();
        return view('pengembalian.index', compact('pengembalian'));
    }

    public function create()
    {
        $peminjaman = Peminjaman::where('sisa_jumlah', '>', 0)->with('barang')->get();
        return view('pengembalian.create', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,id',
            'tanggal_kembali' => 'required|date',
            'jumlah_kembali' => 'required|integer|min:1',
            'kondisi' => 'required|in:Baik,Rusak,Hilang',
            'keterangan' => 'nullable|string'
        ]);

        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);
        
        if ($request->jumlah_kembali > $peminjaman->sisa_jumlah) {
            return back()->withErrors(['jumlah_kembali' => 'Jumlah pengembalian tidak boleh melebihi sisa jumlah peminjaman']);
        }

        // Create pengembalian record
        $pengembalian = Pengembalian::create($request->all());

        // Update sisa jumlah peminjaman
        $peminjaman->sisa_jumlah = $peminjaman->sisa_jumlah - $request->jumlah_kembali;
        
        // Jika semua sudah dikembalikan, set tanggal_kembali
        if ($peminjaman->sisa_jumlah == 0) {
            $peminjaman->tanggal_kembali = $request->tanggal_kembali;
        }
        
        $peminjaman->save();

        // Update stok barang
        $barang = $peminjaman->barang;
        $barang->stok += $request->jumlah_kembali;
        $barang->save();

        return redirect()->route('pengembalian.index')
            ->with('success', 'Pengembalian berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pengembalian = Pengembalian::with('peminjaman.barang')->findOrFail($id);
        return view('pengembalian.edit', compact('pengembalian'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_kembali' => 'required|date',
            'jumlah_kembali' => 'required|integer|min:1',
            'kondisi' => 'required|in:Baik,Rusak,Hilang',
            'keterangan' => 'nullable|string'
        ]);

        $pengembalian = Pengembalian::findOrFail($id);
        $peminjaman = $pengembalian->peminjaman;
        $barang = $peminjaman->barang;

        // Kembalikan stok ke kondisi sebelum update
        $barang->stok -= $pengembalian->jumlah_kembali;
        
        // Kembalikan sisa_jumlah ke kondisi sebelum update
        $peminjaman->sisa_jumlah += $pengembalian->jumlah_kembali;
        
        // Update pengembalian
        $pengembalian->update($request->all());
        
        // Update sisa jumlah peminjaman
        $peminjaman->sisa_jumlah -= $request->jumlah_kembali;
        
        // Jika semua sudah dikembalikan, set tanggal_kembali
        if ($peminjaman->sisa_jumlah == 0) {
            $peminjaman->tanggal_kembali = $request->tanggal_kembali;
        } else {
            $peminjaman->tanggal_kembali = null;
        }
        
        $peminjaman->save();
        
        // Update stok barang dengan jumlah baru
        $barang->stok += $request->jumlah_kembali;
        $barang->save();

        return redirect()->route('pengembalian.index')
            ->with('success', 'Pengembalian berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $peminjaman = $pengembalian->peminjaman;
        $barang = $peminjaman->barang;

        // Kembalikan stok ke kondisi sebelum pengembalian
        $barang->stok -= $pengembalian->jumlah_kembali;
        $barang->save();

        // Kembalikan sisa_jumlah ke kondisi sebelum pengembalian
        $peminjaman->sisa_jumlah += $pengembalian->jumlah_kembali;
        
        // Reset tanggal kembali jika masih ada sisa
        if ($peminjaman->sisa_jumlah > 0) {
            $peminjaman->tanggal_kembali = null;
        }
        
        $peminjaman->save();

        $pengembalian->delete();

        return redirect()->route('pengembalian.index')
            ->with('success', 'Pengembalian berhasil dihapus');
    }
} 