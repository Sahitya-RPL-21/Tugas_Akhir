@extends('newwelcome')

@section('page_title','Pengajuan Produksi')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-4xl font-bold mb-6 text-gray-800">Pengajuan Produksi</h1>

        {{-- Alert --}}
        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">{{ session('error') }}</div>
        @endif

        {{-- Tabel --}}
        <div class="overflow-x-auto bg-white rounded-lg shadow mt-6">
            <table class="min-w-full w-full text-gray-700">
                <thead class="bg-[#173720] text-white text-sm uppercase">
                    <tr>
                        <th class="p-4 text-center">ID</th>
                        <th class="p-4 text-center">Kode Barang</th>
                        <th class="p-4 text-center">Nama Barang</th>
                        <th class="p-4 text-center">Stok Barang</th>
                        <th class="p-4 text-center">Jumlah Pengajuan</th>
                        <th class="p-4 text-center">Tanggal Pengajuan</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengajuanProduksi as $pj)
                    <tr class="border-b hover:bg-red-50 transition">
                        <td class="p-4 text-center">{{ $pj->id }}</td>
                        <td class="p-4 text-center">{{ $pj->barangMentah->kode_barang ?? '-' }}</td>
                        <td class="p-4 text-center">{{ $pj->barangMentah->nama_barang ?? '-' }}</td>
                        <td class="p-4 text-center">{{ $pj->barangMentah->stok_barang ?? '-' }}</td>
                        <td class="p-4 text-center">{{ $pj->jumlah_pengajuan }}</td>
                        <td class="p-4 text-center">
                            {{ $pj->tanggal_pengajuan ? $pj->tanggal_pengajuan->format('d-m-Y H:i') : '-' }}
                        </td>
                        <td class="p-4 text-center">
                            <form action="{{ route('pengajuanproduksi.keputusan', $pj->id) }}" method="POST" class="flex justify-center gap-2">
                                @csrf
                                @method('PUT')
                                <button type="submit" name="keputusan" value="diterima" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                    Terima
                                </button>
                                <button type="submit" name="keputusan" value="ditolak" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                    Tolak
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-4 text-center text-gray-500">Belum ada pengajuan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection