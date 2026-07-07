<?php

namespace ThalysJuvenal\Aurum\Schemas;

class TimelineItem
{
    protected string $title;

    protected ?string $description = null;

    protected ?string $timestamp = null;

    protected bool $active = false;

    final public function __construct(string $title)
    {
        $this->title = $title;
    }

    public static function make(string $title): static
    {
        return new static($title);
    }

    public function description(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function timestamp(?string $timestamp): static
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function active(bool $active = true): static
    {
        $this->active = $active;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getTimestamp(): ?string
    {
        return $this->timestamp;
    }

    public function isActive(): bool
    {
        return $this->active;
    }
}
