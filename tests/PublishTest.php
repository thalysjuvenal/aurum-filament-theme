<?php

use Illuminate\Support\Facades\File;

afterEach(function () {
    File::delete(resource_path('css/filament/admin/aurum-theme.css'));
});

it('publishes the vite theme stub', function () {
    $target = resource_path('css/filament/admin/aurum-theme.css');
    File::delete($target);

    $this->artisan('vendor:publish', ['--tag' => 'aurum-theme-vite'])->assertSuccessful();

    expect(File::exists($target))->toBeTrue()
        ->and(File::get($target))->toContain("@import '../../../../vendor/filament/filament/resources/css/theme.css'");
});
