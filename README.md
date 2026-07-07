# Aurum — Filament v5 Theme

🇬🇧 **English** | [🇧🇷 Português](https://github.com/thalysjuvenal/aurum-filament-theme/blob/main/README.pt-BR.md)

**An executive gold-on-graphite theme engine and UI kit for FilamentPHP v5 panels.**

[![CI](https://github.com/thalysjuvenal/aurum-filament-theme/actions/workflows/ci.yml/badge.svg)](https://github.com/thalysjuvenal/aurum-filament-theme/actions/workflows/ci.yml)
[![License: MIT](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/thalysjuvenal/aurum-filament-theme/blob/main/LICENSE)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/thalysjuvenal/aurum-filament-theme.svg?style=flat-square)](https://packagist.org/packages/thalysjuvenal/aurum-filament-theme)
[![Total Downloads](https://img.shields.io/packagist/dt/thalysjuvenal/aurum-filament-theme.svg?style=flat-square)](https://packagist.org/packages/thalysjuvenal/aurum-filament-theme)

## Screenshots

**Gold (default) — dashboard**

| Dashboard — dark | Dashboard — light |
|---|---|
| ![Gold dashboard, dark mode](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/gold-dashboard-dark.png) | ![Gold dashboard, light mode](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/gold-dashboard-light.png) |

| Login | Orders |
|---|---|
| ![Login page with Aurum brand block](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/gold-login.png) | ![Orders table](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/gold-orders.png) |

**Presets — dashboard, dark and light**

| Preset | Dashboard — dark | Dashboard — light |
|---|---|---|
| Emerald | ![Emerald dashboard, dark mode](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/emerald-dashboard-dark.png) | ![Emerald dashboard, light mode](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/emerald-dashboard-light.png) |
| Sapphire | ![Sapphire dashboard, dark mode](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/sapphire-dashboard-dark.png) | ![Sapphire dashboard, light mode](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/sapphire-dashboard-light.png) |
| Ruby | ![Ruby dashboard, dark mode](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/ruby-dashboard-dark.png) | ![Ruby dashboard, light mode](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/ruby-dashboard-light.png) |

Preset login screenshots are in the [Presets](#presets) section below.

## Features

- **4 curated presets** — Gold (default), Emerald, Sapphire, Ruby — each an OKLCH 50–950 scale plus dark/light accent tokens.
- **Always-dark sidebar signature** — the sidebar stays dark even when the panel is in light mode.
- **Executive typography** — Instrument Sans for UI text, IBM Plex Mono with tabular figures (`.aurum-mono`) for numeric columns.
- **Login brand block** — a configurable logo + wordmark + tagline block rendered above the auth card on login, register, and password pages.
- **4 ready-made components** — `AurumStatsOverview`/`AurumStat`, `AurumValueList`, `Timeline`, `TotalsBlock`.
- **Zero-build install** — the theme CSS is registered by the plugin; no Tailwind/Vite step required in the consuming app.
- **Full dark + light modes**, validated end to end against a real Filament v5.6.8 application.

## Requirements

- PHP `^8.2`
- `filament/filament` `^5.0`

> Contributing to this package (running the test suite) requires PHP `>= 8.3` — see [CONTRIBUTING.md](https://github.com/thalysjuvenal/aurum-filament-theme/blob/main/CONTRIBUTING.md).

## Installation

```bash
composer require thalysjuvenal/aurum-filament-theme
php artisan filament:assets
```

In your `PanelProvider`:

```php
use ThalysJuvenal\Aurum\AurumTheme;

public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->plugin(AurumTheme::make());
}
```

Colors, fonts, and the theme CSS are registered by the plugin, scoped to the panel it is attached to — panels without `->plugin(AurumTheme::make())` are left untouched. No build step is required in the consuming app.

## Presets

Aurum ships four color presets. Gold is the default; switch with `->preset()`:

```php
use ThalysJuvenal\Aurum\AurumTheme;
use ThalysJuvenal\Aurum\Presets\Sapphire;

->plugin(
    AurumTheme::make()->preset(Sapphire::class)
)
```

| Preset | Login | Class |
|---|---|---|
| Gold (default) | ![Gold login](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/gold-login.png) | `ThalysJuvenal\Aurum\Presets\Gold` |
| Emerald | ![Emerald login](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/emerald-login.png) | `ThalysJuvenal\Aurum\Presets\Emerald` |
| Sapphire | ![Sapphire login](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/sapphire-login.png) | `ThalysJuvenal\Aurum\Presets\Sapphire` |
| Ruby | ![Ruby login](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/ruby-login.png) | `ThalysJuvenal\Aurum\Presets\Ruby` |

**Buttons, per preset (light mode)**

| Gold | Emerald | Sapphire | Ruby |
|---|---|---|---|
| ![Gold buttons — solid, outlined, sizes and states](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/buttons-gold.png) | ![Emerald buttons — solid, outlined, sizes and states](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/buttons-emerald.png) | ![Sapphire buttons — solid, outlined, sizes and states](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/buttons-sapphire.png) | ![Ruby buttons — solid, outlined, sizes and states](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/buttons-ruby.png) |

All four presets pass the package's WCAG contrast gates (`tests/PresetContrastTest.php`): AA for dark-mode button text, large-text AA for light-mode button text, and a minimum 3:1 accent-on-background ratio.

### Custom presets

Extend `AurumPreset` and implement its three abstract methods — `name()`, `palette()` (an OKLCH 50–950 scale for `$panel->colors()`), and `accentHex()` (reference hex stops used to derive the `--aurum-*` CSS variables):

```php
<?php

namespace App\Filament\Presets;

use ThalysJuvenal\Aurum\Presets\AurumPreset;

class Amethyst extends AurumPreset
{
    public function name(): string
    {
        return 'amethyst';
    }

    public function palette(): array
    {
        return [
            50 => 'oklch(0.974 0.014 300.0)',
            100 => 'oklch(0.937 0.035 300.0)',
            200 => 'oklch(0.886 0.066 300.0)',
            300 => 'oklch(0.817 0.116 300.0)',
            400 => 'oklch(0.751 0.130 300.0)',
            500 => 'oklch(0.671 0.123 300.0)',
            600 => 'oklch(0.611 0.115 300.0)',
            700 => 'oklch(0.516 0.095 300.0)',
            800 => 'oklch(0.440 0.079 300.0)',
            900 => 'oklch(0.383 0.064 300.0)',
            950 => 'oklch(0.266 0.043 300.0)',
        ];
    }

    public function accentHex(): array
    {
        return [
            300 => '#D8B4FE',
            400 => '#C084FC',
            500 => '#A855F7',
            600 => '#9333EA',
            'onAccentDark' => '#1A0F26',
            'logoFrom' => '#D8B4FE',
            'logoTo' => '#A855F7',
        ];
    }
}
```

Then use it like any other preset: `->preset(Amethyst::class)`.

## Components

Read the source under `src/Widgets` and `src/Schemas` for the full API; the examples below are copy-paste runnable.

### Forms

Every stock Filament field type themed end to end — text inputs with affixes, sliders, selects, radios, checkboxes, and toggles all pick up the active preset's accent automatically:

![Form fields — text inputs, selects, radio, checkbox list and toggle, Gold preset](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/form-fields-gold.png)

### `AurumStatsOverview` + `AurumStat`

```php
use ThalysJuvenal\Aurum\Widgets\AurumStat;
use ThalysJuvenal\Aurum\Widgets\AurumStatsOverview;

class RevenueOverview extends AurumStatsOverview
{
    protected function getStats(): array
    {
        return [
            AurumStat::make('Revenue', 'R$ 128.450,00')
                ->description('vs. last month')
                ->trend('up', '+12.4%')
                ->icon('heroicon-o-banknotes'),
        ];
    }
}
```

### `AurumValueList` + `ValueListItem`

```php
use ThalysJuvenal\Aurum\Widgets\AurumValueList;
use ThalysJuvenal\Aurum\Widgets\ValueListItem;

class TopClients extends AurumValueList
{
    protected ?string $heading = 'Top clients';

    protected function getItems(): array
    {
        return [
            ValueListItem::make('Acme Corp')
                ->value('R$ 42.000,00')
                ->status('success')
                ->url('/admin/clients/1'),
        ];
    }
}
```

### `Timeline` + `TimelineItem`

```php
use ThalysJuvenal\Aurum\Schemas\Timeline;
use ThalysJuvenal\Aurum\Schemas\TimelineItem;

Timeline::make()
    ->items([
        TimelineItem::make('Order placed')
            ->timestamp('2026-07-01 09:12')
            ->description('Awaiting payment confirmation'),
        TimelineItem::make('Payment confirmed')
            ->timestamp('2026-07-01 10:03')
            ->active(),
    ])
```

| Gold | Emerald | Sapphire | Ruby |
|---|---|---|---|
| ![Timeline, Gold preset — active step with a gold dot and ring](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/timeline-gold.png) | ![Timeline, Emerald preset — active step with an emerald dot and ring](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/timeline-emerald.png) | ![Timeline, Sapphire preset — active step with a sapphire dot and ring](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/timeline-sapphire.png) | ![Timeline, Ruby preset — active step with a ruby dot and ring](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/timeline-ruby.png) |

### `TotalsBlock` + `TotalsRow`

```php
use ThalysJuvenal\Aurum\Schemas\TotalsBlock;
use ThalysJuvenal\Aurum\Schemas\TotalsRow;

TotalsBlock::make()
    ->rows([
        TotalsRow::make('Subtotal', 'R$ 1.250,00'),
        TotalsRow::make('Tax', 'R$ 125,00'),
    ])
    ->total(TotalsRow::make('Total', 'R$ 1.375,00'))
```

| Dark | Light |
|---|---|
| ![TotalsBlock, dark mode — Subtotal, Shipping and Total rows with tabular numerals](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/totals-block-dark.png) | ![TotalsBlock, light mode — Subtotal, Shipping and Total rows with tabular numerals](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/totals-block-light.png) |

### Theme-aware charts

`AurumPreset` exposes `accentRgb()` and `accentRgba(float $alpha)` so a `ChartWidget` can read the *active* preset's accent instead of hardcoding a color — bars follow whichever preset (Gold/Emerald/Sapphire/Ruby) the panel is configured with:

```php
use Filament\Facades\Filament;

$preset = Filament::getCurrentPanel()->getPlugin('aurum-theme')->getPreset();

'backgroundColor' => $preset->accentRgba(0.38), // past months
'borderColor' => $preset->accentRgba(1.0),      // current month / stroke
```

## Login brand block

Configure a brand name and tagline rendered above the auth card on login, register, and password pages:

```php
->plugin(
    AurumTheme::make()
        ->brandName('AURUM')
        ->brandTagline('ERP EXECUTIVO')
)
```

If `brandName()` is not set, the block falls back to the panel's own brand name at render time. If `brandTagline()` is not set, the tagline element is omitted entirely (no reserved space).

### Using your own logo

By default the block renders a gradient square with the brand's initial. If the panel defines a logo, the block renders it instead:

```php
->brandLogo(asset('images/logo.png'))
->darkModeBrandLogo(asset('images/logo-dark.png')) // optional, see note below
->brandLogoHeight('2.75rem') // optional, defaults to 44px
```

The wordmark and tagline are still rendered below the logo unless you opt out:

```php
->plugin(
    AurumTheme::make()
        ->brandName('AURUM')
        ->hideBrandText() // hides the wordmark/tagline when a logo is present
)
```

`hideBrandText()` only takes effect when the panel has a logo — without one, the block would otherwise be left with nothing but an empty square, so the text always renders in that case.

**The brand area is always dark**, in both light and dark panel modes (it's the Aurum signature, see [Compatibility](#compatibility) and the login screenshots above). Because of this, the block prefers `->darkModeBrandLogo()` over `->brandLogo()` when both are set — supply a logo variant that reads well on a dark background (light mark/wordmark, or one with enough contrast). If you only have a single logo asset, make sure it's legible on dark before relying on `->brandLogo()` alone.

**Trim your logo asset first.** An untrimmed PNG with a lot of transparent padding around the mark (common with exported app icons) renders tiny inside the fixed-height block — the `height` you set applies to the whole canvas, not just the visible mark, so padding shrinks the visible logo instead of the empty space. Trim the asset to its visible content (e.g. `magick logo.png -trim +repage logo.png` or `sips` on macOS) before publishing it.

## Numeric columns

Apply the `.aurum-mono` utility class to currency, date, and code columns for IBM Plex Mono + tabular figures:

```php
TextColumn::make('total')->money('BRL')->extraAttributes(['class' => 'aurum-mono']);
```

## Optional Vite theme

For apps that compile their own Tailwind CSS alongside Aurum:

```bash
php artisan vendor:publish --tag=aurum-theme-vite
```

Then register it on the panel and add the published file to your `vite.config.js` input:

```php
->viteTheme('resources/css/filament/admin/aurum-theme.css')
```

The Aurum theme CSS registered by the plugin keeps working as-is; the Vite stub is only needed if you also compile your own panel CSS.

## Compatibility

The theme's CSS selectors (`.fi-*`) were validated against the real DOM of **Filament v5.6.8**, including systematic visual QA (light and dark modes) across the 10 areas of the official documentation: forms, schemas, tables, resources, infolists, actions, notifications, widgets, navigation, and users (modals, slide-overs, dropdowns, wizards/tabs, repeaters, pagination, bulk selection, database notifications, etc.). `.fi-*` class names are **not** covered by semver — minor Filament releases may rename them and require small adjustments to `aurum.css`.

## Known limitations

- **Collapsed sidebar width:** Filament v5 uses a fixed 88px width in the collapsed state (not driven by a CSS variable); the original Aurum spec called for 64px. Forcing 64px via CSS decenters the icons (the padding is shared with the expanded state), so the theme keeps Filament's default 88px — icons, dark background, and the gold active item stay faithful to the spec.
- **Google Fonts runtime dependency:** the theme loads Instrument Sans via Filament's Google font provider, and IBM Plex Mono via a CSS `@import` from `fonts.googleapis.com`, both at runtime. Air-gapped or intranet deployments without internet access will silently fall back to system fonts, and organizations subject to GDPR may prefer not to have browsers requesting fonts from Google at all. Self-hosting or bundling both font families is on the roadmap.

## Roadmap

Planned for v2:

- Per-user preset switching (persisted at the user level, not just panel-wide).
- RTL support.
- Density modes (compact/comfortable).
- Additional presets.
- Bundled/self-hosted fonts (remove the runtime dependency on Google Fonts).

## Contributing

See [CONTRIBUTING.md](https://github.com/thalysjuvenal/aurum-filament-theme/blob/main/CONTRIBUTING.md) for PHP version requirements, development scripts, and the pull request checklist.

## License

The MIT License (MIT). See [LICENSE](https://github.com/thalysjuvenal/aurum-filament-theme/blob/main/LICENSE) for more information.
