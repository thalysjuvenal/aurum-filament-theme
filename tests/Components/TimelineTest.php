<?php

use ThalysJuvenal\Aurum\Schemas\Timeline;
use ThalysJuvenal\Aurum\Schemas\TimelineItem;

it('builds an item with fluent api and inactive default', function () {
    $item = TimelineItem::make('Pedido criado')
        ->description('Recebido via checkout')
        ->timestamp('06/07/2026 10:00');

    expect($item->getTitle())->toBe('Pedido criado')
        ->and($item->getDescription())->toBe('Recebido via checkout')
        ->and($item->getTimestamp())->toBe('06/07/2026 10:00')
        ->and($item->isActive())->toBeFalse()
        ->and(TimelineItem::make('x')->active()->isActive())->toBeTrue();
});

it('renders items with active dot and mono timestamp', function () {
    $html = view('aurum-filament-theme::schemas.timeline', [
        'items' => [
            TimelineItem::make('Pedido criado')
                ->timestamp('06/07/2026 10:00'),
            TimelineItem::make('Pagamento confirmado')
                ->description('Via cartão de crédito')
                ->timestamp('06/07/2026 10:05')
                ->active(),
        ],
    ])->render();

    expect($html)
        ->toContain('aurum-timeline')
        ->toContain('aurum-tl-dot is-active')
        ->toContain('aurum-tl-time aurum-mono')
        ->toContain('Pedido criado')
        ->toContain('Pagamento confirmado');
});

it('builds a Timeline schema component exposing its items', function () {
    $items = [
        TimelineItem::make('Pedido criado')->timestamp('06/07/2026 10:00'),
        TimelineItem::make('Pagamento confirmado')->active(),
    ];

    $timeline = Timeline::make()->items($items);

    expect($timeline->getItems())->toBe($items);
});
