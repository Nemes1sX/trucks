<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\SubUnit;
use Illuminate\Database\Eloquent\Builder;

class SubUnitOverlapRule implements ValidationRule
{
    protected $startTime;
    protected $endTime;

    public function __construct($startTime, $endTime)
    {
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $mainTruckOverlaps = SubUnit::where(function (Builder $query) use ($value) {
          $query->where('sub_unit', $value)->orWhere('main_truck', $value);
        })
            ->whereDate('start_date', '<=', $this->endTime)
            ->whereDate('end_date', '>=', $this->startTime)
            ->count();

        if ($mainTruckOverlaps >= 1) {
            $fail('Subunit already have been for main truck or subunit for selected period');
        }   
        
    }
}
