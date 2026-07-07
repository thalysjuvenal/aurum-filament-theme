<?php

use Filament\Facades\Filament;
use Filament\Panel;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;

/**
 * Reads the panel's protected HasAssets::$assets array (registered at
 * configuration time by the plugin, before any boot/console-register).
 *
 * @return array<string, array<int, Asset>>
 */
function aurumPanelAssets(Panel $panel): array
{
    return (new ReflectionProperty(Panel::class, 'assets'))->getValue($panel);
}

it('registers the aurum css asset on the plugin panel', function () {
    $assets = aurumPanelAssets(Filament::getPanel('admin'));

    $ids = collect($assets['thalysjuvenal/aurum-filament-theme'] ?? [])
        ->filter(fn ($asset) => $asset instanceof Css)
        ->map(fn (Css $css) => $css->getId());

    expect($ids)->toContain('aurum-theme');
});

it('does not register the aurum css asset on panels without the plugin', function () {
    $assets = aurumPanelAssets(Filament::getPanel('plain'));

    expect($assets)->not->toHaveKey('thalysjuvenal/aurum-filament-theme');
});
