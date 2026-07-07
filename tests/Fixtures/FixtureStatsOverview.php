<?php

namespace ThalysJuvenal\Aurum\Tests\Fixtures;

use ThalysJuvenal\Aurum\Widgets\AurumStat;
use ThalysJuvenal\Aurum\Widgets\AurumStatsOverview;

/**
 * Concrete fixture used to prove, via Livewire::test(), that the
 * <x-filament-widgets::widget> wrapper (fi-wi-widget + gridColumn) actually
 * wraps AurumStatsOverview's content view.
 */
class FixtureStatsOverview extends AurumStatsOverview
{
    protected int|string|array $columnSpan = 2;

    protected function getStats(): array
    {
        return [
            AurumStat::make('Pendentes', '12')->trend('down', '-3'),
        ];
    }
}
