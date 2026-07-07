<?php

namespace ThalysJuvenal\Aurum\Schemas;

use Closure;
use Filament\Schemas\Components\Component;

class Timeline extends Component
{
    protected string $view = 'aurum-filament-theme::schemas.timeline';

    /** @var array<TimelineItem>|Closure */
    protected array|Closure $items = [];

    final public function __construct() {}

    public static function make(): static
    {
        $static = app(static::class);
        $static->configure();

        return $static;
    }

    /**
     * @param  array<TimelineItem>|Closure  $items
     */
    public function items(array|Closure $items): static
    {
        $this->items = $items;

        return $this;
    }

    /** @return array<TimelineItem> */
    public function getItems(): array
    {
        return $this->evaluate($this->items);
    }

    /**
     * @return array<string, mixed>
     */
    public function getViewData(): array
    {
        return [
            ...parent::getViewData(),
            'items' => $this->getItems(),
        ];
    }
}
