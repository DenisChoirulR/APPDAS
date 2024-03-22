<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VerificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'realization' => $this->realization->activity_category->name ?? '',
            'percentage' => $this->percentage ?? '',
            'status' => $this->status->name ?? '',
            'created_at' => $this->created_at
        ];
    }
}
