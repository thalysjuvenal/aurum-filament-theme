<?php

namespace ThalysJuvenal\Aurum\Schemas;

use Closure;
use Filament\Schemas\Components\Component;

class TotalsBlock extends Component
{
    protected string $view = 'aurum-filament-theme::schemas.totals-block';

    /** @var array<TotalsRow>|Closure */
    protected array|Closure $rows = [];

    protected TotalsRow|Closure|null $total = null;

    final public function __construct() {}

    public static function make(): static
    {
        $static = app(static::class);
        $static->configure();

        return $static;
    }

    /**
     * @param  array<TotalsRow>|Closure  $rows
     */
    public function rows(array|Closure $rows): static
    {
        $this->rows = $rows;

        return $this;
    }

    public function total(TotalsRow|Closure|null $total): static
    {
        $this->total = $total;

        return $this;
    }

    /** @return array<TotalsRow> */
    public function getRows(): array
    {
        return $this->evaluate($this->rows);
    }

    public function getTotal(): ?TotalsRow
    {
        return $this->evaluate($this->total);
    }

    /**
     * @return array<string, mixed>
     */
    public function getViewData(): array
    {
        return [
            ...parent::getViewData(),
            'rows' => $this->getRows(),
            'total' => $this->getTotal(),
        ];
    }
}
