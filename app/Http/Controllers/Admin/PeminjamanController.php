<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventaris;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['inventaris', 'user'])
            ->latest()->paginate(10);
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $inventaris = Inventaris::where('jumlah_tersedia', '>', 0)
            ->where('kondisi', '!=', 'rusak_berat')
            ->get();
        return view('admin.peminjaman.create', compact('inventaris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'inventaris_id' => 'required|exists:inventaris,id',
            'nama_peminjam' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'jumlah_pinjam' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali_rencana' => 'required|date|after_or_equal:tanggal_pinjam',
            'keterangan' => 'nullable|string',
        ]);

        $barang = Inventaris::findOrFail($validated['inventaris_id']);

        if ($barang->jumlah_tersedia < $validated['jumlah_pinjam']) {
            return back()->withErrors(['jumlah_pinjam' => 'Stok tidak mencukupi!'])
                ->withInput();
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'dipinjam';

        Peminjaman::create($validated);

        // Kurangi stok
        $barang->decrement('jumlah_tersedia', $validated['jumlah_pinjam']);

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman berhasil dicatat!');
    }

    public function show(Peminjaman $peminjaman)
    {
        return view('admin.peminjaman.show', compact('peminjaman'));
    }

    public function edit(Peminjaman $peminjaman)
    {
        $inventaris = Inventaris::all();
        return view('admin.peminjaman.edit', compact('peminjaman', 'inventaris'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $validated = $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'tanggal_kembali_rencana' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $peminjaman->update($validated);

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman berhasil diperbarui!');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        // Kembalikan stok kalau masih dipinjam
        if ($peminjaman->status === 'dipinjam') {
            $peminjaman->inventaris->increment('jumlah_tersedia', $peminjaman->jumlah_pinjam);
        }

        $peminjaman->delete();

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman berhasil dihapus!');
    }

    public function kembalikan(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'dipinjam') {
            return back()->with('success', 'Barang sudah dikembalikan.');
        }

        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali_aktual' => now(),
        ]);

        // Tambah kembali stok
        $peminjaman->inventaris->increment('jumlah_tersedia', $peminjaman->jumlah_pinjam);

        return redirect()->route('admin.peminjaman.index')
            ->with('success', 'Barang berhasil dikembalikan!');
    }
}
