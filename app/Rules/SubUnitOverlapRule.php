<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\SubUnit;

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
        //dd($this->startTime, $this->endTime);
        $mainTruckOverlaps = SubUnit::where('sub_unit', $value)
            ->whereDate('start_date', '<=', $this->endTime)
            ->whereDate('end_date', '>=', $this->startTime)
            ->count();

        if ($mainTruckOverlaps >= 1) {
            $fail('Subunit already have been for main truck for selected period');
        }   
        
    }
}
