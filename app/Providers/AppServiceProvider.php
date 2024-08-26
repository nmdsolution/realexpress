<?php

namespace App\Providers;

use App\Console\Commands\SyncDatabase;
use Awcodes\Overlook\Widgets\OverlookWidget;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       SyncDatabase::class;

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['ar','en','fr']); // also accepts a closure
        });
        Livewire::setScriptRoute(function ($handle) {
            return Route::get('/vendor/livewire.js', $handle);
        });

    }

	protected $policies = [
    'Spatie\Permission\Models\Role' => 'App\Policies\RolePolicy',
];
}
