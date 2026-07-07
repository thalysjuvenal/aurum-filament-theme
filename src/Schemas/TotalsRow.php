<?php

namespace ThalysJuvenal\Aurum\Schemas;

class TotalsRow
{
    protected string $label;

    protected string $value;

    final public function __construct(string $label, string $value)
    {
        $this->label = $label;
        $this->value = $value;
    }

    public static function make(string $label, string $value): static
    {
        return new static($label, $value);
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
