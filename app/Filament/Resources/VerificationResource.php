<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VerificationResource\Pages;
use App\Models\Verification;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class VerificationResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Verification::class;

    protected static ?string $slug = 'verifications';

    protected static ?string $label = 'Verifikasi';
    protected static ?string $navigationGroup = 'Kontrak';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('work_order_id')
                    ->required(),

                TextInput::make('realization_id')
                    ->required(),

                TextInput::make('percentage')
                    ->required()
                    ->integer(),

                TextInput::make('status')
                    ->required(),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Verification $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Verification $record): string => $record?->updated_at?->diffForHumans() ?? '-'),

                TextInput::make('document_file'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('workOrder.work_order_number')
                    ->label('Nomor SPK')
                    ->searchable(),

                TextColumn::make('realization.activity_category')
                    ->label('Grup Aktifitas'),

                TextColumn::make('percentage')
                    ->label('Persentase')
                    ->suffix('%'),

                TextColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make()
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVerifications::route('/'),
            'view' => Pages\ViewVerification::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        if (auth()->user()->hasRole('super_admin')){
            return parent::getEloquentQuery();
        }

        return parent::getEloquentQuery()->whereHas('workOrder', function (Builder $query){
            $query->whereHas('contract', function ($query){
                $query->where('contractor_id', auth()->user()->contractor_id);
            });
        });
    }

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create'
        ];
    }
}
