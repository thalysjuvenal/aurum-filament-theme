<?php

namespace ThalysJuvenal\Aurum\Presets;

/**
 * The Aurum "ruby" scale (hex → OKLCH; hex reference in the comment).
 */
class Ruby extends AurumPreset
{
    public function name(): string
    {
        return 'ruby';
    }

    public function palette(): array
    {
        return [
            50 => 'oklch(0.974 0.012 22.0)',
            100 => 'oklch(0.937 0.031 22.0)',
            200 => 'oklch(0.886 0.058 22.0)',
            300 => 'oklch(0.817 0.100 22.0)', // #FDA9A6
            400 => 'oklch(0.751 0.130 22.0)', // #F68B89 (dark-mode reference)
            500 => 'oklch(0.671 0.123 22.0)', // #D77573
            600 => 'oklch(0.611 0.115 22.0)', // #BF6564 (light-mode reference)
            700 => 'oklch(0.516 0.095 22.0)',
            800 => 'oklch(0.440 0.079 22.0)',
            900 => 'oklch(0.383 0.064 22.0)',
            950 => 'oklch(0.266 0.043 22.0)',
        ];
    }

    public function accentHex(): array
    {
        return [
            300 => '#FDA9A6',
            400 => '#F68B89',
            500 => '#D77573',
            600 => '#BF6564',
            'onAccentDark' => '#1B1010',
            'logoFrom' => '#FDA9A6',
            'logoTo' => '#D77573',
        ];
    }
}
