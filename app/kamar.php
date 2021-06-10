<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kamar extends Model
{
    protected $table = 'kamars';
    protected $fillable = [
        'nama_barang', 'harga',  'booking', 'deskripsi', 'gbrkamar'
    ];
}
