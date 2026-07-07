<?php

namespace ThalysJuvenal\Aurum\Widgets;

use Filament\Widgets\Widget;

abstract class AurumValueList extends Widget
{
    protected string $view = 'aurum-filament-theme::widgets.value-list-widget';

    protected ?string $heading = null;

    /** @return array<ValueListItem> */
    abstract protected function getItems(): array;

    protected function getViewData(): array
    {
        return [
            'heading' => $this->heading,
            'items' => $this->getItems(),
        ];
    }
}
