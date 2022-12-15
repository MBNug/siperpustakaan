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
                'id' => 1,
                'kode' => 'TEK000001',
                'judul' => 'Youtube untuk pemula',
                'pengarang' => 'Atta Halilintar',
                'terbit' => 2020,
                'kategori' => 'Teknologi',
                'jumlah' => 24,
                'dipinjam' => 1,

            ],
            [
                'id' => 2,
                'kode' => 'TEK000002',
                'judul' => 'Cara menggunakan google secara efketif',
                'pengarang' => 'Siri',
                'terbit' => 2022,
                'kategori' => 'Teknologi',
                'jumlah' => 22,

            ],
            [
                'id' => 3,
                'kode' => 'BHS000001',
                'judul' => 'Bahasa Indonesia yang baik dan benar',
                'pengarang' => 'Willy the kid',
                'terbit' => 2021,
                'kategori' => 'Bahasa',
                'jumlah' => 20,
                'dipinjam' => 1,

            ],
            [
                'id' => 4,
                'kode' => 'SOS000001',
                'judul' => 'Bagaimana cara mendapatkan teman',
                'pengarang' => 'Ansos Corporation',
                'terbit' => 2025,
                'kategori' => 'Sosial',
                'jumlah' => 24,
                

            ],
            [
                'id' => 5,
                'kode' => 'SNG000001',
                'judul' => 'Sejarah kekaisaran Islam di Indonesia',
                'pengarang' => 'Ust. Zakir Naik',
                'terbit' => 2022,
                'kategori' => 'Sejarah dan Geografi',
                'jumlah' => 24,
                

            ],
            [
                'id' => 6,
                'kode' => 'TEK000003',
                'judul' => 'Youtube untuk pemula edisi 2',
                'pengarang' => 'Atta Halilintar',
                'terbit' => 2020,
                'kategori' => 'Teknologi',
                'jumlah' => 24,

            ],
            [
                'id' => 7,
                'kode' => 'TEK000004',
                'judul' => 'Cara menggunakan google secara efketif edisi 2',
                'pengarang' => 'Siri',
                'terbit' => 2022,
                'kategori' => 'Teknologi',
                'jumlah' => 22,
                'dipinjam' => 2,

            ],
            [
                'id' => 8,
                'kode' => 'BHS000002',
                'judul' => 'Bahasa Indonesia yang baik dan benar edisi 2',
                'pengarang' => 'Willy the kid',
                'terbit' => 2021,
                'kategori' => 'Bahasa',
                'jumlah' => 20,
                

            ],
            [
                'id' => 9,
                'kode' => 'SOS000002',
                'judul' => 'Bagaimana cara mendapatkan teman edisi 2',
                'pengarang' => 'Ansos Corporation',
                'terbit' => 2025,
                'kategori' => 'Sosial',
                'jumlah' => 24,
                

            ],
            [
                'id' => 10,
                'kode' => 'SNG000002',
                'judul' => 'Sejarah kekaisaran Islam di Indonesia edisi 2',
                'pengarang' => 'Ust. Zakir Naik',
                'terbit' => 2022,
                'kategori' => 'Sejarah dan Geografi',
                'jumlah' => 24,
                

            ],
            [
                'id' => 11,
                'kode' => 'SNG000003',
                'judul' => 'Penjajahan Belanda',
                'pengarang' => 'Shogun',
                'terbit' => 2022,
                'kategori' => 'Sejarah dan Geografi',
                'jumlah' => 24,
                

            ],
        ];
        foreach ($records as $record) {
            $book = new Book();
            $book->firstOrCreate($record);
        }
    }
}
