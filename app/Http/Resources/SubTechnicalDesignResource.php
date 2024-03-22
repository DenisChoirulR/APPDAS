<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubTechnicalDesignResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            //'value_amount' => $this->value_amount,
            'document_number' => $this->document_number,
            'block_name' => $this->work_area_block->block_name,
            'block_size' => $this->work_area_block->block_size,
            'plots' => $this->work_area_block->plots->pluck('plot') ?? []
        ];
    }
}
