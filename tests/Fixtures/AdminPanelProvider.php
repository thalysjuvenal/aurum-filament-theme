<?php

namespace ThalysJuvenal\Aurum\Tests\Fixtures;

use Filament\Panel;
use Filament\PanelProvider;
use ThalysJuvenal\Aurum\AurumTheme;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->default()
            ->login()
            ->plugin(
                AurumTheme::make()
                    ->brandName('AURUM')
                    ->brandTagline('ERP EXECUTIVO')
            );
    }
}
