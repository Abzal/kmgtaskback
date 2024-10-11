<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horizons extends Model
{
    protected $fillable = [ 'name', 'coefficient' ];

    public function wells()
    {
        return $this->hasMany(Well::class);
    }
}
