<?php

namespace App\Filament\Resources\RealizationResource\RelationManagers;

use App\Filament\Resources\RealizationResource\Actions\CreateItemAction;
use App\Filament\Resources\RealizationResource\Actions\DeleteItemAction;
use App\Filament\Resources\RealizationResource\Actions\EditItemAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = 'Realisasi Tanam';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('Gambar'),
                Tables\Columns\TextColumn::make('plant.plant_name')->label('Tanaman'),
                Tables\Columns\TextColumn::make('latitude')
                    ->state(fn($record) => $record->location->latitude),
                Tables\Columns\TextColumn::make('longitude')
                    ->state(fn($record) => $record->location->longitude),
                Tables\Columns\TextColumn::make('planting_status')->label('Status Taman'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('plant_id')
                    ->native(false)
                    ->label('Tanaman')
                    ->options(function (){
                        $owner = $this->getOwnerRecord();
                        return $owner
                            ->work_order
                            ->subTechnicalDesign
                            ->plants()
                            ->where('activity_category', $owner->activity_category->name)
                            ->pluck('plant_name', 'id');
                    }),
                Tables\Filters\SelectFilter::make('planting_status')
                    ->native(false)
                    ->label('Status Tanam')
                    ->options([
                        'Hidup' => 'Hidup',
                        'Mati' => 'Mati'
                    ]),
                Tables\Filters\Filter::make('has_image')
                    ->form([
                        Forms\Components\Select::make('image')
                            ->label('Memiliki Gambar')
                            ->options([
                                true => 'Ya',
                                false => 'Tidak'
                            ])
                    ])
                    ->query(function (Builder $query, array $data){
                        $image = $data['image'];
                        if(!is_null($image)){
                            if(!$image){
                                $query->whereNull('image');
                            } else {
                                $query->whereNotNull('image');
                            }
                        }
                    }),
            ], Tables\Enums\FiltersLayout::AboveContent)
            ->actions([
                EditItemAction::make(),
                DeleteItemAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
