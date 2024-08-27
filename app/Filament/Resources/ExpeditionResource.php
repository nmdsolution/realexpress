<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpeditionResource\Pages;
use App\Filament\Resources\ExpeditionResource\RelationManagers;
use App\Models\Bus; // Use proper case for the model class name
use App\Models\Expedition;
use App\Models\Location; // Use proper case for the model class name
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Columns\Summarizers\Average;
use Filament\Tables\Columns\Summarizers\Range;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ExpeditionResource extends Resource
{
    protected static ?string $model = Expedition::class;

    protected static ?string $navigationIcon = 'heroicon-s-envelope';
    protected static ?string $navigationGroup = 'Bon Voyage';

    public static function getWidgets(): array
    {
        return [
            ExpeditionResource\Widgets\CreateExpeditionWidget::class,
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Expedition Details')->schema([
                    Grid::make()
                        ->columns([
                            'sm' => 3,
                            'xl' => 4,
                            '2xl' => 3,
                        ])
                        ->schema([
                            TextInput::make('ref_no')
                                ->label('N° Ticket')
                                ->default(Auth::user()->agence . random_int(100000, 999999))
                                ->disabled()
                                ->required()
                                ->dehydrated()
                                ->maxLength(255),
                            Select::make('bus_id')
                                ->label('Bus')
                                ->required()
                                ->options(Bus::all()->pluck('nom', 'id')),
                            Select::make('from_location')
                                ->label('Agence de Départ')
                                ->required()
                                ->options(Location::all()->pluck('point_darret', 'point_darret')),
                            Select::make('to_location')
                                ->label('Agence Destination')
                                ->options(Location::all()->pluck('point_darret', 'point_darret'))
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
                                ->label('Frais d\'Envoi')
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
                                ->label('Numero Expéditeur')
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
                            TextInput::make('agent')
                                ->disabled()
                                ->required()
                                ->dehydrated()
                                ->default(Auth::user()->name),
                            Select::make('status')
                                ->options([
                                    'payer' => 'Payé',
                                    'impayer' => 'Impayé',
                                ])
                                ->native(false)
                                ->required(),
                            Select::make('recu')
                                ->label('Reçu')
                                ->options([
                                    'reçu' => 'Reçu',
                                    'en attente' => 'En attente',
                                ])
                                ->default('en attente'),
                        ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ref_no')
                    ->searchable()
                    ->label('N° Ticket'),
                Tables\Columns\TextColumn::make('to_location')
                    ->label('Ville')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nature du Colis')
                    ->searchable()
                    ->icon('heroicon-o-gift'),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('prix')
                    ->summarize(Sum::make()->label('Montant total'))
                    ->label('Frais d\'Envoi')
                    ->suffix('FCFA')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('expediteur')
                    ->label('Expéditeur')
                    ->searchable(),
                Tables\Columns\TextColumn::make('destinataire')
                    ->label('Récepteur')
                    ->searchable(),
                Tables\Columns\TextColumn::make('recu')
                    ->label('Colis Reçu')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('agent')
                    ->searchable()
                    ->icon('heroicon-o-user'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
        ->filters([
            Filter::make('created_at')
                ->label('Ouvertures de la journée')
                ->form([
                    DatePicker::make('created_from')->label('Du'),
                    DatePicker::make('created_until')->label('Au'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date)
                        )
                        ->when(
                            $data['created_until'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date)
                        );
                }),
        ])
        ->actions([
            Tables\Actions\ViewAction::make()->label('Voir'),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
            Tables\Actions\Action::make('pdfo')
                ->label('Imprimer')
                ->color('success')
                ->icon('heroicon-o-printer')
                ->action(fn (Model $record) => redirect()->route('generate-pdf', $record->id)),
        ])
        ->headerActions([])
        ->bulkActions([
            ExportBulkAction::make(),
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define relations here if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExpeditions::route('/'),
            'create' => Pages\CreateExpedition::route('/create'),
            'edit' => Pages\EditExpedition::route('/{record}/edit'),
        ];
    }
}
