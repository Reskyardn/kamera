<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamera;
use Illuminate\Http\Request;

class KameraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kameras = Kamera::all();
        return view('admin.kameras.index', compact('kameras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kameras.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kamera' => 'required',
            'merk' => 'required',
            'tipe' => 'required',
            'spesifikasi' => 'required',
            'stok' => 'required|integer',
            'kondisi' => 'required',
            'status_ketersediaan' => 'required',
        ]);

        Kamera::create($request->all());

        return redirect()->route('admin.kameras.index')
            ->with('success', 'Kamera created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kamera $kamera)
    {
        return view('admin.kameras.show', compact('kamera'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kamera $kamera)
    {
        return view('admin.kameras.edit', compact('kamera'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kamera $kamera)
    {
        $request->validate([
            'nama_kamera' => 'required',
            'merk' => 'required',
            'tipe' => 'required',
            'spesifikasi' => 'required',
            'stok' => 'required|integer',
            'kondisi' => 'required',
            'status_ketersediaan' => 'required',
        ]);

        $kamera->update($request->all());

        return redirect()->route('admin.kameras.index')
            ->with('success', 'Kamera updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kamera $kamera)
    {
        $kamera->delete();

        return redirect()->route('admin.kameras.index')
            ->with('success', 'Kamera deleted successfully');
    }
}
