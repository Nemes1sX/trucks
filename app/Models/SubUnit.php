<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubUnit extends Model
{
    /** @use HasFactory<\Database\Factories\SubUnitFactory> */
    use HasFactory;
    
    protected $fillable = ['main_truck', 'sub_unit', 'start_date', 'end_date'];

    public function mainTruck()
    {
        return $this->belongsTo(Truck::class, 'main_truck');
    }

    public function subUnit()
    {
        return $this->belongsTo(Truck::class, 'sub_unit');
    }
}
