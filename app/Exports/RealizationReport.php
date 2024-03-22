<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class RealizationReport implements FromView
{
    public function __construct($record)
    {
        $this->record = $record;
    }

    public function view(): View
    {
        return view('exports.realization-report', [
            'record' => $this->record
        ]);
    }
}
