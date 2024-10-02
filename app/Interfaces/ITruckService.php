<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ITruckService
{
    function getAllTrucks(int $perPage = 10, int $startYear = 1900, int $endYear = 2030, string $name = null) : LengthAwarePaginator;
}
