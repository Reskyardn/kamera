<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Kamera;
use App\Models\DetailPeminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Peminjaman::with('user')->latest();
        
        // User role only sees their own peminjaman
        if (auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->id());
        }
        
        $peminjamans = $query->get();
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kameras = Kamera::where('status_ketersediaan', 'Tersedia')->get();
        $users = auth()->user()->role === 'admin' ? User::all() : collect();
        return view('admin.peminjaman.create', compact('kameras', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kamera_id' => 'required|exists:kameras,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali_rencana' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        DB::transaction(function () use ($request) {
            // Create Peminjaman
            $peminjaman = Peminjaman::create([
                'user_id' => $request->user_id,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_kembali_rencana' => $request->tanggal_kembali_rencana,
                'status_peminjaman' => 'Dipinjam',
            ]);

            // Create Detail Peminjaman (Assuming 1 camera per loan for simplicity initially, or modify logic for multiple)
            DetailPeminjaman::create([
                'peminjaman_id' => $peminjaman->id,
                'kamera_id' => $request->kamera_id,
                'jumlah' => 1, // Defaulting to 1 for now
            ]);

            // Update Kamera Status
            $kamera = Kamera::find($request->kamera_id);
            $kamera->update(['status_ketersediaan' => 'Dipinjam']);
        });

        return redirect()->route('admin.peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load(['user', 'detailPeminjaman.kamera']);
        return view('admin.peminjaman.show', compact('peminjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        $peminjaman->load(['user', 'detailPeminjaman']);
        return view('admin.peminjaman.edit', compact('peminjaman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali_rencana' => 'required|date|after_or_equal:tanggal_pinjam',
            'status_peminjaman' => 'required|in:Dipinjam,Dikembalikan,Terlambat',
        ]);

        $peminjaman->update($request->all());

        return redirect()->route('admin.peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        // Restore camera status if deleting an active loan
        if ($peminjaman->status_peminjaman == 'Dipinjam') {
            foreach ($peminjaman->detailPeminjaman as $detail) {
                $detail->kamera->update(['status_ketersediaan' => 'Tersedia']);
            }
        }
        
        $peminjaman->detailPeminjaman()->delete();
        $peminjaman->delete();

        return redirect()->route('admin.peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
