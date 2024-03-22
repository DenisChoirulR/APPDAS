<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;

class WorkOrderReport implements FromView
{
    public function __construct(Collection $records)
    {
        $this->records = $records;
    }

    public function view(): View
    {
        return view('exports.work-order-report', [
            'records' => $this->records
        ]);
    }
}
