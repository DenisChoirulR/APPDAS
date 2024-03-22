<?php

namespace App\Http\Controllers\Api\RealizationItem;

use App\Http\Controllers\Controller;
use App\Http\Requests\RealizationItemRequest;
use App\Http\Resources\RealizationItemResource;
use App\Http\Resources\RealizationResource;
use App\Models\Plant;
use App\Models\Realization;
use App\Models\RealizationItem;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use MatanYadaev\EloquentSpatial\Objects\Point;

class RealizationItemController extends Controller
{
    public function store(RealizationItemRequest $request): JsonResponse|RealizationItemResource
    {
        try {
            DB::beginTransaction();

            $imagePath = null;
            if ($request->hasFile('image')) {
                $uploadedImage = $request->file('image');
                $imagePath = $uploadedImage->store('realization_items', 'public');
            }

            $realizationItem = RealizationItem::create([
                'realization_id' => $request->input('realization_id'),
                'plant_id' => $request->input('plant_id') ?? null,
                'location' => $request->has('location.longitude', 'location.longitude') ? new Point($request->input('location.latitude'), $request->input('location.longitude')) : null,
                'image' => $imagePath,
                'planting_status' => $request->input('planting_status') ?? null,
            ]);

            $realization = Realization::find($request->input('realization_id'));
            $realization->increment('realization_of_planting');

            DB::commit();

            return new RealizationItemResource($realizationItem);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function update(RealizationItem $realizationItem, RealizationItemRequest $request): JsonResponse|RealizationItemResource
    {
        try {
            DB::beginTransaction();

            $imagePath = null;
            if ($request->hasFile('image')) {
                $uploadedImage = $request->file('image');
                $imagePath = $uploadedImage->store('realization_items', 'public');
            }

            $realizationItem->update([
                'realization_id' => $request->input('realization_id'),
                'plant_id' => $request->input('plant_id') ?? null,
                'location' => $request->has('location.longitude', 'location.longitude') ? new Point($request->input('location.latitude'), $request->input('location.longitude')) : null,
                'image' => $imagePath,
                'planting_status' => $request->input('planting_status') ?? null,
            ]);

            DB::commit();

            return new RealizationItemResource($realizationItem);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function getAll(): JsonResponse
    {
        $realizations = Realization::whereHas('work_order', function($q) {
            $q->whereHas('contract', function($w) {
                $w->whereContractorId(Auth::user()->contractor_id);
            });
        })->get();

        $data = $realizations->pluck('id')->mapWithKeys(function ($id) {
            $realizationItems = RealizationItem::where('realization_id', $id)->get();
            return [$id => (RealizationItemResource::collection($realizationItems))];
        });

        return response()->json(['data' => $data]);
    }
}
