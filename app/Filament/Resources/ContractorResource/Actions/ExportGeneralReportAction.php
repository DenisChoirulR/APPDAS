<?php

namespace App\Filament\Resources\ContractorResource\Actions;

use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\Concerns\WithMapping;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ExportGeneralReportAction extends ExcelExport
{
    public function setUp()
    {
        parent::setUp();

        $this->withColumns([
            Column::make('company_name')
        ]);
    }
}
