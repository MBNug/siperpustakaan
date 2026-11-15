<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            [
                'kode' => 'TEK000001',
                'judul' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
                'pengarang' => 'Robert C. Martin',
                'terbit' => 2021,
                'kategori' => 'Teknologi',
                'jumlah' => 12,
                'dipinjam' => 1,
            ],
            [
                'kode' => 'TEK000002',
                'judul' => 'Designing Data-Intensive Applications',
                'pengarang' => 'Martin Kleppmann',
                'terbit' => 2022,
                'kategori' => 'Teknologi',
                'jumlah' => 8,
                'dipinjam' => 0,
            ],
            [
                'kode' => 'TEK000003',
                'judul' => 'Arsitektur Aplikasi Web Modern dengan Laravel',
                'pengarang' => 'Budi Santoso',
                'terbit' => 2023,
                'kategori' => 'Teknologi',
                'jumlah' => 15,
                'dipinjam' => 0,
            ],
            [
                'kode' => 'TEK000004',
                'judul' => 'Algoritma dan Struktur Data dengan Python',
                'pengarang' => 'Rahmat Hidayat',
                'terbit' => 2024,
                'kategori' => 'Teknologi',
                'jumlah' => 10,
                'dipinjam' => 2,
            ],
            [
                'kode' => 'BHS000001',
                'judul' => 'Pedoman Umum Ejaan Bahasa Indonesia & Karya Ilmiah',
                'pengarang' => 'Dr. Siti Aminah',
                'terbit' => 2021,
                'kategori' => 'Bahasa',
                'jumlah' => 14,
                'dipinjam' => 1,
            ],
            [
                'kode' => 'BHS000002',
                'judul' => 'Academic Writing for University Students',
                'pengarang' => 'Alice Oshima',
                'terbit' => 2020,
                'kategori' => 'Bahasa',
                'jumlah' => 9,
                'dipinjam' => 0,
            ],
            [
                'kode' => 'SOS000001',
                'judul' => 'Sosiologi Masyarakat Digital di Indonesia',
                'pengarang' => 'Prof. Hendro Prasetyo',
                'terbit' => 2023,
                'kategori' => 'Sosial',
                'jumlah' => 10,
                'dipinjam' => 0,
            ],
            [
                'kode' => 'SOS000002',
                'judul' => 'Psikologi Kognitif dan Pengambilan Keputusan',
                'pengarang' => 'Nadia Kusuma',
                'terbit' => 2022,
                'kategori' => 'Sosial',
                'jumlah' => 7,
                'dipinjam' => 0,
            ],
            [
                'kode' => 'SNG000001',
                'judul' => 'Sejarah Nusantara: Dari Sriwijaya hingga Kemerdekaan',
                'pengarang' => 'Ahmad Mansur',
                'terbit' => 2021,
                'kategori' => 'Sejarah dan Geografi',
                'jumlah' => 11,
                'dipinjam' => 0,
            ],
            [
                'kode' => 'SNG000002',
                'judul' => 'Atlas Geografi Kepulauan Indonesia',
                'pengarang' => 'Dewi Lestari, M.Si.',
                'terbit' => 2024,
                'kategori' => 'Sejarah dan Geografi',
                'jumlah' => 6,
                'dipinjam' => 0,
            ],
            [
                'kode' => 'SNS000001',
                'judul' => 'Statistika Terapan untuk Penelitian Sains',
                'pengarang' => 'Dr. Agus Salim',
                'terbit' => 2023,
                'kategori' => 'Sains',
                'jumlah' => 10,
                'dipinjam' => 1,
            ],
            [
                'kode' => 'EKO000001',
                'judul' => 'Pengantar Ekonomi Digital dan Manajemen Inovasi',
                'pengarang' => 'Rina Kartika',
                'terbit' => 2024,
                'kategori' => 'Ekonomi',
                'jumlah' => 9,
                'dipinjam' => 0,
            ],
        ];

        foreach ($records as $record) {
            Book::firstOrCreate(['kode' => $record['kode']], $record);
        }
    }
}
