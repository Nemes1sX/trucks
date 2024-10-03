<?php

namespace App\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface ISubUnitService
{
    function getAllSubUnits(int $perPage = 10, int $mainTruck = null, int $subUnit = null, string $startDate = null, string $endDate = null) : LengthAwarePaginator;
}
