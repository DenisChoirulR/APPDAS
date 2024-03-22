<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkOrderPaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'payment_step' => $this->payment_step->name,
            'nominal' => $this->nominal,
            'payment_date' => $this->payment_date,
            'payment_status' => $this->payment_status->name,
            'work_status' => $this->work_status->name
        ];
    }
}
