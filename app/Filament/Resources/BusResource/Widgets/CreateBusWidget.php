<?php

namespace App\Filament\Resources\BusResource\Widgets;

use App\Models\bus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Widgets\Widget;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateBusWidget extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.resources.bus-resource.widgets.create-bus-widget';
    protected int | string | array $columnSpan = 'full';


    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
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
               Select::make('status')
                    ->options([
                        'diponible' => 'disponible',
                        'Maintenance' => 'Maintence',
                    ])
                    ->required(),

            ])->statePath('data');

    }
    public function create(): void
    {
        bus::create($this->form->getState());
        $this->form->fill();
        $this->dispatch('contact-created');
    }

}
