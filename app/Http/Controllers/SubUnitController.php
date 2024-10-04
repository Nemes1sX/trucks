<?php

namespace App\Http\Controllers;

use App\Models\SubUnit;
use App\Http\Requests\StoreSubUnitRequest;
use App\Http\Requests\UpdateSubUnitRequest;
use App\Http\Resources\SubUnitResource;
use App\Interfaces\ISubUnitService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubUnitController extends Controller
{
    private readonly ISubUnitService $subUnitService;

    public function __construct(ISubUnitService $subUnitService)
    {
        $this->subUnitService = $subUnitService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : JsonResponse
    {
        $perPage = $request->get('per_page', 10);
        $mainTruck = $request->get('main_truck');
        $subUnit = $request->get('sub_unit');
        $startDate = $request->get('start_year',  '');
        $endDate = $request->get('end_year', '');

        $subUnits = $this->subUnitService->getAllSubUnits($perPage, $mainTruck, $subUnit, $startDate, $endDate);

        return response()->json([
            'page' => $subUnits->currentPage(),
            'data' => SubUnitResource::collection($subUnits),
            'totalRecords' => $subUnits->total(),
            'totalPages' => ceil($subUnits->total()/$perPage)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubUnitRequest $request) : JsonResponse
    {
        SubUnit::create($request->validated());

        return response()->json([
            'message' => 'Subunit was registered'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SubUnit $subUnit) : JsonResource
    {
        return SubUnitResource::make($subUnit);   
    }
}
