<?php

namespace App\Http\Resources;

use App\Enums\ActivityGroupEnum;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RealizationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $planting_plan = $this->work_order
            ->subTechnicalDesign
            ->plants()
            ->where('activity_category', ActivityGroupEnum::P0->name)
            ->sum('number_of_plant') ?? 0;
        if($planting_plan > 0 && $this->realization_of_planting > 0){
            $percentage = round(($this->realization_of_planting / $planting_plan) * 100, 2);
        }

        $plants = Plant::whereSubTechnicalDesignId($this->work_order->sub_technical_design_id)
            ->where('activity_category', $this->activity_category->name)
            ->pluck('plant_name', 'id');

        return [
            'id' => $this->id,
            'activity_category' => $this->activity_category->name ?? '',
            'planting_plan' => $planting_plan ?? 0,
            'realization_of_planting' => $this->realization_of_planting,
            'status' => $this->status->name ?? 'Tidak ada Status',
            'items' => RealizationItemResource::collection($this->whenLoaded('items')),
            'percentage' => $percentage ?? 0,
            'plants' => $plants
        ];
    }
}
