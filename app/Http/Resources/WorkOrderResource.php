<?php

namespace App\Http\Resources;

use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkOrderResource extends JsonResource
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
            'work_order_number' => $this->work_order_number,
            'work_order_date' => $this->work_order_date,
            'work_order_value' => $this->when(Gate::allows('view_nominal_work::order', $this->resource), $this->work_order_value),
            'passing_standard' => $this->passing_standard,
            'work_order_document_url' => $this->work_order_document_url,
            'sub_technical_design' => SubTechnicalDesignResource::make($this->whenLoaded('subTechnicalDesign')),
            'payments' => $this->when(Gate::allows('view_nominal_work::order', $this->resource), WorkOrderPaymentResource::collection($this->whenLoaded('payments'))),
            'realizations' => RealizationResource::collection($this->whenLoaded('realizations')),
            'verifications' => VerificationResource::collection($this->whenLoaded('verifications'))
        ];
    }
}
