<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class manager extends Model
{
    protected $table = 'managers';
    protected $fillable = [
        'user_id', 'nama',  'tanggal_lahir', 'alamat', 'no_hp', 'foto'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
