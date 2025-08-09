<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property Truck $mainTruck
 * @property Truck $subUnit
 * @property Carbon $start_date
 * @property Carbon $end_date
*/
class SubUnit extends Model
{
    use HasFactory;

    protected $fillable = ['main_truck', 'sub_unit', 'start_date', 'end_date'];

    public function mainTruck() : BelongsTo
    {
        return $this->belongsTo(Truck::class, 'main_truck');
    }

    public function subUnit() : BelongsTo
    {
        return $this->belongsTo(Truck::class, 'sub_unit');
    }
}
