<?php

namespace App\Http\Controllers;

use App\Models\Fields;
use App\Models\Horizons;
use App\Models\WellStatuses;
use App\Models\WellTypes;
use Illuminate\Http\Request;

class HandBookController extends Controller
{
      public function index()
    {
        $fields = Fields::get();
        $horizons = Horizons::get();
        $wellStatuses = WellStatuses::get();
        $wellTypes = WellTypes::get();

        return response()->json([
            "fields" => $fields,
            "horizons" => $horizons,
            "wellStatuses" => $wellStatuses,
            "wellTypes" => $wellTypes
        ], 200);
    }
}
