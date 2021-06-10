<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class k_detailtransaction extends Model
{
    protected $table = 'k_detailtransactions';
    protected $fillable = [
        'katalog_id', 'k_transaction_id',  'jumlah', 'jumlah_harga'
    ];

    public function katalog()
    {
        return $this->belongsTo('App\katalog','katalog_id','id');
    }

    public function k_transaction()
    {
        return $this->belongsTo('App\k_transaction','k_transaction_id','id');
    }
}
