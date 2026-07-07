<?php

use ThalysJuvenal\Aurum\Widgets\AurumStat;

it('builds a stat with fluent api', function () {
    $stat = AurumStat::make('Receita paga', 'R$ 61.435,08')
        ->description('Soma dos pedidos pagos')
        ->trend('up', '+12,4%')
        ->icon('heroicon-o-banknotes');

    expect($stat->getLabel())->toBe('Receita paga')
        ->and($stat->getTrend())->toBe('up')
        ->and($stat->getDelta())->toBe('+12,4%')
        ->and($stat->isMonoValue())->toBeTrue();
});

it('renders the stat card view with aurum classes', function () {
    $html = view('aurum-filament-theme::widgets.stats-overview', [
        'stats' => [AurumStat::make('Pendentes', '12')->trend('down', '-3')],
    ])->render();

    expect($html)
        ->toContain('aurum-stat')
        ->toContain('aurum-stat-label')
        ->toContain('aurum-stat-value')
        ->toContain('aurum-stat-trend is-down')
        ->toContain('Pendentes');
});

it('rejects an invalid trend direction', function () {
    AurumStat::make('X', '1')->trend('sideways');
})->throws(InvalidArgumentException::class);
