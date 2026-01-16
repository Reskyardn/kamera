@extends('layouts.cms')

@section('content')
<div class="py-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Tambah Peminjaman</h1>
        <p class="text-sm text-gray-500">Buat transaksi peminjaman baru</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.peminjaman.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- User / Peminjam -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Peminjam</label>
                    @if(auth()->user()->role === 'admin')
                    <select id="user_id" name="user_id" required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Pilih Peminjam</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>
                        @endforeach
                    </select>
                    @else
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="w-full px-3 py-2 border border-gray-300 bg-gray-50 rounded-lg text-gray-700">
                        {{ auth()->user()->name }} ({{ auth()->user()->email }})
                    </div>
                    @endif
                </div>

                <!-- Kamera -->
                <div>
                    <label for="kamera_id" class="block text-sm font-medium text-gray-700 mb-1">Kamera</label>
                    <select id="kamera_id" name="kamera_id" required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Pilih Kamera (Tersedia)</option>
                        @foreach($kameras as $kamera)
                            <option value="{{ $kamera->id }}">{{ $kamera->nama_kamera }} - {{ $kamera->merk }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal Pinjam -->
                <div>
                    <label for="tanggal_pinjam" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <!-- Rencana Kembali -->
                <div>
                    <label for="tanggal_kembali_rencana" class="block text-sm font-medium text-gray-700 mb-1">Rencana Kembali</label>
                    <input type="date" name="tanggal_kembali_rencana" id="tanggal_kembali_rencana" required 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-6 flex items-center justify-end gap-3">
                <a href="{{ route('admin.peminjaman.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-500 transition-colors">
                    Simpan Peminjaman
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
