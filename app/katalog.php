<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class katalog extends Model
{
    protected $table = 'katalogs';
    protected $fillable = [
        'nama_barang', 'harga',  'stok', 'deskripsi', 'gambar'
    ];

    public function k_detailtransaction()
    {
        return $this->hasMany('App\k_detailtransaction','katalog_id','id');
    }
}
