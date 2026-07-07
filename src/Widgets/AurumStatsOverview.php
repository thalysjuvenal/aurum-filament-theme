<?php

namespace ThalysJuvenal\Aurum\Widgets;

use Filament\Widgets\Widget;

abstract class AurumStatsOverview extends Widget
{
    protected string $view = 'aurum-filament-theme::widgets.stats-overview-widget';

    /** @return array<AurumStat> */
    abstract protected function getStats(): array;

    protected function getViewData(): array
    {
        return ['stats' => $this->getStats()];
    }
}
