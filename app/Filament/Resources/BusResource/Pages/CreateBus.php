<?php

namespace App\Filament\Resources\BusResource\Pages;

use App\Filament\Resources\BusResource;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateBus extends CreateRecord
{
    protected static string $resource = BusResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('rajouter un bus'),

        ];
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nom')
                    ->maxLength(255)
                    ->default(null),
               TextInput::make('numero_du_bus')
                    ->maxLength(255)
                    ->default(null),
               TextInput::make('status')
                    ->required(),

            ]);
    }


}
