<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventaris;
use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\RiwayatKondisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InventarisController extends Controller
{
    public function index(Request $request)
    {
        $query = Inventaris::with(['kategori', 'lokasi']);

        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        $inventaris = $query->latest()->paginate(10)->withQueryString();
        $kategoris = Kategori::all();

        return view('admin.inventaris.index', compact('inventaris', 'kategoris'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        $lokasis = Lokasi::all();
        return view('admin.inventaris.create', compact('kategoris', 'lokasis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|unique:inventaris,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'lokasi_id' => 'required|exists:lokasis,id',
            'jumlah_total' => 'required|integer|min:1',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'tanggal_perolehan' => 'nullable|date',
            'harga_perolehan' => 'nullable|numeric|min:0',
            'sumber' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validated['jumlah_tersedia'] = $validated['jumlah_total'];

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('inventaris', 'public');
        }

        Inventaris::create($validated);

        return redirect()->route('admin.inventaris.index')
            ->with('success', 'Barang berhasil ditambahkan!');
    }

    public function show(Inventaris $inventaris)
    {
        $inventaris->load(['kategori', 'lokasi', 'peminjaman.user', 'riwayatKondisi.user']);
        return view('admin.inventaris.show', compact('inventaris'));
    }

    public function edit(Inventaris $inventaris)
    {
        $kategoris = Kategori::all();
        $lokasis = Lokasi::all();
        return view('admin.inventaris.edit', compact('inventaris', 'kategoris', 'lokasis'));
    }

    public function update(Request $request, Inventaris $inventaris)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|unique:inventaris,kode_barang,' . $inventaris->id,
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'lokasi_id' => 'required|exists:lokasis,id',
            'jumlah_total' => 'required|integer|min:1',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'tanggal_perolehan' => 'nullable|date',
            'harga_perolehan' => 'nullable|numeric|min:0',
            'sumber' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Kalau kondisi berubah, catat riwayat
        if ($validated['kondisi'] !== $inventaris->kondisi) {
            RiwayatKondisi::create([
                'inventaris_id' => $inventaris->id,
                'kondisi_lama' => $inventaris->kondisi,
                'kondisi_baru' => $validated['kondisi'],
                'catatan' => 'Perubahan kondisi via edit barang',
                'user_id' => auth()->id(),
            ]);
        }

        if ($request->hasFile('foto')) {
            if ($inventaris->foto) {
                Storage::disk('public')->delete($inventaris->foto);
            }
            $validated['foto'] = $request->file('foto')->store('inventaris', 'public');
        }

        $inventaris->update($validated);

        return redirect()->route('admin.inventaris.index')
            ->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy(Inventaris $inventaris)
    {
        if ($inventaris->foto) {
            Storage::disk('public')->delete($inventaris->foto);
        }
        $inventaris->delete();

        return redirect()->route('admin.inventaris.index')
            ->with('success', 'Barang berhasil dihapus!');
    }
}
