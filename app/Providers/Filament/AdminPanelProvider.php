<?php

namespace App\Providers\Filament;

use App\Filament\Auth\CustomLogin;
use App\Filament\Auth\Login;
use App\Filament\Auth\Register;
use App\Filament\Resources\ExpeditionResource\Widgets\CreateExpeditionWidget;
use App\Filament\Resources\ExpeditionResource\Widgets\ExpeditionChart;
use App\Filament\Resources\ExpeditionResource\Widgets\ExpeditionmoneyChart;
use App\Filament\Resources\ExpeditionResource\Widgets\monthchart;
use App\Filament\Resources\ExpeditionResource\Widgets\PostsStats;
use App\Filament\Resources\UserResource;
use Awcodes\Overlook\Widgets\OverlookWidget;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Pages\Auth\EditProfile;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Rupadana\ApiService\ApiServicePlugin;


class AdminPanelProvider extends PanelProvider
{

    public function panel(Panel $panel): Panel
    {
        return $panel

            ->brandName('Argence de Transport REAL EXPRESS')

            ->default()
            ->id('admin')
            ->path('admin')
            ->login(CustomLogin::class)
            //->registration()
            ->profile()

            ->userMenuItems([
                'profile' => MenuItem::make()->url(fn (): string => EditProfile::getUrl())
            ])
            ->renderHook(
            // This line tells us where to render it
                'panels::auth.login.form.after',
                // This is the view that will be rendered
                fn () =>  view('filament.login_extra'),

            )

            ->renderHook(
                'panels::body.end',
                fn () => view('filament.customFooter'),
        )
            ->colors([
                'primary' => Color::Green,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
              //  Widgets\AccountWidget::class,
                    PostsStats::class,
                ExpeditionChart::class,
                    monthchart::class,


                ])

			/*        ->plugins([
            \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make()
        ])*/

            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])->plugins([
                        ApiServicePlugin::make()
                    ]);
    }
}
