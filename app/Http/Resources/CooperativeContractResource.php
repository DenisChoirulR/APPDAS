<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CooperativeContractResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'contract_number' => $this->contract_number,
            //'contract_date' => Carbon::parse($this->contract_date)->format('F d, Y'),
            'contract_date' => $this->contract_date,
            'work_orders' => WorkOrderResource::collection($this->whenLoaded('workOrders')),
        ];
    }
}
