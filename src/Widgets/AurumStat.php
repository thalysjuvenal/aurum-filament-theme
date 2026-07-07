<?php

namespace ThalysJuvenal\Aurum\Widgets;

use InvalidArgumentException;

class AurumStat
{
    protected string $label;

    protected string $value;

    protected ?string $description = null;

    protected ?string $trend = null;

    protected ?string $delta = null;

    protected ?string $icon = null;

    protected bool $monoValue = true;

    final public function __construct(string $label, string $value)
    {
        $this->label = $label;
        $this->value = $value;
    }

    public static function make(string $label, string $value): static
    {
        return new static($label, $value);
    }

    public function description(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function trend(string $direction, ?string $delta = null): static
    {
        if (! in_array($direction, ['up', 'down', 'neutral'], true)) {
            throw new InvalidArgumentException(
                "Invalid trend direction [{$direction}]. Expected one of: up, down, neutral."
            );
        }

        $this->trend = $direction;
        $this->delta = $delta;

        return $this;
    }

    public function icon(?string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function monoValue(bool $monoValue = true): static
    {
        $this->monoValue = $monoValue;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getTrend(): ?string
    {
        return $this->trend;
    }

    public function getDelta(): ?string
    {
        return $this->delta;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function isMonoValue(): bool
    {
        return $this->monoValue;
    }
}
