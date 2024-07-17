<?php

namespace App\Filament\Resources\ExpeditionResource\Widgets;

use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ListExpeditionsWidget extends Widget
{
    protected static string $view = 'filament.resources.expedition-resource.widgets.list-expeditions-widget';
    protected int | string | array $columnSpan = 'full';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function table(Table $table): Table
    {

        return $table

            ->columns([

               TextColumn::make('ref_no')
                    ->searchable()
                    ->label('N° Ticket'),
                TextColumn::make('to_location')
                    ->label('Ville')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Nature du Colis')
                    ->searchable()
                    ->icon('heroicon-o-gift'),
                TextColumn::make('qty')
                    ->summarize(Sum::make()->label('Total Colis'))
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('prix')
                    ->summarize(Sum::make()->label('Montant total'))
                    ->label('Frais denvoi')
                    ->suffix('FCFA')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('expeditair')
                    ->label('Expéditeure')
                    ->searchable(),
                TextColumn::make('destinatair')
                    ->label('Recepteur')
                    ->searchable(),
                TextColumn::make('agent')
                    ->searchable()
                    ->icon('heroicon-o-user')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ]) ->defaultSort('created_at', 'desc')
            ->filters([
                Filter::make('created_at')
                    ->label('Ouvrire la journer')
                    ->form([
                        DatePicker::make('created_from')->label('Ouvrire la journer du'),
                        DatePicker::make('created_until')->label('jusqua'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
            );
                    })
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
                ViewAction::make()->label('Voir'),
                Action::make('pdfo')
                    ->label('imprimer')
                    ->color('success')
                    ->icon('heroicon-o-printer')
                    ->action(fn (Model $record) => redirect()->route('generate-pdf', $record->id)),


            ])
            ->headerActions([


            ])
            ->bulkActions([
                ExportBulkAction::make(),
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);

    }

}
