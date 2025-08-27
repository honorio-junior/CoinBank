<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    protected $fillable = ['user_id', 'code', 'status', 'balance'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function extracts()
    {
        return $this->hasMany(Extracts::class, 'origin', 'code');
    }
}
