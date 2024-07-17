<?php

namespace App\Filament\Resources\BusResource\Pages;

use App\Filament\Resources\BusResource;
use Filament\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\ListRecords;
use Livewire\Attributes\On;

class ListBuses extends ListRecords
{
    protected static string $resource = BusResource::class;
    #[On('contact-created')]
    public function refresh() {}
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('rajouter un bus'),


        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            BusResource\Widgets\CreateBusWidget::class,
        ];
    }


}
