<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTruckRequest;
use App\Http\Requests\UpdateTruckRequest;
use App\Http\Resources\SingleTruckResource;
use App\Http\Resources\TruckResource;
use App\Interfaces\ITruckService;
use App\Models\Truck;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
    public function store(StoreTruckRequest $request)
    {
        Truck::create($request->validated());

        return response()->json([
            'message' => 'Truck registered'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Truck $truck) : JsonResource
    {
        return SingleTruckResource::make($truck);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTruckRequest $request, Truck $truck)
    {
        $truck->update($request->validated());

        return response()->json([
            'message' => 'Truck registration data was updated'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Truck $truck) : JsonResponse
    {
        $truck->delete();

        return response()->json([], 204);
    }
}
