<?php

use ThalysJuvenal\Aurum\Presets\Emerald;
use ThalysJuvenal\Aurum\Presets\Gold;
use ThalysJuvenal\Aurum\Presets\Ruby;
use ThalysJuvenal\Aurum\Presets\Sapphire;

function wcagContrast(string $hexA, string $hexB): float
{
    $lum = function (string $hex): float {
        [$r, $g, $b] = sscanf($hex, '#%02x%02x%02x');
        $chan = fn (int $c) => ($v = $c / 255) <= 0.03928 ? $v / 12.92 : (($v + 0.055) / 1.055) ** 2.4;

        return 0.2126 * $chan($r) + 0.7152 * $chan($g) + 0.0722 * $chan($b);
    };
    [$l1, $l2] = [max($lum($hexA), $lum($hexB)), min($lum($hexA), $lum($hexB))];

    return ($l1 + 0.05) / ($l2 + 0.05);
}

dataset('presets', [new Gold, new Emerald, new Sapphire, new Ruby]);

it('dark primary button text meets AA', function ($preset) {
    $hex = $preset->accentHex();
    // texto onAccentDark sobre o stop mais escuro do gradiente dark (500) — pior caso
    expect(wcagContrast($hex['onAccentDark'], $hex[500]))->toBeGreaterThanOrEqual(4.5);
})->with('presets');

it('light primary button text meets large-text AA (adjudicated)', function ($preset) {
    $hex = $preset->accentHex();
    expect(wcagContrast('#FFFFFF', $hex[600]))->toBeGreaterThanOrEqual(3.0);
})->with('presets');

it('dark accent reads on the dark background', function ($preset) {
    $hex = $preset->accentHex();
    expect(wcagContrast($hex[400], '#141519'))->toBeGreaterThanOrEqual(3.0);
})->with('presets');

it('every preset exposes complete palette and variables', function ($preset) {
    expect(array_keys($preset->palette()))->toBe([50, 100, 200, 300, 400, 500, 600, 700, 800, 900, 950])
        ->and($preset->cssVariables())->toHaveCount(9);
})->with('presets');
