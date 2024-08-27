<?php

namespace App\Filament\Resources\ExpeditionResource\Pages;

use App\Filament\Resources\ExpeditionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\Page;

class CreateExpedition extends CreateRecord
{
    protected static string $resource = ExpeditionResource::class;
    protected static ?string $title = 'Expédition des colis';

    protected function getRedirectUrl(): string
    {
        return route('generate-pdf', $this->record->id);
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Colis envoyé';
    }

    protected function getFormActions(): array
    {
        return array_merge(parent::getFormActions(), [
            Actions\Action::make('effacer')
                ->action(function () {
                    $this->form->fill();
                }),
        ]);
    }
}
