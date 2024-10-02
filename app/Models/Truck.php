<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'year', 'notes'];

    protected function name() : Attribute 
    {
        return Attribute::make(
            set: fn (string $value) => strtoupper($value)
        );
    }
}
