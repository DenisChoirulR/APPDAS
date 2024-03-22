<table>
    <tr>
        <th colspan="5"
            style="color: #000000;font-weight:bolder;vertical-align:center;text-align:left;font-size:14pt;">General Report</th>
    </tr>
</table>
<table>
    @foreach($records as $key => $record)
        <tr>
            <td style="text-align: left">{{$key+1}}.</td>
            <td style="width: 150px;">Nama Kontraktor</td>
            <td>: {{$record->company_name}}</td>
        </tr>
        <tr>
            <td></td>
            <td>Lokasi</td>
            <td>: {{$record->address}}</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        @foreach($record->contracts as $contract)
            {{--<tr style="border: 1px;border-color: #0000;">
                <td></td>
                <td>{{$contract->contract_number}}</td>
            </tr>--}}
            @foreach($contract->workOrders as $workOrder)
                <tr>
                    <td></td>
                    <td>Nomor SPK</td>
                    <td>: {{$workOrder->work_order_number}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Blok Kerja</td>
                    <td>: {{$workOrder->subTechnicalDesign->work_area_block->block_name ?? '-'}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td style="border: 1px solid #000" rowspan="2"></td>
                    <td style="border: 1px solid #000; text-align: center;" colspan="2">Rencana</td>
                    <td style="border: 1px solid #000; text-align: center;" colspan="2">Realisasi</td>
                </tr>
                <tr>
                    <td></td>
                    <td style="border: 1px solid #000; text-align: center;">Luas</td>
                    <td style="border: 1px solid #000; text-align: center;">Tanaman</td>
                    <td style="border: 1px solid #000; text-align: center;">Tahun</td>
                    <td style="border: 1px solid #000; text-align: center;">Tanaman</td>
                </tr>
                @foreach($workOrder->realizations as $realization)
                    <tr>
                        <td></td>
                        <td style="border: 1px solid #000">
                            {{$realization->activity_category->name}}
                        </td>
                        <td style="border: 1px solid #000">
                            {{$realization->work_order->subTechnicalDesign->work_area_block->block_size ?? 0}} Ha
                        </td>
                        <td style="border: 1px solid #000">
                            {{$realization->work_order
                            ->subTechnicalDesign
                            ->plants()
                            ->sum('number_of_plant')}}
                        </td>
                        <td style="border: 1px solid #000">
                            {{$realization->updated_at->format('Y')}}
                        </td>
                        <td style="border: 1px solid #000">
                            {{$realization->realization_of_planting}}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                </tr>
            @endforeach
            <tr>
                <td></td>
            </tr>
        @endforeach
    @endforeach
</table>
