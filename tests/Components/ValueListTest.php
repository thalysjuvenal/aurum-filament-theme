<?php

use ThalysJuvenal\Aurum\Widgets\ValueListItem;

it('builds an item with fluent api and muted default', function () {
    $item = ValueListItem::make('Fatura #841')->value('R$ 12.400,00')->status('warning');

    expect($item->getLabel())->toBe('Fatura #841')
        ->and($item->getStatus())->toBe('warning')
        ->and(ValueListItem::make('x')->getStatus())->toBe('muted');
});

it('renders items with status dot and mono value', function () {
    $html = view('aurum-filament-theme::widgets.value-list', [
        'heading' => 'Contas a receber',
        'items' => [ValueListItem::make('Fatura #841')->value('R$ 12.400,00')->status('success')],
    ])->render();

    expect($html)
        ->toContain('aurum-value-list')
        ->toContain('aurum-vl-dot is-success')
        ->toContain('aurum-vl-value aurum-mono')
        ->toContain('Contas a receber');
});

it('rejects an invalid status', function () {
    ValueListItem::make('x')->status('sideways');
})->throws(InvalidArgumentException::class);
