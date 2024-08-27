<?php

namespace App\Filament\Resources\ExpeditionResource\Widgets;

use App\Models\Depense;
use App\Models\Expedition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PostsStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
        Stat::make('Montant Total Depense (FCFA)', Depense::sum('montant'))->icon('heroicon-o-wallet'),
        Stat::make('Montant Total Colis(FCFA)', Expedition::sum('prix'))->icon('heroicon-o-wallet')
		    ->description('Retrouvez ici la Totalité des Montant de Toutes les Agences.'),
        Stat::make('Total Colis en Attente', Expedition::count('recu'))->icon('heroicon-o-gift-top'),
		Stat::make('Colis Impayés ce Mois', Expedition::count('status'))->icon('heroicon-o-gift-top')
		    ->description('Retrouvez ici la Totalité des Tickets Impayés de Toutes les Agences.'),
        ];
    }

}
