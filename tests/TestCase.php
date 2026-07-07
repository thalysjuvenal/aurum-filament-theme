<?php

namespace ThalysJuvenal\Aurum\Tests;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Filament\Actions\ActionsServiceProvider;
use Filament\FilamentServiceProvider;
use Filament\Forms\FormsServiceProvider;
use Filament\Infolists\InfolistsServiceProvider;
use Filament\Notifications\NotificationsServiceProvider;
use Filament\Schemas\SchemasServiceProvider;
use Filament\Support\SupportServiceProvider;
use Filament\Tables\TablesServiceProvider;
use Filament\Widgets\WidgetsServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use ThalysJuvenal\Aurum\AurumThemeServiceProvider;
use ThalysJuvenal\Aurum\Tests\Fixtures\AdminPanelProvider;
use ThalysJuvenal\Aurum\Tests\Fixtures\BrandedPanelProvider;
use ThalysJuvenal\Aurum\Tests\Fixtures\PlainPanelProvider;

abstract class TestCase extends Orchestra
{
    protected function getEnvironmentSetUp($app): void
    {
        // Livewire::test() encrypts request/response payloads (checksums,
        // wire:snapshot) and needs a real app key. A fresh `composer install`
        // (as in CI) has no cached testbench .env/key, so without this the
        // Livewire test pipeline throws "No application encryption key has
        // been specified."
        $app['config']->set('app.key', 'base64:'.base64_encode(random_bytes(32)));
    }

    protected function getPackageProviders($app): array
    {
        return [
            // Filament v5 providers: if the list below fails to boot
            // (class not found), check vendor/filament/*/composer.json
            // ("extra.laravel.providers") for the real class names.
            SupportServiceProvider::class,
            FilamentServiceProvider::class,
            ActionsServiceProvider::class,
            FormsServiceProvider::class,
            InfolistsServiceProvider::class,
            NotificationsServiceProvider::class,
            SchemasServiceProvider::class,
            TablesServiceProvider::class,
            WidgetsServiceProvider::class,
            LivewireServiceProvider::class,
            BladeIconsServiceProvider::class,
            BladeHeroiconsServiceProvider::class,
            AurumThemeServiceProvider::class,
            AdminPanelProvider::class,
            PlainPanelProvider::class,
            BrandedPanelProvider::class,
        ];
    }
}
