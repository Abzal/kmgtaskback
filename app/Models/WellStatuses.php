<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WellStatuses extends Model
{
    protected $fillable = ['name'];

    public function wells()
    {
        return $this->hasMany(Well::class);
    }
}
