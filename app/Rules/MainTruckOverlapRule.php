<?php

namespace App\Rules;

use App\Models\SubUnit;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Validation\ValidationRule;

class MainTruckOverlapRule implements ValidationRule
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
           $query->where('main_truck', $value)->orWhere('sub_unit', $value);
        })->whereDate('start_date', '<=', $this->endTime)
            ->whereDate('end_date', '>=', $this->startTime)
            ->count();

        if ($mainTruckOverlaps >= 1) {
            $fail('Main truck already has a subunit or being subunit itself for your selected period');
        }   
        
    }
}
