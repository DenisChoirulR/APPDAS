<?php

namespace App\Http\Controllers\Api\WorkOrder;

use App\Exports\WorkOrderReport;
use App\Http\Controllers\Controller;
use App\Http\Resources\CooperativeContractResource;
use App\Http\Resources\WorkOrderResource;
use App\Models\CooperativeContract;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Storage;

class WorkOrderController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $workOrders = WorkOrder::get();
        return WorkOrderResource::collection($workOrders);
    }

    public function show(WorkOrder $workOrder): WorkOrderResource
    {
        $workOrder->load('subTechnicalDesign', 'realizations', 'payments', 'verifications');
        return new WorkOrderResource($workOrder);
    }

    public function export(WorkOrder $workOrder)
    {
        $workOrder = collect([$workOrder]);

        $fileName = 'Report/SPKReport-' . now()->timestamp . '.xlsx';
        Excel::store(new WorkOrderReport($workOrder), $fileName, 'public');
        $fileUrl = Storage::url($fileName);

        return response()->json(['url' => url("{$fileUrl}")]);
    }

    public function getAll(): \Illuminate\Http\JsonResponse
    {
        $cooperativeContracts = CooperativeContract::whereContractorId(Auth::user()->contractor_id)->get();

        $data = $cooperativeContracts->pluck('id')->mapWithKeys(function ($id) {
            $workOrders = WorkOrder::where('cooperative_contract_id', $id)->get();
            return [$id => (WorkOrderResource::collection($workOrders->load('subTechnicalDesign', 'payments', 'verifications')))];
        });

        return response()->json(['data' => $data]);
    }
}
