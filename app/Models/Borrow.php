<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;
    protected $fillable = ['kode_buku', 'nispeminjam', 'tanggalpinjam', 'tanggalwajibkembali', 'tanggalkembali', 'telat'];

    public function book()
    {
        return $this->belongsTo(Book::class,'kode_buku', 'kode');
    }

    public function member()
    {
        return $this->belongsTo(Member::class,'nispeminjam', 'nis');
    }
    
}
