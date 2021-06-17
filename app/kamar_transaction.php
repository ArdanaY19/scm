<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kamar_transaction extends Model
{
    protected $table = 'kamar_transactions';
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    public function kamar()
    {
        return $this->belongsTo('App\kamar','kamar_id','id');
    }
}
