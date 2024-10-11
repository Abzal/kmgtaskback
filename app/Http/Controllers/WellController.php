<?php

namespace App\Http\Controllers;

use App\Models\Well;
use Illuminate\Http\Request;

class WellController extends Controller
{
    // Получение всех скважин
    public function index()
    {
        {
            // Eager load related models with necessary fields
            $savedWells = Well::with(['field:id,name', 'wellType:id,name', 'wellStatus:id,name', 'horizon:id,name'])
                ->whereHas('field') // Ensure only wells with associated fields are included
                ->whereHas('wellType') // Ensure only wells with associated well types are included
                ->whereHas('wellStatus') // Ensure only wells with associated well statuses are included
                ->whereHas('horizon') // Ensure only wells with associated horizons are included
                ->get();

            return response()->json($savedWells, 200);
        }
    }

    // Получение информации о конкретной скважине
    public function show($id)
    {
        $well = Well::findOrFail($id);
        return response()->json($well, 200);
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
    public function toggleSave($id)
    {
        $well = Well::findOrFail($id);
        $well->is_saved = !$well->is_saved;
        $well->save();

        return response()->json([
            'message' => 'Статус сохранения изменен',
            'well' => $well
        ], 200);
    }
}
