<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WellTypes extends Model
{
    protected $fillable = ['name'];

    public function wells()
    {
        return $this->hasMany(Well::class);
    }
}
