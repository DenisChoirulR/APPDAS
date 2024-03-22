<table>
    <tr>
        <th style="color: #000000;font-weight:bolder;vertical-align:center;text-align:left;font-size:14pt;">
            SPK Report
        </th>
    </tr>
</table>
<table>
    @foreach($records as $key => $record)
        <tr>
            <td>No. SPK</td>
            <td>{{$record->work_order_number}}</td>
        </tr>
        <tr>
            <td>Kontraktor</td>
            <td>{{$record->contract->contractor->company_name ?? '-'}}</td>
        </tr>
        <tr>
            <td>Lokasi</td>
            <td>{{$record->contract->contractor->address ?? '-'}}</td>
        </tr>
        <tr>
            <td>Blok Kerja</td>
            <td>{{$record->subTechnicalDesign->work_area_block->block_name ?? '-'}}</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 150px; text-align: center;"></td>
            <td style="border: 1px solid #000; width: 150px; text-align: center;">Rencana Tanam</td>
            <td style="border: 1px solid #000; width: 150px; text-align: center;">Realisasi Tanam</td>
            <td style="border: 1px solid #000; width: 150px; text-align: center;">Persentase Tanam</td>
            <td style="border: 1px solid #000; width: 250px; text-align: center;">Tanggal Verifikasi</td>
            <td style="border: 1px solid #000; width: 150px; text-align: center;">Hasil Verifikasi</td>
            <td style="border: 1px solid #000; width: 150px; text-align: center;">Pembayaran</td>
        </tr>
        <tr>
            <td style="border: 1px solid #000;">Start (DP)</td>
            <td style="border: 1px solid #000; background-color: yellow;"></td>
            <td style="border: 1px solid #000; background-color: yellow;"></td>
            <td style="border: 1px solid #000; background-color: yellow;"></td>
            <td style="border: 1px solid #000; background-color: yellow;"></td>
            <td style="border: 1px solid #000; background-color: yellow;"></td>
            <td style="border: 1px solid #000;">
                {{$record->payments()->where('payment_step', \App\Enums\PaymentStepEnum::DP->name)->first()->payment_status->name ?? '-'}}
            </td>
        </tr>
        @foreach($record->realizations as $realization)
            <tr>
                @php         
                    switch($realization->activity_category->name) {
                        case 'P0': $label = \App\Enums\PaymentStepEnum::P0->name; break;
                        case 'P1': $label = \App\Enums\PaymentStepEnum::P1->name; break;
                        case 'P2': $label = \App\Enums\PaymentStepEnum::P2->name; break;
                    }

                    $planting_plan = $realization->work_order
                        ->subTechnicalDesign
                        ->plants()
                        ->sum('number_of_plant');
                @endphp
                <td style="border: 1px solid #000;">
                    {{$realization->activity_category->name}}
                </td>
                <td style="border: 1px solid #000;">
                    {{$planting_plan}}
                </td>
                <td style="border: 1px solid #000;">
                    {{$realization->realization_of_planting}}
                </td>
                @php
                    if($planting_plan > 0 && $realization->realization_of_planting > 0){
                        $percentage = round(($realization->realization_of_planting / $planting_plan) * 100, 2);
                    } else {
                        $percentage = 0;
                    }
                @endphp
                <td style="border: 1px solid #000; text-align: right;">{{$percentage}}%</td>
                <td style="border: 1px solid #000; text-align:center;">
                    {{isset($realization->verifications()->first()->created_at) ? $realization->verifications()->first()->created_at->format('Y-m-d') : '-'}}
                </td>
                <td style="border: 1px solid #000;">
                    {{$realization->verifications()->first()->status->name ?? '-'}}
                </td>
                <td style="border: 1px solid #000;">
                    {{$record->payments()->where('payment_step', $label)->first()->payment_status->name ?? '-'}}
                </td>
            </tr>
        @endforeach
        <tr>
            <td style="border: 1px solid #000;">End</td>
            <td style="border: 1px solid #000; background-color: yellow;"></td>
            <td style="border: 1px solid #000; background-color: yellow;"></td>
            <td style="border: 1px solid #000; background-color: yellow;"></td>
            <td style="border: 1px solid #000; background-color: yellow;"></td>
            <td style="border: 1px solid #000; background-color: yellow;"></td>
            <td style="border: 1px solid #000;">
                {{$record->payments()->where('payment_step', \App\Enums\PaymentStepEnum::SD->name)->first()->payment_status->name ?? '-'}}
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
    @endforeach
</table>
