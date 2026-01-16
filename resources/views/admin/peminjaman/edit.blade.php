@extends('layouts.cms')

@section('content')
<div class="py-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Peminjaman</h1>
        <p class="text-sm text-gray-500">Ubah data peminjaman</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.peminjaman.update', $peminjaman->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- User / Peminjam (Read-only) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Peminjam</label>
                    <input type="hidden" name="user_id" value="{{ $peminjaman->user_id }}">
                    <div class="w-full px-3 py-2 border border-gray-300 bg-gray-50 rounded-lg text-gray-700">
                        {{ $peminjaman->user->name }} ({{ $peminjaman->user->email }})
                    </div>
                </div>

                <!-- Kamera (Readonly in Edit for simplicity, or complex logic needed) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kamera Dipinjam</label>
                    <input type="text" value="{{ $peminjaman->detailPeminjaman->first()->kamera->nama_kamera ?? 'N/A' }}" disabled
                        class="w-full px-3 py-2 border border-gray-300 bg-gray-100 rounded-lg text-gray-500">
                    <p class="text-xs text-gray-500 mt-1">Kamera tidak dapat diubah saat edit peminjaman.</p>
                </div>

                <!-- Tanggal Pinjam -->
                <div>
                    <label for="tanggal_pinjam" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" value="{{ $peminjaman->tanggal_pinjam }}" required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Rencana Kembali -->
                <div>
                    <label for="tanggal_kembali_rencana" class="block text-sm font-medium text-gray-700 mb-1">Rencana Kembali</label>
                    <input type="date" name="tanggal_kembali_rencana" id="tanggal_kembali_rencana" value="{{ $peminjaman->tanggal_kembali_rencana }}" required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Status -->
                <div class="md:col-span-2">
                    <label for="status_peminjaman" class="block text-sm font-medium text-gray-700 mb-1">Status Peminjaman</label>
                    <select id="status_peminjaman" name="status_peminjaman" required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option {{ $peminjaman->status_peminjaman == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        <option {{ $peminjaman->status_peminjaman == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                        <option {{ $peminjaman->status_peminjaman == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                    </select>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-6 flex items-center justify-end gap-3">
                <a href="{{ route('admin.peminjaman.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-500 transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
