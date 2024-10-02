<?php

namespace App\Rules;

use App\Models\SubUnit;
use Closure;
use Illuminate\Contracts\Database\Eloquent\Builder;
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
        $mainTruckOverlaps = SubUnit::where('main_truck', $value)
            ->where('start_time', '<=', $this->endTime)
            ->where('end_time', '>=', $this->startTime)
            ->count();

        if ($mainTruckOverlaps >= 1) {
            $fail('Main truck already has a subunit');
        }   
        
    }
}
