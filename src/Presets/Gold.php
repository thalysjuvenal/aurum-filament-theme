<?php

namespace ThalysJuvenal\Aurum\Presets;

/**
 * The Aurum "gold" scale (hex → OKLCH; hex reference in the comment).
 */
class Gold extends AurumPreset
{
    public function name(): string
    {
        return 'gold';
    }

    public function palette(): array
    {
        return [
            50 => 'oklch(0.974 0.014 84.6)',  // #FBF6EC
            100 => 'oklch(0.937 0.035 85.4)', // #F5E9D0
            200 => 'oklch(0.886 0.066 85.8)', // #EDD7A8
            300 => 'oklch(0.817 0.116 82.6)', // #E8BC66
            400 => 'oklch(0.751 0.130 79.8)', // #D9A441 (dark-mode reference)
            500 => 'oklch(0.671 0.123 76.5)', // #C08A2E
            600 => 'oklch(0.611 0.115 78.9)', // #A87A22 (light-mode reference)
            700 => 'oklch(0.516 0.095 77.6)', // #86601C
            800 => 'oklch(0.440 0.079 76.6)', // #6B4C18
            900 => 'oklch(0.383 0.064 75.6)', // #573E17
            950 => 'oklch(0.266 0.043 73.8)', // #32220B
        ];
    }

    public function accentHex(): array
    {
        return [
            300 => '#E8BC66',
            400 => '#D9A441',
            500 => '#C08A2E',
            600 => '#A87A22',
            'onAccentDark' => '#17130A',
            'logoFrom' => '#E8BC66',
            'logoTo' => '#B8862F',
        ];
    }
}
