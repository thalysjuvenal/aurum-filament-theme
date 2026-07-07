<?php

namespace ThalysJuvenal\Aurum\Tests\Fixtures;

use Filament\Panel;
use Filament\PanelProvider;

/**
 * Panel WITHOUT the Aurum plugin: proves the theme's CSS is scoped to the
 * panel and doesn't leak into other panels of the consuming app.
 */
class PlainPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('plain')
            ->path('plain')
            ->login();
    }
}
