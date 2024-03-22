<?php

namespace App\Http\Requests;

use App\Models\Realization;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RealizationItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'realization_id' => 'required|exists:realizations,id',
            'plant_id' => 'required_without_all:location,location.latitude,location.longitude,planting_status|exists:plants,id',
            'location' => 'required_without_all:plant_id,location.latitude,location.longitude,planting_status|array',
            'location.latitude' => 'required_without_all:plant_id,location,location.longitude,planting_status|numeric',
            'location.longitude' => 'required_without_all:plant_id,location,location.latitude,planting_status|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'planting_status' => 'required_without_all:plant_id,location,location.latitude,location.longitude|string',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ], 403));
    }
}
