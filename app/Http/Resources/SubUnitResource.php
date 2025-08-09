<?php

namespace App\Http\Resources;

use App\Models\SubUnit;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubUnitResource extends JsonResource
{
    public function __construct(SubUnit $resource)
    {
        parent::__construct($resource);
        $this->resource = $resource;
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'main_truck_name' => $this->whenLoaded('mainTruck', function () {
                return $this->resource->mainTruck->name;
            }),
            'sub_unit_name' => $this->whenLoaded('subUnit', function () {
                return $this->resource->subUnit->name;
            }),
            'start_date' => $this->resource->start_date,
            'end_date' => $this->resource->end_date,
            'created_at' => $this->resource->created_at->toDateTimeString(),
            'updated_at' => $this->resource->updated_at->toDateTimeString(),
        ];
    }
}
