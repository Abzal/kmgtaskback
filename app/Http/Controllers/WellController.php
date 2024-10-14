<?php

namespace App\Http\Controllers;

use App\Models\Well;
use Illuminate\Http\Request;

class WellController extends Controller
{
    /* Получение скважин*/
    public function index(Request $request)
    {
        /*Получить фильтры из запроса*/
        $field_id = $request->input('field_id');
        $is_saved = $request->input('is_saved');
        $well_type_id = $request->input('well_type_id');
        $well_status_id = $request->input('well_status_id');
        $well_numbers = $request->input('well_number'); // This is an array

        /*Eager загрузка связанных моделей с необходимыми полями*/
        $query = Well::with(['field:id,name', 'wellType:id,name', 'wellStatus:id,name', 'horizon:id,name']);

        /*Применить условия фильтрации*/
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

    /*Обновление данных скважин*/
    public function updateMultiple(Request $request)
    {
        $validatedData = $request->validate([
            'wells' => 'required|array',
            'wells.*.id' => 'required|exists:wells,id',
            'wells.*.horizon_id' => 'nullable|exists:horizons,id',
            'wells.*.liquid_flow' => 'nullable|numeric',
            'wells.*.water_cut' => 'nullable|numeric',
            'wells.*.oil_density' => 'nullable|numeric',
            'wells.*.is_saved' => 'nullable|boolean',
        ]);

        foreach ($validatedData['wells'] as $wellData) {
            $well = Well::findOrFail($wellData['id']);

            $well->update($wellData);
        }

        return response()->json(['message' => 'Скважины обнавлены успешно'], 200);
    }

     /*Изменение статуса сохраненности*/
    public function toggleSaveStatus(Request $request, $status)
    {
        $validatedData = $request->validate([
            'well_numbers' => 'required|array',
            'well_numbers.*' => 'required|exists:wells,well_number'
        ]);

        $wells = Well::whereIn('well_number', $validatedData['well_numbers'])->get();

        foreach ($wells as $well) {
            $well->is_saved = $status;
            $well->save();
        }

        $message = $status ? 'Скважины сохранены' : 'Скважины удалены из сохраненных';

        return response()->json([
            'message' => $message
        ], 200);
    }

    public function saveMultiple(Request $request)
    {
        return $this->toggleSaveStatus($request, 1);
    }
    public function unsaveMultiple(Request $request)
    {
        return $this->toggleSaveStatus($request, 0);
    }

}
