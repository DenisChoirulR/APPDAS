<?php

namespace App\Filament\Resources;

use App\Enums\PaymentStatusEnum;
use App\Enums\PaymentWorkStatusEnum;
use App\Filament\Resources\WorkOrderPaymentResource\Pages;
use App\Filament\Resources\WorkOrderPaymentResource\RelationManagers;
use App\Models\WorkOrderPayment;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkOrderPaymentResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = WorkOrderPayment::class;

    protected static ?string $label = 'Pembayaran';

    protected static ?string $navigationGroup = 'Kontrak';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nominal')
                    ->label('Nominal')
                    ->required()
                    ->prefix('Rp ')
                    ->placeholder('Masukan Nominal Pembayaran')
                    ->mask(RawJs::make(<<<'JS'
                        $money($input, ',', '.', 0)
                    JS))
                    ->dehydrateStateUsing(fn($state) => str($state)->remove('.')->toInteger()),
                Forms\Components\Select::make('payment_status')
                    ->label('Status Pembayaran')
                    ->options(PaymentStatusEnum::class)
                    ->required()
                    ->native(false),
                Forms\Components\Select::make('work_status')
                    ->label('Status Pekerjaan')
                    ->options(PaymentWorkStatusEnum::class)
                    ->required()
                    ->native(false),
                Forms\Components\DatePicker::make('payment_date')
                    ->label('Tanggal')
                    ->native(false)
                    ->required(),
                Forms\Components\FileUpload::make('file')
                    ->required()
                    ->downloadable()
                    ->openable()
                    ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/webp', 'image/png', 'image/jpg'])
            ])->inlineLabel()->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('workOrder.work_order_number')
                    ->label('Nomor SPK')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_step')
                    ->label('Jenis Pembayaran'),
                Tables\Columns\TextColumn::make('nominal')
                    ->label('Nominal Pembayaran')
                    ->prefix('Rp ')
                    ->numeric(0, ',', '.'),
                Tables\Columns\TextColumn::make('payment_date')
                    ->label('Tanggal')
                    ->date(),
                Tables\Columns\TextColumn::make('work_status')
                    ->label('Status Pekerjaan'),
                Tables\Columns\TextColumn::make('payment_status')
                    ->label('Status Pembayaran'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkOrderPayments::route('/'),
//            'create' => Pages\CreateWorkOrderPayment::route('/create'),
            'view' => Pages\ViewWorkOrderPayment::route('/{record}'),
            'edit' => Pages\EditWorkOrderPayment::route('/{record}/edit'),
        ];
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view', 'view_any', 'create', 'update'
        ];
    }
}
