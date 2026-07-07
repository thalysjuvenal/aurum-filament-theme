<?php

namespace ThalysJuvenal\Aurum\Presets;

abstract class AurumPreset
{
    abstract public function name(): string;

    /** @return array<int, string> OKLCH 50–950 scale for $panel->colors() */
    abstract public function palette(): array;

    /** @return array<int|string, string> hex reference: 300,400,500,600,onAccentDark,logoFrom,logoTo */
    abstract public function accentHex(): array;

    /** @return array<string, string> */
    public function cssVariables(): array
    {
        $hex = $this->validatedAccentHex();

        return [
            '--aurum-accent-300' => $hex[300],
            '--aurum-accent-400' => $hex[400],
            '--aurum-accent-500' => $hex[500],
            '--aurum-accent-600' => $hex[600],
            '--aurum-accent-rgb' => $this->accentRgb(),
            '--aurum-on-accent-dark' => $hex['onAccentDark'],
            '--aurum-on-accent-light' => '#FFFFFF',
            '--aurum-logo-from' => $hex['logoFrom'],
            '--aurum-logo-to' => $hex['logoTo'],
        ];
    }

    /** "R, G, B" derived from accentHex()[400], for use in CSS rgba()/rgb() expressions. */
    public function accentRgb(): string
    {
        $hex = $this->validatedAccentHex();

        [$r, $g, $b] = sscanf($hex[400], '#%02x%02x%02x');

        return "{$r}, {$g}, {$b}";
    }

    /** "rgba(R, G, B, {$alpha})" derived from accentHex()[400]. */
    public function accentRgba(float $alpha): string
    {
        return "rgba({$this->accentRgb()}, {$alpha})";
    }

    /**
     * Validates accentHex() has all required keys and a well-formed [400] hex color,
     * shared by cssVariables() and accentRgb() to avoid duplicating the parsing/validation logic.
     *
     * @return array<int|string, string>
     */
    private function validatedAccentHex(): array
    {
        $hex = $this->accentHex();

        $requiredKeys = [300, 400, 500, 600, 'onAccentDark', 'logoFrom', 'logoTo'];
        $missingKeys = array_filter(
            $requiredKeys,
            fn ($key) => ! array_key_exists($key, $hex)
        );

        if ($missingKeys !== []) {
            throw new \InvalidArgumentException(
                'Preset ['.$this->name().'] accentHex() is missing required key(s): '.implode(', ', $missingKeys)
            );
        }

        if (! preg_match('/^#[0-9A-Fa-f]{6}$/', (string) $hex[400])) {
            throw new \InvalidArgumentException(
                "Preset [{$this->name()}] accentHex()[400] must be a valid 6-digit hex color, got [{$hex[400]}]"
            );
        }

        return $hex;
    }

    public function styleTag(): string
    {
        $vars = '';

        foreach ($this->cssVariables() as $name => $value) {
            $vars .= e($name).': '.e($value).'; ';
        }

        return '<style data-aurum-preset="'.e($this->name()).'">:root { '.rtrim($vars).' }</style>';
    }
}
