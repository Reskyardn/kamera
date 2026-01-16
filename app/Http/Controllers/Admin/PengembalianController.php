<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\Kamera;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengembalians = Pengembalian::with('peminjaman.user')->latest()->get();
        return view('admin.pengembalian.index', compact('pengembalians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $peminjaman_id = $request->get('peminjaman_id');
        $peminjaman = null;
        
        if ($peminjaman_id) {
            $peminjaman = Peminjaman::with(['user', 'detailPeminjaman.kamera'])->find($peminjaman_id);
        }
        
        // Get active loans that haven't been returned
        $peminjamans = Peminjaman::with('user')
            ->where('status_peminjaman', 'Dipinjam')
            ->whereDoesntHave('pengembalian')
            ->get();
            
        return view('admin.pengembalian.create', compact('peminjamans', 'peminjaman'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjamans,id',
            'tanggal_kembali' => 'required|date',
            'kondisi_kembali' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'denda' => 'nullable|numeric|min:0',
        ]);

        // Create return record
        Pengembalian::create([
            'peminjaman_id' => $request->peminjaman_id,
            'tanggal_kembali' => $request->tanggal_kembali,
            'kondisi_kembali' => $request->kondisi_kembali,
            'denda' => $request->denda ?? 0,
        ]);

        // Update peminjaman status
        $peminjaman = Peminjaman::find($request->peminjaman_id);
        $peminjaman->update(['status_peminjaman' => 'Dikembalikan']);

        // Update camera status back to available
        foreach ($peminjaman->detailPeminjaman as $detail) {
            $detail->kamera->update(['status_ketersediaan' => 'Tersedia']);
        }

        return redirect()->route('admin.pengembalian.index')->with('success', 'Pengembalian berhasil dicatat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengembalian $pengembalian)
    {
        $pengembalian->load(['peminjaman.user', 'peminjaman.detailPeminjaman.kamera']);
        return view('admin.pengembalian.show', compact('pengembalian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengembalian $pengembalian)
    {
        $pengembalian->load(['peminjaman.user']);
        return view('admin.pengembalian.edit', compact('pengembalian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengembalian $pengembalian)
    {
        $request->validate([
            'tanggal_kembali' => 'required|date',
            'kondisi_kembali' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'denda' => 'nullable|numeric|min:0',
        ]);

        $pengembalian->update([
            'tanggal_kembali' => $request->tanggal_kembali,
            'kondisi_kembali' => $request->kondisi_kembali,
            'denda' => $request->denda ?? 0,
        ]);

        return redirect()->route('admin.pengembalian.index')->with('success', 'Data pengembalian berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengembalian $pengembalian)
    {
        // Revert peminjaman status
        $pengembalian->peminjaman->update(['status_peminjaman' => 'Dipinjam']);
        
        // Revert camera status
        foreach ($pengembalian->peminjaman->detailPeminjaman as $detail) {
            $detail->kamera->update(['status_ketersediaan' => 'Dipinjam']);
        }
        
        $pengembalian->delete();

        return redirect()->route('admin.pengembalian.index')->with('success', 'Data pengembalian berhasil dihapus.');
    }
}
