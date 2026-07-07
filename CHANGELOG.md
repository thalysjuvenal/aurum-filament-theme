# Changelog

All notable changes to `aurum-filament-theme` will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.1.1] - 2026-07-07

### Changed

- Republished release — no functional changes. Source comments cleaned up for public consumption and internal development scaffolding removed from the repository. Replaces the `v1.1.0` tag, which pointed at a commit made unreachable by a history rewrite.

## [1.1.0] - 2026-07-07

### Added

- `AurumPreset::accentRgb(): string` — the `"R, G, B"` triplet of `accentHex()[400]`, for use in CSS `rgb()`/`rgba()` expressions.
- `AurumPreset::accentRgba(float $alpha): string` — `"rgba(R, G, B, {$alpha})"` built from the same triplet, so consuming apps can build theme-aware chart colors (e.g. Filament `ChartWidget` datasets) that follow the active preset instead of a hardcoded color.

### Documentation

- README.md / README.pt-BR.md: new "Theme-aware charts" subsection under Components showing how to pull `accentRgba()` from the active preset via the panel plugin; Screenshots section now shows Gold dashboard in dark **and** light, plus a dark/light table for the Emerald, Sapphire, and Ruby dashboards.

## [1.0.1] - 2026-07-06

### Fixed

- `AurumTheme::preset()` now throws `InvalidArgumentException` when given a class-string that does not extend `AurumPreset`, instead of failing later with an opaque container error.
- `AurumPreset::cssVariables()` now validates `accentHex()` (required keys `300, 400, 500, 600, onAccentDark, logoFrom, logoTo` and a valid 6-digit hex for `400`) and throws `InvalidArgumentException` naming the preset when invalid.

### Documentation

- README.md / README.pt-BR.md: documented the runtime dependency on Google Fonts (Instrument Sans via Filament's font provider, IBM Plex Mono via CSS `@import`) under "Known limitations" / "Limitações conhecidas", and added self-hosted/bundled fonts to the Roadmap.

## [1.0.0] - 2026-07-06

### Added

- Complete Aurum theme for FilamentPHP v5 panels, with light and dark modes and an always-dark sidebar.
- Preset engine (`AurumTheme::preset()`) with four executive color presets: Gold, Emerald, Sapphire, and Ruby.
- Four ready-made components: `AurumStat` / `AurumStatsOverview` widgets, `AurumValueList` widget, and `Timeline` / `TotalsBlock` schema components.
- Configurable brand block for the login/auth pages (`brandName()`, `brandTagline()`), rendered above the auth card.
- Publishable Vite theme stub for consuming applications that compile their own panel CSS.
- Validated end to end against a real Filament v5.6.8 application.
