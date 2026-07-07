<?php

use Filament\Facades\Filament;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use ThalysJuvenal\Aurum\AurumTheme;
use ThalysJuvenal\Aurum\Presets\AurumPreset;
use ThalysJuvenal\Aurum\Presets\Emerald;
use ThalysJuvenal\Aurum\Presets\Gold;

it('defaults to the gold preset', function () {
    expect(AurumTheme::make()->getPreset())->toBeInstanceOf(Gold::class);
});

it('throws when preset() is given a class-string that does not extend AurumPreset', function () {
    AurumTheme::make()->preset(stdClass::class);
})->throws(InvalidArgumentException::class, 'Preset class [stdClass] must extend '.AurumPreset::class);

it('still accepts a valid AurumPreset instance via preset()', function () {
    $preset = new Gold;

    expect(AurumTheme::make()->preset($preset)->getPreset())->toBe($preset);
});

it('throws when a preset accentHex() is missing required keys', function () {
    $preset = new class extends AurumPreset
    {
        public function name(): string
        {
            return 'broken';
        }

        public function palette(): array
        {
            return [];
        }

        public function accentHex(): array
        {
            return [
                300 => '#E8BC66',
                400 => '#D9A441',
                500 => '#C08A2E',
                600 => '#A87A22',
                // missing onAccentDark, logoFrom, logoTo
            ];
        }
    };

    $preset->cssVariables();
})->throws(InvalidArgumentException::class);

it('throws when a preset accentHex()[400] is not a valid hex color', function () {
    $preset = new class extends AurumPreset
    {
        public function name(): string
        {
            return 'broken';
        }

        public function palette(): array
        {
            return [];
        }

        public function accentHex(): array
        {
            return [
                300 => '#E8BC66',
                400 => 'not-a-hex',
                500 => '#C08A2E',
                600 => '#A87A22',
                'onAccentDark' => '#17130A',
                'logoFrom' => '#E8BC66',
                'logoTo' => '#B8862F',
            ];
        }
    };

    $preset->cssVariables();
})->throws(InvalidArgumentException::class);

it('gold preset palette matches the original gold scale', function () {
    expect((new Gold)->palette())->toBe(AurumTheme::gold());
});

it('gold css variables carry the spec hex values', function () {
    $vars = (new Gold)->cssVariables();

    expect($vars['--aurum-accent-400'])->toBe('#D9A441')
        ->and($vars['--aurum-accent-rgb'])->toBe('217, 164, 65')
        ->and($vars['--aurum-on-accent-dark'])->toBe('#17130A')
        ->and($vars['--aurum-logo-to'])->toBe('#B8862F');
});

it('renders a style tag with all variables', function () {
    $tag = (new Gold)->styleTag();

    expect($tag)->toStartWith('<style data-aurum-preset="gold">')
        ->toContain('--aurum-accent-300: #E8BC66;')
        ->toContain(':root {')
        ->toEndWith('</style>');
});

it('gold accentRgb returns the accentHex()[400] rgb triplet', function () {
    expect((new Gold)->accentRgb())->toBe('217, 164, 65');
});

it('gold accentRgba returns an rgba() string with the given alpha', function () {
    expect((new Gold)->accentRgba(0.38))->toBe('rgba(217, 164, 65, 0.38)');
});

it('emerald accentRgb returns the accentHex()[400] rgb triplet', function () {
    expect((new Emerald)->accentRgb())->toBe('87, 199, 146');
});

it('registers the preset style tag on the panel render', function () {
    // The default instance of FilamentView::renderHook() renders outside a
    // panel's request context; the panel-id guard (the same pattern as the
    // brand block in registerAuthBrandRenderHook) requires the current
    // panel to be explicitly set, just like the equivalent test in
    // AurumThemeTest ("renders the brand block above the login card...").
    Filament::setCurrentPanel(Filament::getPanel('admin'));

    $html = FilamentView::renderHook(PanelsRenderHook::HEAD_END);

    expect((string) $html)->toContain('data-aurum-preset="gold"');
});
