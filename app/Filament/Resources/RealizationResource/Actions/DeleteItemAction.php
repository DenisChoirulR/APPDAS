<?php

namespace App\Filament\Resources\RealizationResource\Actions;

use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class DeleteItemAction extends Action
{
    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'delete_item';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Hapus');
        $this->color('danger');

        $this->requiresConfirmation();
        $this->successNotificationTitle('Berhasil dihapus');

        $this->action(function (){
            $result = $this->process(function (Model $record) {
                $this->record->realization()->decrement('realization_of_planting');
                return $record->delete();
            });

            if (! $result) {
                $this->failure();

                return;
            }

            $this->success();
        });
    }
}
