<?php

namespace App\Filament\Resources\ExpeditionResource\Widgets;

use App\Models\bus;
use App\Models\expedition;
use App\Models\location;
use App\Models\User;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Widgets\Widget;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;
use Illuminate\Database\Eloquent\Model;


class CreateExpeditionWidget extends  Widget implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.resources.expedition-resource.widgets.create-expedition-widget';
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
                section::make([
                    Grid::make()  ->columns([
                        'sm' => 3,
                        'xl' => 4,
                        '2xl' => 3,
                    ])
                        ->schema([
                         TextInput::make('ref_no')
                                ->label('N° Ticket')
                                ->default('MB-' .random_int(100000,999999))
                                ->disabled()
                                ->required()
                                ->dehydrated()
                                ->maxLength(255),
                             Select::make('bus_id')
                                ->label('Bus')
                                ->required()
                                 ->options( bus::all()->pluck('nom', 'id')),
                         Select::make('from_location')
                                ->label('Agence de Depart')
                                ->required()
                             ->options( location::all()->pluck('point darret','point darret')),
                         select::make('to_location')
                                 ->label('Agence Destination')
                             ->options( location::all()->pluck('point darret','point darret'))
                                ->required(),
                            TextInput::make('name')
                                ->label('Description du Colis')
                                ->required()
                                ->maxLength(255),
                          TextInput::make('qty')
                                ->label('Nombre de Colis')
                                ->required()
                              ->numeric()
                                ->tel(),
                            TextInput::make('valeur')
                                ->label('Valeur du Colis')
                                ->required()
                                ->tel()
                                ->numeric()
                                ->prefix('FCFA'),
                            TextInput::make('prix')
                                ->label('Frais denvoi')
                                ->required()
                                ->numeric()
                                ->tel()
                                ->prefix('FCFA'),
                         TextInput::make('expeditair')
                                ->label('Expéditeur')
                                ->required()
                                ->maxLength(255)
                                 ->prefixIcon('heroicon-o-user')
                                ->prefixIconColor('blue'),
                         TextInput::make('tel_expeditair')
                                ->label('Numero Expédi..')
                                ->tel()
                                ->required()
                                ->maxLength(255)
                             ->prefixIcon('heroicon-o-phone'),
                         TextInput::make('destinatair')
                                ->label('Recepteur')
                                ->required()
                                ->maxLength(255)
                             ->prefixIcon('heroicon-o-user'),
                         TextInput::make('tel_destinatair')
                                ->label('Numero du Recepteur')
                                ->tel()
                                ->required()
                                ->maxLength(255)
                                 ->prefixIcon('heroicon-o-phone'),
                            Select::make('agent')
                                ->required()
                                ->default(Auth::user()->name)
                                ->searchable(),
                            Select::make('status')
                                ->options([
                                    'payer' => 'Payer',
                                    'impayer' => 'impayer',
                                ])
                                ->native(false)
                                ->required(),

                        ]),
                ]),
            ])->statePath('data');
    }

    public function create(): void
    {
       expedition::create($this->form->getState());
        $this->form->fill();
        $this->dispatch('contact-created');
        // Redirect to the 'posts.list' route after success
    }

}
