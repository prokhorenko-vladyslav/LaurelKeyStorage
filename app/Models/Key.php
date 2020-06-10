<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    protected $fillable = [
        'name', 'host', 'login', 'password', 'filepath'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
