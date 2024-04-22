<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $namaOrang = [
            'Adi', 'Budi', 'Citra', 'Dewi', 'Eka', 'Fandi', 'Gita', 'Hani', 'Indra', 'Joko', 'Kartika', 'Lina', 'Mega', 'Nadia', 'Oscar', 'Putri', 'Rudi', 'Siti', 'Tono', 'Wulan'
        ];
        $alamat = [
            'Jalan Melati',
            'Jalan Anggrek',
            'Jalan Mawar',
            'Jalan Kamboja'
        ];

        for ($i = 1; $i <= 20; $i++) {
            $namaIndex = rand(0, count($namaOrang) - 1); // Pilih indeks acak dari daftar nama
            $alamatIndex = rand(0, count($alamat) - 1); // Pilih indeks acak dari daftar alamat
            $nama = $namaOrang[$namaIndex];
            $nis = '123456789' . $i;

            Siswa::create([
                'name' => $nama,
                'nis' => $nis,
                'alamat' => $alamat[$alamatIndex], // Tambahkan nomor unik setelah alamat
            ]);
        }
    }
}
