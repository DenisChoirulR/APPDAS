<?php

namespace App\Http\Controllers\Api\Realization;

use App\Exports\RealizationReport;
use App\Exports\WorkOrderReport;
use App\Http\Controllers\Controller;
use App\Http\Resources\RealizationItemResource;
use App\Http\Resources\RealizationResource;
use App\Models\Plant;
use App\Models\Realization;
use App\Models\RealizationItem;
use App\Models\WorkOrder;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use MatanYadaev\EloquentSpatial\Objects\Point;
use Storage;
use Str;

class RealizationController extends Controller
{
    public function show(Realization $realization): RealizationResource
    {
        $realization->load('items');
        return new RealizationResource($realization);
    }

    public function getPlants(Realization $realization): JsonResponse
    {
        $plants = Plant::whereSubTechnicalDesignId($realization->work_order->sub_technical_design_id)
            ->where('activity_category', $realization->activity_category->name)
            ->pluck('plant_name', 'id');

        return response()->json([
            'data' => $plants
        ]);
    }
}
