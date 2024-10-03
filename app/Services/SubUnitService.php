<?php

namespace App\Services;

use App\Interfaces\ISubUnitService;
use App\Models\SubUnit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class SubUnitService implements ISubUnitService
{
    public function getAllSubUnits(int $perPage = 10, ?int $mainTruck = null, ?int $subUnit = null, ?string $startDate = null, ?string $endDate = null): LengthAwarePaginator
    {
        if ($startDate != '' && $endDate != '') {
            if ($startDate > $endDate) {
                $temp = $startDate;
                $startDate = $endDate;
                $endDate = $temp;
            }
        }

        return SubUnit::with('mainTruck', 'subUnit')->when($mainTruck, function(Builder $query) use ($mainTruck) {
            $query->where('main_truck', $mainTruck);
        })->when($subUnit, function(Builder $query) use ($subUnit) {
            $query->where('sub_unit', $subUnit);
        })->when($startDate != '' && $endDate != '', function (Builder $query) use ($startDate, $endDate) {
            $query->whereDate('start_date', '>=', $startDate);
        })->paginate($perPage);
    }
}
