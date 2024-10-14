<?php

namespace App\Http\Controllers;

use App\Models\Well;
use Illuminate\Http\Request;

class WellController extends Controller
{
    // Получение скважин
    public function index(Request $request)
    {
        // Получить фильтры из запроса
        $field_id = $request->input('field_id');
        $is_saved = $request->input('is_saved');
        $well_type_id = $request->input('well_type_id');
        $well_status_id = $request->input('well_status_id');
        $well_numbers = $request->input('well_number'); // This is an array

        // Eager загрузка связанных моделей с необходимыми полями
        $query = Well::with(['field:id,name', 'wellType:id,name', 'wellStatus:id,name', 'horizon:id,name']);

        // Применить условия фильтрации
        if ($field_id) {
            $query->where('field_id', $field_id);
        }

        if (!is_null($is_saved)) {
            $query->where('is_saved', $is_saved);
        }

        if ($well_type_id) {
            $query->where('well_type_id', $well_type_id);
        }

        if ($well_status_id) {
            $query->where('well_status_id', $well_status_id);
        }

        if (!empty($well_numbers)) {
            $query->whereIn('well_number', $well_numbers);
        }

        $query->whereHas('field')
            ->whereHas('wellType')
            ->whereHas('wellStatus')
            ->whereHas('horizon');

        $savedWells = $query->get();

        return response()->json($savedWells, 200);
    }

    public function getWellNumbers(Request $request)
    {
        $is_saved = $request->input('is_saved');

        $query = Well::query()->select('well_number');

        if (!is_null($is_saved)) {
            $query->where('is_saved', $is_saved);
        }

        $wellNumbers = $query->get();

        return response()->json($wellNumbers, 200);
    }

    // Обновление данных скважин
    public function updateMultiple(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'wells' => 'required|array',
            'wells.*.id' => 'required|exists:wells,id',  // Ensure each well has a valid ID
            'wells.*.horizon_id' => 'nullable|exists:horizons,id',
            'wells.*.liquid_flow' => 'nullable|numeric',
            'wells.*.water_cut' => 'nullable|numeric',
            'wells.*.oil_density' => 'nullable|numeric',
            'wells.*.is_saved' => 'nullable|boolean',
        ]);

        // Iterate over each well and update them individually
        foreach ($validatedData['wells'] as $wellData) {
            // Find the well by its ID
            $well = Well::findOrFail($wellData['id']);

            // Update the well fields
            $well->update($wellData);
        }

        // Return a success response
        return response()->json(['message' => 'Wells updated successfully'], 200);
    }


    // Обновление данных скважины
    public function update(Request $request, $id)
    {
        $well = Well::findOrFail($id);
        $validatedData = $request->validate([
            'field' => 'required|string|max:255',
            'well_number' => 'required|string|max:255',
            'well_type' => 'required|string|max:255',
            'horizon' => 'required|string|max:255',
        ]);

        $well->update($validatedData);

        return response()->json($well, 200);
    }

    // Изменение статуса сохраненности
    public function toggleMultipleSave(Request $request)
    {

        $validatedData = $request->validate([
            'well_ids' => 'required|array',
            'well_ids.*' => 'required|exists:wells,id'
        ]);

        $wells = Well::whereIn('id', $validatedData['well_ids'])->get();

        foreach ($wells as $well) {
            $well->is_saved = !$well->is_saved;
            $well->save();
        }

        return response()->json([
            'message' => 'Статус сохранения изменен для нескольких скважин',
        ], 200);
    }

}
