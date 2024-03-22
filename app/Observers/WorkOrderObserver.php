<?php

namespace App\Observers;

use App\Enums\ActivityGroupEnum;
use App\Models\WorkOrder;

class WorkOrderObserver
{
    /**
     * Handle the WorkOrderCollection "created" event.
     */
    public function created(WorkOrder $workOrder): void
    {
        $workOrder->realizations()->create([
            'activity_category' => ActivityGroupEnum::P0->name,
            'realization_of_planting' => 0
        ]);

        $workOrder->realizations()->create([
            'activity_category' => ActivityGroupEnum::P1->name,
            'realization_of_planting' => 0
        ]);

        $workOrder->realizations()->create([
            'activity_category' => ActivityGroupEnum::P2->name,
            'realization_of_planting' => 0
        ]);
    }

    /**
     * Handle the WorkOrderCollection "updated" event.
     */
    public function updated(WorkOrder $workOrder): void
    {
        //
    }

    /**
     * Handle the WorkOrderCollection "deleted" event.
     */
    public function deleted(WorkOrder $workOrder): void
    {
        //
    }

    /**
     * Handle the WorkOrderCollection "restored" event.
     */
    public function restored(WorkOrder $workOrder): void
    {
        //
    }

    /**
     * Handle the WorkOrderCollection "force deleted" event.
     */
    public function forceDeleted(WorkOrder $workOrder): void
    {
        //
    }
}
