<?php

namespace ThalysJuvenal\Aurum\Widgets;

use InvalidArgumentException;

class ValueListItem
{
    protected string $label;

    protected string $value = '';

    protected string $status = 'muted';

    protected ?string $url = null;

    final public function __construct(string $label)
    {
        $this->label = $label;
    }

    public static function make(string $label): static
    {
        return new static($label);
    }

    public function value(string $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function status(string $status): static
    {
        if (! in_array($status, ['success', 'warning', 'danger', 'info', 'muted'], true)) {
            throw new InvalidArgumentException(
                "Invalid status [{$status}]. Expected one of: success, warning, danger, info, muted."
            );
        }

        $this->status = $status;

        return $this;
    }

    public function url(?string $url): static
    {
        $this->url = $url;

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

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }
}
