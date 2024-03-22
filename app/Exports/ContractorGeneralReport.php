<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Excel;

class ContractorGeneralReport implements FromView
{
    public function __construct(Collection $records)
    {
        $this->records = $records;
    }

    public function view(): View
    {
        return view('exports.contractor-general-report', [
            'records' => $this->records
        ]);
    }
}
