<?php

// Larastan boots a throwaway Testbench application to resolve Laravel-specific
// types (e.g. `view-string`, checked via `view()->exists()`). That bootstrap
// discovers service providers from `vendor/composer/installed.json`, which
// never contains the package being analysed itself (only its dependencies).
// As a result, `AurumThemeServiceProvider::configurePackage()->hasViews(...)`
// never runs during static analysis, and every `aurum-filament-theme::*` view
// reference is (falsely) reported as an unresolvable `view-string`, even
// though the namespace is registered correctly at real runtime (proven by
// the Pest suite, which renders these views directly).
//
// Register the namespace by hand so PHPStan/Larastan sees exactly what a
// real consuming application sees once the package boots.
if (function_exists('app')) {
    $app = app();

    if ($app !== null && $app->bound('view')) {
        $app->make('view')->addNamespace(
            'aurum-filament-theme',
            __DIR__.'/resources/views',
        );
    }
}
