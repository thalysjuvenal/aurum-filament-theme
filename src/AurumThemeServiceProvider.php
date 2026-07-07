<?php

namespace ThalysJuvenal\Aurum;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AurumThemeServiceProvider extends PackageServiceProvider
{
    public static string $name = 'aurum-filament-theme';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasViews();
    }

    public function packageBooted(): void
    {
        // The theme's CSS is registered per panel in AurumTheme::register()
        // (scoped to the plugin) — panels without ->plugin(AurumTheme::make())
        // don't get the theme. Only the publishable Vite stub lives here.
        $this->publishes([
            __DIR__.'/../resources/css/theme-stub.css' => resource_path('css/filament/admin/aurum-theme.css'),
        ], 'aurum-theme-vite');
    }
}
