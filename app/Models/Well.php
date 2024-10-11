<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Well extends Model
{
    protected $fillable = [
        'field_id', 'well_number', 'well_type_id', 'well_status_id', 'horizon_id',
        'liquid_flow', 'water_cut', 'oil_density', 'oil_rate', 'is_saved'
    ];

    public function field()
    {
        return $this->belongsTo(Fields::class);
    }

    public function wellType()
    {
        return $this->belongsTo(WellTypes::class);
    }

    public function wellStatus()
    {
        return $this->belongsTo(WellStatuses::class);
    }

    public function horizon()
    {
        return $this->belongsTo(Horizons::class);
    }
}

