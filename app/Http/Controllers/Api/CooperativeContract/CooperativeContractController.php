<?php

namespace App\Http\Controllers\Api\CooperativeContract;

use App\Http\Controllers\Controller;
use App\Http\Resources\CooperativeContractResource;
use App\Models\CooperativeContract;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CooperativeContractController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $cooperativeContracts = CooperativeContract::whereContractorId(Auth::user()->contractor_id)->get();

        return CooperativeContractResource::collection($cooperativeContracts);
    }

    public function show(Request $request)
    {
        if ($request->has('id')) {
            $cooperativeContract = CooperativeContract::find($request->input('id'));
        } else {
            $cooperativeContract = CooperativeContract::whereContractorId(Auth::user()->contractor_id)->latest()->first();
        }

        if (!$cooperativeContract) {
            return response()->json([
                'data' => []
            ]);
        }

        $cooperativeContract->load('workOrders');
        return new CooperativeContractResource($cooperativeContract);
    }

    public function getAll(): \Illuminate\Http\JsonResponse
    {
        $cooperativeContracts = CooperativeContract::whereContractorId(Auth::user()->contractor_id)->get();

        $data = $cooperativeContracts->pluck('id')->mapWithKeys(function ($id) {
            $contract = CooperativeContract::find($id);
            return [$id => (new CooperativeContractResource($contract))];
        });

        return response()->json(['data' => $data]);
    }
}
