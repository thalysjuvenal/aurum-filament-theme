<?php

use ThalysJuvenal\Aurum\Schemas\TotalsBlock;
use ThalysJuvenal\Aurum\Schemas\TotalsRow;

it('builds a row with fluent api and getters', function () {
    $row = TotalsRow::make('Subtotal', 'R$ 150,00');

    expect($row->getLabel())->toBe('Subtotal')
        ->and($row->getValue())->toBe('R$ 150,00');
});

it('renders rows and total with mono values', function () {
    $html = view('aurum-filament-theme::schemas.totals-block', [
        'rows' => [
            TotalsRow::make('Subtotal', 'R$ 150,00'),
            TotalsRow::make('Frete', 'R$ 20,00'),
        ],
        'total' => TotalsRow::make('Total', 'R$ 170,00'),
    ])->render();

    expect($html)
        ->toContain('aurum-totals')
        ->toContain('aurum-totals-row')
        ->toContain('aurum-totals-total')
        ->toContain('aurum-mono')
        ->toContain('Subtotal')
        ->toContain('R$ 170,00');
});

it('renders without a total block when total is null', function () {
    $html = view('aurum-filament-theme::schemas.totals-block', [
        'rows' => [
            TotalsRow::make('Subtotal', 'R$ 150,00'),
        ],
        'total' => null,
    ])->render();

    expect($html)->not->toContain('aurum-totals-total');
});

it('builds a TotalsBlock schema component exposing rows and total', function () {
    $rows = [
        TotalsRow::make('Subtotal', 'R$ 150,00'),
        TotalsRow::make('Frete', 'R$ 20,00'),
    ];
    $total = TotalsRow::make('Total', 'R$ 170,00');

    $totalsBlock = TotalsBlock::make()->rows($rows)->total($total);

    expect($totalsBlock->getRows())->toBe($rows)
        ->and($totalsBlock->getTotal())->toBe($total);
});

it('defaults total to null on a fresh TotalsBlock', function () {
    expect(TotalsBlock::make()->getTotal())->toBeNull();
});
