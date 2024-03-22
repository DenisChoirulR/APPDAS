<?php

namespace App\Filament\Resources;

use App\Exports\WorkOrderReport;
use App\Filament\Resources\WorkOrderResource\Pages;
use App\Filament\Resources\WorkOrderResource\RelationManagers;
use App\Filament\Resources\WorkOrderResource\Traits\WorkOrderFormTrait;
use App\Models\WorkOrder;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class WorkOrderResource extends Resource implements HasShieldPermissions
{
    use WorkOrderFormTrait;

    protected static ?string $model = WorkOrder::class;

    protected static ?string $label = 'Perintah Kerja (SPK)';

    protected static ?string $navigationLabel = 'Perintah Kerja (SPK)';
    protected static ?string $navigationGroup = 'Kontrak';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::workOrderForm())
            ->inlineLabel()
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('contract.contract_number')
                    ->label('Nomor Kontrak'),
                Tables\Columns\TextColumn::make('work_order_number')
                    ->label('Nomor SPK'),
                Tables\Columns\TextColumn::make('work_order_date')
                    ->label('Tanggal SPK'),
                Tables\Columns\TextColumn::make('work_order_value')
                    ->label('Nilai SPK')
                    ->money('IDR'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    ExportBulkAction::make()
                        ->action( fn (Collection $records) => Excel::download(new WorkOrderReport($records), 'SPK Report.xlsx'))
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\RealizationsRelationManager::make(),
            RelationManagers\VerificationsRelationManager::make(),
            RelationManagers\PaymentsRelationManager::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkOrders::route('/'),
            'create' => Pages\CreateWorkOrder::route('/create'),
            'view' => Pages\ViewWorkOrder::route('/{record}'),
            'edit' => Pages\EditWorkOrder::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->hasRole('super_admin')){
            return parent::getEloquentQuery()->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
        }

        return parent::getEloquentQuery()->whereHas('contract', function ($query){
            $query->where('contractor_id', auth()->user()->contractor_id);
        })->withoutGlobalScopes([
            SoftDeletingScope::class,
        ]);
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view', 'view_any', 'create', 'update', 'view_nominal'
        ];
    }
}
