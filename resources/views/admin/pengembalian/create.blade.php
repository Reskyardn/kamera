@extends('layouts.cms')

@section('content')
<div class="py-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Proses Pengembalian</h1>
        <p class="text-sm text-gray-500">Catat pengembalian kamera</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.pengembalian.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Peminjaman -->
                <div class="md:col-span-2">
                    <label for="peminjaman_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Peminjaman</label>
                    <select id="peminjaman_id" name="peminjaman_id" required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">-- Pilih Peminjaman Aktif --</option>
                        @foreach($peminjamans as $p)
                            <option value="{{ $p->id }}" {{ $peminjaman && $peminjaman->id == $p->id ? 'selected' : '' }}>
                                {{ $p->user->name }} - Pinjam: {{ $p->tanggal_pinjam }} (Rencana: {{ $p->tanggal_kembali_rencana }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal Kembali -->
                <div>
                    <label for="tanggal_kembali" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" id="tanggal_kembali" value="{{ date('Y-m-d') }}" required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Kondisi Kembali -->
                <div>
                    <label for="kondisi_kembali" class="block text-sm font-medium text-gray-700 mb-1">Kondisi Kembali</label>
                    <select id="kondisi_kembali" name="kondisi_kembali" required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="Baik">Baik</option>
                        <option value="Rusak Ringan">Rusak Ringan</option>
                        <option value="Rusak Berat">Rusak Berat</option>
                    </select>
                </div>

                <!-- Denda -->
                <div class="md:col-span-2">
                    <label for="denda" class="block text-sm font-medium text-gray-700 mb-1">Denda (Rp)</label>
                    <input type="number" name="denda" id="denda" value="0" min="0" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <p class="text-xs text-gray-500 mt-1">Masukkan 0 jika tidak ada denda</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-6 flex items-center justify-end gap-3">
                <a href="{{ route('admin.pengembalian.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-500 transition-colors">
                    Simpan Pengembalian
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
