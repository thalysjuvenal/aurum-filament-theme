<?php

namespace ThalysJuvenal\Aurum\Presets;

/**
 * The Aurum "sapphire" scale (hex → OKLCH; hex reference in the comment).
 */
class Sapphire extends AurumPreset
{
    public function name(): string
    {
        return 'sapphire';
    }

    public function palette(): array
    {
        return [
            50 => 'oklch(0.974 0.012 260.0)',
            100 => 'oklch(0.937 0.029 260.0)',
            200 => 'oklch(0.886 0.054 260.0)',
            300 => 'oklch(0.817 0.089 260.0)', // #A2C5FD
            400 => 'oklch(0.751 0.124 260.0)', // #7FAFFD (dark-mode reference)
            500 => 'oklch(0.671 0.123 260.0)', // #6895E1
            600 => 'oklch(0.611 0.115 260.0)', // #5A83C8 (light-mode reference)
            700 => 'oklch(0.516 0.095 260.0)',
            800 => 'oklch(0.440 0.079 260.0)',
            900 => 'oklch(0.383 0.064 260.0)',
            950 => 'oklch(0.266 0.043 260.0)',
        ];
    }

    public function accentHex(): array
    {
        return [
            300 => '#A2C5FD',
            400 => '#7FAFFD',
            500 => '#6895E1',
            600 => '#5A83C8',
            'onAccentDark' => '#0F141C',
            'logoFrom' => '#A2C5FD',
            'logoTo' => '#6895E1',
        ];
    }
}
