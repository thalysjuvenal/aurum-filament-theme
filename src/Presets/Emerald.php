<?php

namespace ThalysJuvenal\Aurum\Presets;

/**
 * The Aurum "emerald" scale (hex → OKLCH; hex reference in the comment).
 */
class Emerald extends AurumPreset
{
    public function name(): string
    {
        return 'emerald';
    }

    public function palette(): array
    {
        return [
            50 => 'oklch(0.974 0.014 160.0)',
            100 => 'oklch(0.937 0.035 160.0)',
            200 => 'oklch(0.886 0.066 160.0)',
            300 => 'oklch(0.817 0.116 160.0)', // #7ADAA9
            400 => 'oklch(0.751 0.130 160.0)', // #57C792 (dark-mode reference)
            500 => 'oklch(0.671 0.123 160.0)', // #42AC7B
            600 => 'oklch(0.611 0.115 160.0)', // #36986B (light-mode reference)
            700 => 'oklch(0.516 0.095 160.0)',
            800 => 'oklch(0.440 0.079 160.0)',
            900 => 'oklch(0.383 0.064 160.0)',
            950 => 'oklch(0.266 0.043 160.0)',
        ];
    }

    public function accentHex(): array
    {
        return [
            300 => '#7ADAA9',
            400 => '#57C792',
            500 => '#42AC7B',
            600 => '#36986B',
            'onAccentDark' => '#0C1611',
            'logoFrom' => '#7ADAA9',
            'logoTo' => '#42AC7B',
        ];
    }
}
