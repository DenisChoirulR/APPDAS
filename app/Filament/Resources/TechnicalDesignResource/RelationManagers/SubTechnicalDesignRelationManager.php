<?php

namespace App\Filament\Resources\TechnicalDesignResource\RelationManagers;

use App\Filament\Resources\SubTechnicalDesignResource;
use App\Models\WorkAreaBlock;
use App\Models\WorkAreaBlockPlot;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubTechnicalDesignRelationManager extends RelationManager
{
    protected static string $relationship = 'subTechnicalDesign';

    protected static ?string $title = 'Dokumen Rantek';
    protected static ?string $label = 'Dokumen Rantek';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('work_area_block_id')
                    ->label('Blok')
                    ->relationship('work_area_block', 'block_name', function (Builder $query) {
                        $query->where('work_area_id', $this->getOwnerRecord()->work_area_id);
                    })
                    ->required()
                    ->native(false)
                    ->live()
                    ->afterStateUpdated(fn(Forms\Set $set) => $set('work_area_block_plot_id', null)),
                Forms\Components\Select::make('work_area_block_plot_id')
                    ->label('Petak')
                    ->options(function (Forms\Get $get){
                        return WorkAreaBlockPlot::whereWorkAreaBlockId($get('work_area_block_id'))
                            ->pluck('plot', 'id');
                    })
                    ->native(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('document_number')
                    ->label('Nomor Dokumen'),
                Tables\Columns\TextColumn::make('work_area_block.block_name')
                    ->label('Blok'),
                Tables\Columns\TextColumn::make('work_area_block_plot.plot')
                    ->label('Petak'),
                Tables\Columns\TextColumn::make('area_size')
                    ->state(function ($record){
                        return $record->work_area_block_plot ? $record->work_area_block_plot->plot_size : $record->work_area_block->block_size;
                    })
                    ->label('Luas')
                    ->suffix(' Ha'),
                Tables\Columns\TextColumn::make('value_amount')
                    ->label('Nilai Rantek')
                    ->money('IDR')
                    ->alignRight(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\Action::make('create_document')
                    ->label('Buat Dokumen Rantek')
                    ->url(SubTechnicalDesignResource::getUrl('create', ['technical-design' => $this->getOwnerRecord()->id]))
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->url(function ($record){
                        return SubTechnicalDesignResource::getUrl('edit', ['record' => $record->id]);
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
