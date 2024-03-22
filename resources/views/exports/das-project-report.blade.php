<table>
    <tr>
        <th colspan="5"
            style="color: #000000;font-weight:bolder;vertical-align:center;text-align:left;font-size:14pt;">SK DAS Report</th>
    </tr>
</table>
<table>
    @foreach($records as $key => $record)
        <tr>
            <td style="text-align: left;">{{$key+1}}. </td>
            <td style="text-align: left;">Nomor SK</td>
            <td>: {{$record->sk_number}}</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        @foreach($record->technicalDesigns as $technicalDesignsKey => $technicalDesign)
            <tr>
                <td>{{$key+1}}.{{$technicalDesignsKey+1}}.</td>
                <td>Rantek</td>
                <td>: {{$technicalDesign->title}}</td>
            </tr>
            <tr>
                <td></td>
                <td>Area Kerja</td>
                <td>: {{$technicalDesign->work_area->code}}</td>
            </tr>
            
            @foreach($technicalDesign->subTechnicalDesign as $subTechnicalDesign)
                <tr>
                    <td></td>
                    <td>Blok</td>
                    <td>: {{$subTechnicalDesign->work_area_block->block_name}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td style="border: 1px solid #000; width: 200px;"></td>
                    <td style="border: 1px solid #000; width: 200px; text-align: center;" colspan="3">Rencana Tanam</td>
                </tr>
                <tr>
                    <td></td>
                    <td style="border: 1px solid #000"></td>
                    <td style="border: 1px solid #000; text-align: center;">Tahun</td>
                    <td style="border: 1px solid #000; text-align: center;">Luas</td>
                    <td style="border: 1px solid #000; text-align: center;">Tanaman</td>
                </tr>
                <tr>
                    <td></td>
                    <td style="border: 1px solid #000">P0</td>
                    <td style="border: 1px solid #000">{{$subTechnicalDesign->created_at->format('Y') ?? ''}}</td>
                    <td style="border: 1px solid #000">{{$subTechnicalDesign->work_area_block->block_size ?? 0}} Ha</td>
                    <td style="border: 1px solid #000">
                        {{$subTechnicalDesign
                        ->plants()->where('activity_category', 'P0')
                        ->sum('number_of_plant') ?? ''}}
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="border: 1px solid #000">P1</td>
                    <td style="border: 1px solid #000">{{$subTechnicalDesign->created_at->format('Y') ?? ''}}</td>
                    <td style="border: 1px solid #000">{{$subTechnicalDesign->work_area_block->block_size ?? 0}} Ha</td>
                    <td style="border: 1px solid #000">
                        {{$subTechnicalDesign
                        ->plants()->where('activity_category', 'P1')
                        ->sum('number_of_plant') ?? ''}}
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="border: 1px solid #000">P2</td>
                    <td style="border: 1px solid #000">{{$subTechnicalDesign->created_at->format('Y') ?? ''}}</td>
                    <td style="border: 1px solid #000">{{$subTechnicalDesign->work_area_block->block_size ?? 0}} Ha</td>
                    <td style="border: 1px solid #000">
                        {{$subTechnicalDesign
                        ->plants()->where('activity_category', 'P2')
                        ->sum('number_of_plant') ?? ''}}
                    </td>
                </tr>
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
