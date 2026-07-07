<?php

use Filament\Facades\Filament;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Contracts\Support\Htmlable;
use ThalysJuvenal\Aurum\AurumTheme;

it('is registered on the admin panel', function () {
    $panel = Filament::getPanel('admin');

    expect($panel->getPlugin('aurum-theme'))->toBeInstanceOf(AurumTheme::class);
});

it('registers the aurum color palette on the panel', function () {
    $colors = Filament::getPanel('admin')->getColors();

    // Full primary palette (11 tones), identical to the gold scale.
    expect($colors['primary'] ?? null)->toBe(AurumTheme::gold())
        ->and($colors['success'] ?? null)->toBe('#46A578')
        ->and($colors['warning'] ?? null)->toBe('#D98B41')
        ->and($colors['danger'] ?? null)->toBe('#D2605E')
        ->and($colors['info'] ?? null)->toBe('#6B93D6');
});

it('uses Instrument Sans as the panel font', function () {
    expect(Filament::getPanel('admin')->getFontFamily())->toBe('Instrument Sans');
});

it('has a null brand name and tagline by default', function () {
    $plugin = AurumTheme::make();

    expect($plugin->getBrandName())->toBeNull()
        ->and($plugin->getBrandTagline())->toBeNull();
});

it('fluently configures the brand name and tagline', function () {
    $plugin = AurumTheme::make()
        ->brandName('AURUM')
        ->brandTagline('ERP EXECUTIVO');

    expect($plugin->getBrandName())->toBe('AURUM')
        ->and($plugin->getBrandTagline())->toBe('ERP EXECUTIVO');
});

it('renders the brand block above the login card for the configured panel', function () {
    Filament::setCurrentPanel(Filament::getPanel('admin'));

    $html = FilamentView::renderHook(PanelsRenderHook::SIMPLE_LAYOUT_START)->toHtml();

    expect($html)
        ->toContain('AURUM')
        ->toContain('ERP EXECUTIVO')
        ->toContain('aurum-auth-brand');
});

it('does not render the brand block for panels without the plugin', function () {
    Filament::setCurrentPanel(Filament::getPanel('plain'));

    $html = FilamentView::renderHook(PanelsRenderHook::SIMPLE_LAYOUT_START)->toHtml();

    // The "plain" panel doesn't load the Aurum plugin: no brand block.
    expect($html)->not->toContain('aurum-auth-brand');
});

it('omits the tagline element when no tagline is configured', function () {
    $html = view('aurum-filament-theme::login-brand', [
        'brandName' => 'AURUM',
        'brandTagline' => null,
    ])->render();

    expect($html)
        ->toContain('AURUM')
        ->not->toContain('aurum-auth-brand-tagline');
});

it('has hideBrandText disabled by default', function () {
    $plugin = AurumTheme::make();

    expect($plugin->getHideBrandText())->toBeFalse();
});

it('fluently configures hideBrandText', function () {
    $plugin = AurumTheme::make()->hideBrandText();

    expect($plugin->getHideBrandText())->toBeTrue();

    $plugin->hideBrandText(false);

    expect($plugin->getHideBrandText())->toBeFalse();
});

it('renders an img logo instead of the gradient mark when a brand logo is provided', function () {
    $html = view('aurum-filament-theme::login-brand', [
        'brandName' => 'AURUM',
        'brandTagline' => null,
        'brandLogo' => 'https://example.com/logo.png',
    ])->render();

    expect($html)
        ->toContain('<img')
        ->toContain('src="https://example.com/logo.png"')
        ->toContain('aurum-auth-brand-logo')
        ->not->toContain('aurum-auth-brand-mark');
});

it('renders the gradient mark when no brand logo is provided', function () {
    $html = view('aurum-filament-theme::login-brand', [
        'brandName' => 'AURUM',
        'brandTagline' => null,
    ])->render();

    expect($html)
        ->toContain('aurum-auth-brand-mark')
        ->not->toContain('<img');
});

it('renders an Htmlable brand logo (e.g. inline SVG) in a wrapper div', function () {
    $logo = new class implements Htmlable
    {
        public function toHtml()
        {
            return '<svg data-testid="inline-logo"></svg>';
        }
    };

    $html = view('aurum-filament-theme::login-brand', [
        'brandName' => 'AURUM',
        'brandTagline' => null,
        'brandLogo' => $logo,
    ])->render();

    expect($html)
        ->toContain('aurum-auth-brand-logo')
        ->toContain('data-testid="inline-logo"')
        ->not->toContain('aurum-auth-brand-mark');
});

it('defaults the logo height to 44px when the panel does not define brandLogoHeight', function () {
    $html = view('aurum-filament-theme::login-brand', [
        'brandName' => 'AURUM',
        'brandTagline' => null,
        'brandLogo' => 'https://example.com/logo.png',
    ])->render();

    expect($html)->toContain('height: 44px');
});

it('respects a custom brandLogoHeight from the panel', function () {
    $html = view('aurum-filament-theme::login-brand', [
        'brandName' => 'AURUM',
        'brandTagline' => null,
        'brandLogo' => 'https://example.com/logo.png',
        'brandLogoHeight' => '3rem',
    ])->render();

    expect($html)->toContain('height: 3rem');
});

it('escapes the brand logo url', function () {
    $html = view('aurum-filament-theme::login-brand', [
        'brandName' => 'AURUM',
        'brandTagline' => null,
        'brandLogo' => 'https://example.com/logo.png?a=1&b="x"',
    ])->render();

    expect($html)
        ->toContain('&amp;')
        ->not->toContain('b="x"');
});

it('keeps the wordmark and tagline below the logo by default', function () {
    $html = view('aurum-filament-theme::login-brand', [
        'brandName' => 'AURUM',
        'brandTagline' => 'ERP EXECUTIVO',
        'brandLogo' => 'https://example.com/logo.png',
    ])->render();

    expect($html)
        ->toContain('<img')
        ->toContain('aurum-auth-brand-text')
        ->toContain('AURUM')
        ->toContain('ERP EXECUTIVO');
});

it('hides the wordmark and tagline when hideBrandText is enabled and a logo is present', function () {
    $html = view('aurum-filament-theme::login-brand', [
        'brandName' => 'AURUM',
        'brandTagline' => 'ERP EXECUTIVO',
        'brandLogo' => 'https://example.com/logo.png',
        'hideBrandText' => true,
    ])->render();

    expect($html)
        ->toContain('<img')
        ->not->toContain('aurum-auth-brand-text');
});

it('ignores hideBrandText when no logo is present, so the block is never left empty', function () {
    $html = view('aurum-filament-theme::login-brand', [
        'brandName' => 'AURUM',
        'brandTagline' => 'ERP EXECUTIVO',
        'hideBrandText' => true,
    ])->render();

    expect($html)
        ->toContain('aurum-auth-brand-mark')
        ->toContain('aurum-auth-brand-text');
});

it('renders the panel dark-mode brand logo in the render hook, preferring it over the light logo', function () {
    Filament::setCurrentPanel(Filament::getPanel('branded'));

    $html = FilamentView::renderHook(PanelsRenderHook::SIMPLE_LAYOUT_START)->toHtml();

    expect($html)
        ->toContain('src="https://example.com/logo-dark.png"')
        ->not->toContain('logo-light.png')
        ->toContain('height: 3rem')
        ->not->toContain('aurum-auth-brand-mark');
});
