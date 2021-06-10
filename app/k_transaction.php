<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class k_transaction extends Model
{
    protected $table = 'k_transactions';
    protected $fillable = [
        'user_id', 'tanggal',  'status', 'kode', 'jumlah_harga', 'ongkir', 'bukti_transfer', 'bukti_resi'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function k_detailtransaction()
    {
        return $this->hasMany('App\k_detailtransaction','k_transaction_id','id');
    }
}
