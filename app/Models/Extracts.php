<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extracts extends Model
{
    protected $fillable = ['origin', 'destination', 'balance', 'newBalance'];

    public function account()
    {
        return $this->belongsTo(Accounts::class, 'origin', 'code');
    }
}
