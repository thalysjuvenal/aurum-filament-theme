# Contributing

Thanks for considering contributing to Aurum!

## PHP version requirements

- **Runtime (consumers):** the package itself supports **PHP ^8.2**, matching `filament/filament` v5. Installing the package in an application (`composer require` without dev dependencies) works on PHP 8.2+.
- **Development (contributors):** the dev toolchain uses **Pest v4**, which requires **PHP >= 8.3**. To run `composer install` with dev dependencies (and therefore the test suite), you need PHP 8.3 or newer. This is also why the CI test matrix runs on PHP 8.3 and 8.4 only.

## Development scripts

| Command | What it runs |
|---|---|
| `composer test` | Pest test suite (`vendor/bin/pest`) |
| `composer lint` | Laravel Pint in check mode (`pint --test`) |
| `composer analyse` | PHPStan level 6 with Larastan (`phpstan analyse`) |

All three must pass before submitting a pull request. If `composer analyse` hits your local PHP CLI memory limit, run `vendor/bin/phpstan analyse --memory-limit=1G`.
