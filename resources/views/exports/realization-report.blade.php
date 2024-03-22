<table>
    <tr>
        <th colspan="5"
            style="color: #000000;font-weight:bolder;vertical-align:center;text-align:left;font-size:14pt;">Realization Report</th>
    </tr>
</table>
<table>
    <tr>
        <td>SPK</td>
        <td>: {{$record->work_order->work_order_number}}</td>
    </tr>
    <tr>
        <td>Kontraktor</td>
        <td>: {{$record->work_order->contract->contractor->company_name ?? '-'}}</td>
    </tr>
    <tr>
        <td>Grup Aktivitas</td>
        <td>: {{$record->activity_category->name}}</td>
    </tr>
    <tr>
        <td>Rencana Tanam</td>
        <td style="text-align: left">: {{$record->work_order?->subTechnicalDesign->plants()->sum('number_of_plant')}}</td>
    </tr>
    <tr>
        <td>Realisasi Tanam</td>
        <td style="text-align: left;">: {{$record->realization_of_planting}}</td>
    </tr>
    <tr>
        @php
            $planting_plan = $record->work_order?->subTechnicalDesign->plants()->sum('number_of_plant');
            $percentage = 0;
            if($planting_plan > 0 && $record->realization_of_planting > 0){
                $percentage = round(($record->realization_of_planting / $planting_plan) * 100, 2);
            }
        @endphp
        <td>Persentase Realisasi</td>
        <td>: {{$percentage}}%</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td>Ringkasan Realisasi</td>
    </tr>
    @php
        $plants = $record->work_order->subTechnicalDesign
            ->plants()
            ->where('activity_category', $record->activity_category->name)
            ->get();
    @endphp
    @foreach($plants as $plant)
        <tr>
            <td>{{$plant->plant_name}}</td>
            @php
                $realization = $record->items()->where('plant_id', $plant->id)->count();
                $number_of_plant = $plant->number_of_plant;
                $percentage = ($realization/$number_of_plant) * 100;
            @endphp
            <td>: {{$realization.' ('.$percentage.'%)'}}</td>
        </tr>
    @endforeach
    <tr>
        <td></td>
    </tr>
    <tr>
        <td>Item Realisasi</td>
    </tr>
    <tr>
        <td style="border: 1px solid #000; text-align: center;">Tanaman</td>
        <td style="border: 1px solid #000; text-align: center;">Latitude</td>
        <td style="border: 1px solid #000; text-align: center;">Longitude</td>
        <td style="border: 1px solid #000; text-align: center;">Status Tanam</td>
    </tr>
    @foreach($record->items as $item)
        <tr>
            <td style="border: 1px solid #000; width: 150px;">{{$item->plant->plant_name ?? '-'}}</td>
            <td style="border: 1px solid #000; width: 150px;">{{$item->location->latitude ?? '-'}}</td>
            <td style="border: 1px solid #000; width: 150px;">{{$item->location->longitude ?? '-'}}</td>
            <td style="border: 1px solid #000; width: 150px;">{{$item->planting_status ?? '-'}}</td>
        </tr>
    @endforeach
</table>
