<?php

namespace ThalysJuvenal\Aurum\Tests\Fixtures;

use Filament\Panel;
use Filament\PanelProvider;
use ThalysJuvenal\Aurum\AurumTheme;

/**
 * Painel com uma logo de consumidor configurada (->brandLogo()/
 * ->darkModeBrandLogo()/->brandLogoHeight()): prova, de ponta a ponta
 * (registerAuthBrandRenderHook → view), que o bloco de marca troca o
 * quadrado gradiente por essa logo real.
 */
class BrandedPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('branded')
            ->path('branded')
            ->login()
            ->brandLogo('https://example.com/logo-light.png')
            ->darkModeBrandLogo('https://example.com/logo-dark.png')
            ->brandLogoHeight('3rem')
            ->plugin(
                AurumTheme::make()
                    ->brandName('BRANDED')
                    ->brandTagline('CUSTOM LOGO')
            );
    }
}
