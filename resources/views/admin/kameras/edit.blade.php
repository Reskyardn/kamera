@extends('layouts.cms')

@section('content')
<div class="py-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Kamera</h1>
        <p class="text-sm text-gray-500">Ubah data kamera</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.kameras.update', $kamera->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Kamera -->
                <div>
                    <label for="nama_kamera" class="block text-sm font-medium text-gray-700 mb-1">Nama Kamera</label>
                    <input type="text" name="nama_kamera" id="nama_kamera" value="{{ $kamera->nama_kamera }}" required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Merk -->
                <div>
                    <label for="merk" class="block text-sm font-medium text-gray-700 mb-1">Merk</label>
                    <input type="text" name="merk" id="merk" value="{{ $kamera->merk }}" required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Tipe -->
                <div>
                    <label for="tipe" class="block text-sm font-medium text-gray-700 mb-1">Tipe</label>
                    <input type="text" name="tipe" id="tipe" value="{{ $kamera->tipe }}" required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Stok -->
                <div>
                    <label for="stok" class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                    <input type="number" name="stok" id="stok" value="{{ $kamera->stok }}" required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Kondisi -->
                <div>
                    <label for="kondisi" class="block text-sm font-medium text-gray-700 mb-1">Kondisi</label>
                    <select id="kondisi" name="kondisi" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option {{ $kamera->kondisi == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option {{ $kamera->kondisi == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option {{ $kamera->kondisi == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                </div>

                <!-- Status Ketersediaan -->
                <div>
                    <label for="status_ketersediaan" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="status_ketersediaan" name="status_ketersediaan" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option {{ $kamera->status_ketersediaan == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option {{ $kamera->status_ketersediaan == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        <option {{ $kamera->status_ketersediaan == 'Perawatan' ? 'selected' : '' }}>Perawatan</option>
                    </select>
                </div>

                <!-- Spesifikasi -->
                <div class="md:col-span-2">
                    <label for="spesifikasi" class="block text-sm font-medium text-gray-700 mb-1">Spesifikasi</label>
                    <textarea id="spesifikasi" name="spesifikasi" rows="3" required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ $kamera->spesifikasi }}</textarea>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-6 flex items-center justify-end gap-3">
                <a href="{{ route('admin.kameras.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-500 transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
