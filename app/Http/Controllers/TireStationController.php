<?php

namespace App\Http\Controllers;

use App\Models\TireService;
use App\Services\TireStationService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TireStationController extends Controller
{

    /**
     * @param Request $request
     * @param TireStationService $tireService
     * @return Response
     */
    public function index(Request $request, TireStationService $tireService) {

        $data = $tireService->index($request);

        return Inertia::render('TireStation/Index', ['data' => $data]);
    }

    public function show(TireService $tireService)
    {
        $data = $tireService->toArray();

        return Inertia::render('TireStation/Show', ['data' => $data]);
    }

    public function update(Request $request, $id, TireStationService $tireService)
    {
        $tireService->update($request, $id);

        return redirect()->route('tire-service.index')
            ->with('success', 'Запись успешно обновлена');
    }




}
