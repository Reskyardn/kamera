@extends('layouts.cms')

@section('content')
<div class="py-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Detail Peminjaman</h1>
            <p class="text-sm text-gray-500">Informasi lengkap peminjaman #{{ $peminjaman->id }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.peminjaman.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">
                Kembali
            </a>
            @if($peminjaman->status_peminjaman == 'Dipinjam')
            <a href="{{ route('admin.pengembalian.create', ['peminjaman_id' => $peminjaman->id]) }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-500">
                Proses Pengembalian
            </a>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Info Peminjam & Status -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Informasi Peminjaman</h3>
                </div>
                <div class="px-6 py-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Nama Peminjam</span>
                        <span class="mt-1 block text-gray-900">{{ $peminjaman->user->name }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Email</span>
                        <span class="mt-1 block text-gray-900">{{ $peminjaman->user->email }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Tanggal Pinjam</span>
                        <span class="mt-1 block text-gray-900 font-medium">{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->translatedFormat('d F Y') }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Rencana Kembali</span>
                        <span class="mt-1 block text-gray-900 font-medium">{{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali_rencana)->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="md:col-span-2">
                        <span class="block text-sm font-medium text-gray-500 mb-1">Status</span>
                        @if($peminjaman->status_peminjaman == 'Dipinjam')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                Sedang Dipinjam
                            </span>
                        @elseif($peminjaman->status_peminjaman == 'Dikembalikan')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Sudah Dikembalikan
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                {{ $peminjaman->status_peminjaman }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Detail Barang -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Barang Dipinjam</h3>
                </div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kamera</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Merk</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($peminjaman->detailPeminjaman as $detail)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                                {{ $detail->kamera->nama_kamera }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $detail->kamera->merk }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $detail->jumlah }} Unit
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Log / Timeline (Optional Placeholder) -->
        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Catatan</h3>
                <p class="text-sm text-gray-500">
                    Peminjaman dibuat pada {{ $peminjaman->created_at->format('d/m/Y H:i') }}
                </p>
                @if($peminjaman->status_peminjaman == 'Dikembalikan')
                    <p class="text-sm text-gray-500 mt-2">
                        Dikembalikan pada {{ optional($peminjaman->pengembalian)->tanggal_kembali ?? '-' }}
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
