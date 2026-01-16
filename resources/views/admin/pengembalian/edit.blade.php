@extends('layouts.cms')

@section('content')
<div class="py-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Pengembalian</h1>
        <p class="text-sm text-gray-500">Ubah data pengembalian</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.pengembalian.update', $pengembalian->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Peminjam (Read-only) -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Peminjam</label>
                    <div class="w-full px-3 py-2 border border-gray-300 bg-gray-50 rounded-lg text-gray-700">
                        {{ $pengembalian->peminjaman->user->name }} ({{ $pengembalian->peminjaman->user->email }})
                    </div>
                </div>

                <!-- Tanggal Kembali -->
                <div>
                    <label for="tanggal_kembali" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" id="tanggal_kembali" value="{{ $pengembalian->tanggal_kembali }}" required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Kondisi Kembali -->
                <div>
                    <label for="kondisi_kembali" class="block text-sm font-medium text-gray-700 mb-1">Kondisi Kembali</label>
                    <select id="kondisi_kembali" name="kondisi_kembali" required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option {{ $pengembalian->kondisi_kembali == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option {{ $pengembalian->kondisi_kembali == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option {{ $pengembalian->kondisi_kembali == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                </div>

                <!-- Denda -->
                <div class="md:col-span-2">
                    <label for="denda" class="block text-sm font-medium text-gray-700 mb-1">Denda (Rp)</label>
                    <input type="number" name="denda" id="denda" value="{{ $pengembalian->denda }}" min="0" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-6 flex items-center justify-end gap-3">
                <a href="{{ route('admin.pengembalian.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-500 transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
