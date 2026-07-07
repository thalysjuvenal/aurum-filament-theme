<?php

namespace ThalysJuvenal\Aurum\Tests\Fixtures;

use ThalysJuvenal\Aurum\Widgets\AurumValueList;
use ThalysJuvenal\Aurum\Widgets\ValueListItem;

/**
 * Concrete fixture used to prove, via Livewire::test(), that the
 * <x-filament-widgets::widget> wrapper (fi-wi-widget + gridColumn) actually
 * wraps AurumValueList's content view.
 */
class FixtureValueList extends AurumValueList
{
    protected int|string|array $columnSpan = 2;

    protected ?string $heading = 'Contas a receber';

    protected function getItems(): array
    {
        return [
            ValueListItem::make('Fatura #841')->value('R$ 12.400,00')->status('success'),
        ];
    }
}
