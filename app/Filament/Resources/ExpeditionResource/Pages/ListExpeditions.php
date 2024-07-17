<?php

namespace App\Filament\Resources\ExpeditionResource\Pages;

use App\Filament\Resources\ExpeditionResource;
use App\Models\expedition;
use Faker\Provider\Text;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Livewire;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\Page;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\On;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;


class ListExpeditions extends ListRecords
{
    protected static string $resource = ExpeditionResource::class;
    protected static ?string $title = 'Historique de Toutes vos Agences';

    #[On('contact-created')]

       public function refresh() {}


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Envoyez Vos colis')->icon('heroicon-o-truck'),

        ];

    }





}
