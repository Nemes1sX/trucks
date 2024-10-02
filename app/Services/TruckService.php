<?php

namespace App\Services;

use App\Interfaces\ITruckService;
use App\Models\Truck;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TruckService implements ITruckService
{
    public function getAllTrucks(int $perPage = 10, int $startYear = 1900, int $endYear = 2030, ?string $name = null): LengthAwarePaginator
    {
        if ($startYear != '' && $endYear != '') {
            if ($startYear > $endYear) {
                $temp = $startYear;
                $startYear = $endYear;
                $endYear = $temp;
            }
        }

        return Truck::when($name != null && $name != '', function (Builder $query) use ($name) {
            $query->where('name', $name);
        })->when($startYear != '' && $endYear != '', function (Builder $query) use ($startYear, $endYear) {
            $query->whereBetween('year', [$startYear, $endYear]);
        })->paginate($perPage);

    }
}
