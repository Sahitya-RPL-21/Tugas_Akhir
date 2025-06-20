@extends('newwelcome')

@section('content')
<div class="bg-gray-100 min-h-screen p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-4xl font-semibold text-gray-800">Kelola Barang</h1>
    </div>
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-xl shadow">
        <form action="{{ route('kelolabarang') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700">Kode Barang :</label>
                        <input type="string" name="kode_barang" class="w-full border rounded px-4 py-2" placeholder="Masukkan Nomor Barang">
                    </div>
                    <div>
                        <label class="block text-gray-700">Pilih Barang :</label>
                        <select name="barang" class="w-full border rounded px-4 py-2">
                            <option>Pilih Barang</option>
                            <!-- Tambahkan opsi barang -->
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700">Resleting :</label>
                        <select name="resleting" class="w-full border rounded px-4 py-2">
                            <option disabled selected>Pilih Resleting</option>
                            <option>Resleting Hijau Tua - 530</option>
                            <option>Resleting Merah - 519</option>
                            <option>Resleting Merah Maroon - 520</option>
                            <option>Resleting Biru Dongker - 560</option>
                            <option>Resleting Coklat - 570</option>
                            <option>Resleting 529</option>
                            <option>Resleting 540</option>
                            <option>Resleting Biru Muda - 550</option>
                            <option>Resleting 580 - Hitam</option>
                            <option>Resleting Abu-abu - 575</option>
                            <option>Ritz Besi Panjang</option>
                            <option>Ritz Binhur paud</option>
                            <option>Ritz besi kecil</option>
                            <option>Resleting Jepang Hijau Muda</option>
                            <option>Resleting Jepang Hijau Tua</option>
                            <option>Resleting Jepang Hitam</option>
                            <option>Resleting Jepang Coklat</option>
                            <option>Resleting Jepang Abu-abu</option>
                            <option>Ret Nusantara 7 (570)</option>
                            <option>Ret Nusantara 7 (575)</option>
                            <option>Ret Nusantara 7 (580)</option>
                            <option>Ret no.5 Hitam</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700">Jarum :</label>
                        <select name="jarum" class="w-full border rounded px-4 py-2">
                            <option disabled selected>Pilih Jarum</option>
                            <option>Jarum DB x 1 90/14</option>
                            <option>Jarum DB x 1 75/11</option>
                            <option>Jarum TQ x 1 90/14</option>
                            <option>Jarum UYX128GAS 85/13</option>
                            <option>Jarum UYX128GAS 75/11</option>
                            <option>Jarum DB x 1 100/16</option>
                            <option>Jarum DB x 1 85/13</option>
                            <option>Jarum DC x 1 90/14</option>
                            <option>Jarum DP x 5++ 90/14</option>
                            <option>Jarum Sum /jahit</option>
                            <option>Jarum Pentul</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700">Bed/Logo :</label>
                        <select name="bed_logo" class="w-full border rounded px-4 py-2">
                            <option>Pilih Bed/Logo</option>
                            <option>Bed - SMA TrenSains Logo</option>
                            <option>Bed - SMA TrenSains Lokasi</option>
                            <option>Bed - SMP Sains Logo</option>
                            <option>Bed - SMP Sains Lokasi</option>
                            <option>Bed - SMP AWH Logo (osis)</option>
                            <option>Bed - SMP AWH Lokasi</option>
                            <option>Bed - MTs SS Logo</option>
                            <option>Bed - MTs SS Lokasi</option>
                            <option>Bed - SMA AWH Logo</option>
                            <option>Bed - SMA AWH Lokasi</option>
                            <option>Bed - MASS Logo</option>
                            <option>Bed - MASS Lokasi</option>
                            <option>Bed - Bendera M/P</option>
                            <option>Bed - MTs Sains Logo</option>
                            <option>Bed - MTs Sains Lokasi</option>
                            <option>Bed - MA Sain logo</option>
                            <option>Bed - MA Sain lokasi</option>
                            <option>Bed - Pramuka Tunas</option>
                            <option>Bed - Jombang</option>
                            <option>Bed - Jawa Timur</option>
                            <option>Bed - Scoma MQ</option>
                            <option>Bed - Tunas Bordir</option>
                            <option>Bed - Jombang Bordir</option>
                            <option>Bed - Jawa Timur Bordir</option>
                            <option>Bed - Lily Bordir</option>
                            <option>Bed - Tebuireng Segitiga</option>
                            <option>Bed - Songkok</option>
                            <option>Bed - SMK Khoiriyah Hasyim Logo</option>
                            <option>Bed - SMK Khoiriyah Hasyim Lokasi</option>
                            <option>Bed - SDI Tebuireng Logo</option>
                            <option>Bed - SDI Tebuireng Lokasi</option>
                            <option>Bed - Sarung TBI</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700">Kancing :</label>
                        <select name="kancing" class="w-full border rounded px-4 py-2">
                            <option>Pilih Kancing</option>
                            <option>Kancing Kecil Putih</option>
                            <option>Kancing Kecil Pramuka</option>
                            <option>Kancing Kecil Coklat Batik</option>
                            <option>Kancing Besar Hijau</option>
                            <option>Kancing Besar Hitam</option>
                            <option>Kancing Besar Biru Dongker</option>
                            <option>kancing Celana Biru pom 695</option>
                            <option>Kancing Besar Abu-abu</option>
                            <option>Kancing Besar Putih</option>
                            <option>Kancing Besar Coklat</option>
                            <option>Kancing Jas Hitam Besar</option>
                            <option>Kancing Jas Hitam Kecil</option>
                            <option>Kancing Jas Abu-abu Besar</option>
                            <option>Kancing Jas Abu-abu Kecil</option>
                            <option>Kancing Tulip Hijau Tua Besar</option>
                            <option>Kancing Tulip Hitam Besar</option>
                            <option>Kancing Tulip Pramuka 750P</option>
                            <option>Kancing Tulip Pramuka Besar</option>
                            <option>Kancing Tulip Putih</option>
                            <option>Kancing Tulips MTS 711p</option>
                            <option>Kancing tulip Hitam</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700">Kategori Barang :</label>
                        <select name="kategori" class="w-full border rounded px-4 py-2">
                            <option>Pilih Kategori</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700">Satuan :</label>
                        <select name="satuan" class="w-full border rounded px-4 py-2">
                            <option>Pilih Satuan</option>
                            <option>Lusin</option>
                            <option>Biji</option>
                            <option>Rol</option>
                            <option>Kotak</option>
                            <option>Ball</option>
                            <option>KG</option>
                            <option>Pack</option>
                            <option>Mass</option>
                            <option>Gross</option>
                            <option>Rol/10</option>
                            <option>Pack / (isi 3)</option>
                            <option>Meter/Pis</option>
                            <option>Yard</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700">Benang :</label>
                        <select name="benang" class="w-full border rounded px-4 py-2">
                            <option disabled selected>Pilih Benang</option>
                            <option>Benang 500 y - Merah Tua - 111B</option>
                            <option>Benang 500 y - Krem - 173</option>
                            <option>Benang 500 y - Hijau Tua - 937</option>
                            <option>Benang 500 y - White</option>
                            <option>Benang 500 y - Coklat tua - 778</option>
                            <option>Benang 500 y - Biru Dongker - 398</option>
                            <option>Benang 500 y - Coklat Atasan - 1178</option>
                            <option>Benang 500 y - Biru - 8080</option>
                            <option>Benang 500 y - Natural</option>
                            <option>Benang 500 y - Black</option>
                            <option>Benang 500 y - Abu-abu - 254</option>
                            <option>Benang 5000 Y 173</option>
                            <option>Benang 5000 Y 209</option>
                            <option>Benang 5000 Y Abu-Abu 747</option>
                            <option>Benang 5000 Y Bidong 398</option>
                            <option>Benang 5000 Y Coklat Susu 1178</option>
                            <option>Benang 5000 Y Coklat Tua 778</option>
                            <option>Benang 5000 Y Hijau 937</option>
                            <option>Benang 5000 Y Hitam</option>
                            <option>Benang 5000 Y Krem 735</option>
                            <option>Benang 5000 Y Merah Hati 111 B</option>
                            <option>Benang 5000 Y Natural</option>
                            <option>Benang 5000 Y Putih</option>
                            <option>Benang poly taka</option>
                            <option>Benang Angsa Dunia</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700">Benang Bordir :</label>
                        <select name="benang_bordir" class="w-full border rounded px-4 py-2">
                            <option>Pilih Benang Bordir</option>
                            <option>Benang 102 - Biru Tosca</option>
                            <option>Benang 38 - Pink</option>
                            <option>Benang 61 - Natural</option>
                            <option>Benang 1183 - Natural</option>
                            <option>Benang 308 - Oren</option>
                            <option>Benang A34 - Oren</option>
                            <option>Benang 55 - Oren</option>
                            <option>Benang 324 - Biru Dongker</option>
                            <option>Benang 3150 - Hitan</option>
                            <option>Benang C120 - Natural</option>
                            <option>Benang 44 - Coklat Kekuningan</option>
                            <option>Benang 189 - Abu-abu Biru</option>
                            <option>Benang 28 - Merah Maroon</option>
                            <option>Benang 94 - Hijau Muda</option>
                            <option>Benang 1120 - Hijau Kekuningan</option>
                            <option>Benang 25 (Merah)</option>
                            <option>Benang W30 - Ungu</option>
                            <option>Benang 80 - Hijau Tua</option>
                            <option>Benang Putih</option>
                            <option>Benang 3249 - Putih</option>
                            <option>Benang 50 - Kuning</option>
                            <option>Benang 64 - Natural Kekuningan</option>
                            <option>Benang 321 - Biru Tua</option>
                            <option>Benang 60 - Oren</option>
                            <option>Benang 143 - Biru</option>
                            <option>Benang A29 - Biru</option>
                            <option>Benang 84 - Hijau Kekuningan Darker</option>
                            <option>Benang W58 - Ungu</option>
                            <option>Benang 85 - Hijau Tua Brighter</option>
                            <option>Benang 112 - Hijau Lumut</option>
                            <option>Benang 148 - Biru Dongker</option>
                            <option>benang 3195 - Biru Laut</option>
                            <option>Benang Yellow</option>
                            <option>Benang 3156 - Kuning</option>
                            <option>Benang 320 - Biru</option>
                            <option>Bennag 1129 - Natural</option>
                            <option>Benang 139 - Biru Muda</option>
                            <option>Benang 443 - Kuning Keemasan</option>
                            <option>Benang 3045 - Merah Saos Tomat</option>
                            <option>Benang Metallic FMS4104 - Emas Glitter</option>
                            <option>Benang Spull Top Putih Kecil</option>
                            <option>Benang Spull Putih Besar</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700">Kapur :</label>
                        <select name="kapur" class="w-full border rounded px-4 py-2">
                            <option>Pilih Kapur</option>
                            <option>Kapur Biru Pensil</option>
                            <option>Kapur Hijau Pensil</option>
                            <option>Kapur Kuning Pensil</option>
                            <option>Kapur Merah Pensil</option>
                            <option>Kapur Putih Pensil</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700">Perlengkapan :</label>
                        <select name="perlengkapan" class="w-full border rounded px-4 py-2">
                            <option>Pilih Perlengkapan</option>
                            <option>Bisban</option>
                            <option>Bisban Satin 130 Ungu</option>
                            <option>Gunting Bordir</option>
                            <option>Hak</option>
                            <option>Karet 3M</option>
                            <option>Karet Bell</option>
                            <option>Kertas Lica M5</option>
                            <option>Label LKP-TPKU Uk. 5.50*10.00</option>
                            <option>Label Size Tebal Uk 2.50*7.00</option>
                            <option>Peding jas putih</option>
                            <option>Peles</option>
                            <option>Peles Merah</option>
                            <option>Pendedel Besi</option>
                            <option>Pendedel Kayu</option>
                            <option>Pisau Lubang Kancing</option>
                            <option>Pisau Potong</option>
                            <option>RIP CM Misty Muda</option>
                            <option>Renda Emas</option>
                            <option>Renda Merah</option>
                            <option>Renda Coklat</option>
                            <option>Renda Putih</option>
                            <option>Sarangan</option>
                            <option>Skoci Mesin bordir</option>
                            <option>Skoci Overnack</option>
                            <option>Spul Mesin Kecil</option>
                            <option>Areng besar</option>
                            <option>Besi 14 Cm</option>
                            <option>Bulanan</option>
                            <option>Tension benang/kecer</option>
                            <option>Skoci lubang kancing</option>
                            <option>Dek bulan</option>
                            <option>Dek kotak</option>
                            <option>Gigi</option>
                            <option>Gunting cekit</option>
                            <option>Lampu</option>
                            <option>Mata Nenek</option>
                            <option>Meteran besar</option>
                            <option>Pisau obras</option>
                            <option>Ritz Jpg Merah</option>
                            <option>Sepatu</option>
                            <option>Pita Coklat</option>
                            <option>Pita Putih</option>
                            <option>Pita Hijau Muda</option>
                            <option>Pita Hijau Tua</option>
                            <option>Pita Hitam</option>
                            <option>Biru Dongker</option>
                            <option>Pita Biru Muda</option>
                            <option>Pita Emas</option>
                            <option>Viselin Tangerine 39&quot;/40&quot; x 50 YDS</option>
                            <option>Kapas Megalon 50 F 36&quot; x 50 YDS</option>
                            <option>Kapas Megalon 50 N 36&quot; x 50 YDS</option>
                            <option>Megalon 25 F 36&quot; x 50 YDS</option>
                            <option>Megalon Kaktus 35&quot;/36&quot; x 30 YDS</option>
                            <option>Inter Lining Top Fuse M33H</option>
                            <option>Kepala Resleting Plastik Hitam</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-6 text-center">
                <button type="submit" class="bg-green-800 hover:bg-green-700 text-white px-6 py-2 rounded-lg shadow">
                    Buat
                </button>
            </div>
        </form>
    </div>
</div>

@if(session('success'))
<!-- Modal Background -->
<div id="ModalBerhasil" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <!-- Modal Content -->
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full text-center">
        <h2 class="text-2xl font-semibold mb-4 text-green-700">Berhasil!</h2>
        <p class="mb-6 text-gray-700">{{ session('success') }}</p>
        @if(session('details'))
            <div class="mb-4 text-left bg-gray-50 p-4 rounded border border-green-200">
                <h3 class="font-semibold text-green-800 mb-2">Rincian:</h3>
                <ul class="list-disc list-inside text-gray-700">
                    @foreach(session('details') as $key => $value)
                        <li><span class="font-medium">{{ $key }}:</span> {{ $value }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button onclick="document.getElementById('successModal').style.display='none'" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded">
            Tutup
        </button>
    </div>
</div>
<script>
    document.addEventListener('keydown', function(event) {
        if(event.key === "Escape") {
            document.getElementById('successModal').style.display = 'none';
        }
    });
</script>
@endif
@endsection