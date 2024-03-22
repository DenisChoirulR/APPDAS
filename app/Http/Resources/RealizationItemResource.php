<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RealizationItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $location = [
            'latitude' => $this->location->latitude ?? '',
            'longitude' => $this->location->longitude ?? ''
        ];

        return [
            'id' => $this->id,
            'realization_id' => $this->realization_id,
            'location' => $location,
            'plant_id' => $this->plant->id ?? '',
            'plant_name' => $this->plant->plant_name ?? '',
            'image_url' => $this->image_url,
            'planting_status' => $this->planting_status
        ];
    }
}
