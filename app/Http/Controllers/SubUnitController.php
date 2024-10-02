<?php

namespace App\Http\Controllers;

use App\Models\SubUnit;
use App\Http\Requests\StoreSubUnitRequest;
use App\Http\Requests\UpdateSubUnitRequest;

class SubUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubUnitRequest $request)
    {
        SubUnit::create($request->validated());

        return response()->json([
            'message' => 'Subunit was registered'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SubUnit $subUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubUnitRequest $request, SubUnit $subUnit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubUnit $subUnit)
    {
        //
    }
}
