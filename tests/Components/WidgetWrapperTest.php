<?php

use Livewire\Livewire;
use ThalysJuvenal\Aurum\Tests\Fixtures\FixtureStatsOverview;
use ThalysJuvenal\Aurum\Tests\Fixtures\FixtureValueList;

/**
 * Regression guard: AurumStatsOverview/AurumValueList point $view at the
 * wrapper views (widgets/stats-overview-widget.blade.php and
 * widgets/value-list-widget.blade.php), which wrap the content in
 * <x-filament-widgets::widget>. That component is solely responsible for
 * turning getColumnSpan()/getColumnStart() into grid CSS
 * (vendor/filament/widgets/resources/views/components/widget.blade.php
 * renders $attributes->gridColumn(...) and the fi-wi-widget class).
 *
 * Without these tests, reverting $view to the content views (without the
 * wrapper) would pass the suite silently.
 */
it('wraps the stats overview content in the filament widget component', function () {
    $html = Livewire::test(FixtureStatsOverview::class)->html();

    expect($html)
        ->toContain('fi-wi-widget')
        ->toContain('aurum-stats-grid');
});

it('emits grid-column CSS for the stats overview column span', function () {
    $html = Livewire::test(FixtureStatsOverview::class)->html();

    expect($html)
        ->toContain('lg:fi-grid-col-span')
        ->toContain('--col-span-lg: span 2 / span 2');
});

it('wraps the value list content in the filament widget component', function () {
    $html = Livewire::test(FixtureValueList::class)->html();

    expect($html)
        ->toContain('fi-wi-widget')
        ->toContain('aurum-value-list');
});

it('emits grid-column CSS for the value list column span', function () {
    $html = Livewire::test(FixtureValueList::class)->html();

    expect($html)
        ->toContain('lg:fi-grid-col-span')
        ->toContain('--col-span-lg: span 2 / span 2');
});
