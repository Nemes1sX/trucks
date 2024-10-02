<?php

namespace App\Http\Controllers;

use App\Http\Resources\TruckResource;
use App\Interfaces\ITruckService;
use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    private readonly ITruckService $truckService;

    public function __construct(ITruckService $truckService)
    {
        $this->truckService = $truckService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $name = $request->get('name', '');
        $startYear = $request->get('start_year',  1900);
        $endYear = $request->get('end_year', date('Y') + 5);
        
        $trucks = $this->truckService->getAllTrucks($perPage, $startYear, $endYear, $name);

        return response()->json([
            'page' => $trucks->currentPage(),
            'data' => TruckResource::collection($trucks),
            'totalRecords' => $trucks->total(),
            'totalPages' => ceil($trucks->total()/$perPage)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Truck $truck)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Truck $truck)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Truck $truck)
    {
        //
    }
}
