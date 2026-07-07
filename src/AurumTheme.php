<?php

namespace ThalysJuvenal\Aurum;

use Filament\Contracts\Plugin;
use Filament\Facades\Filament;
use Filament\FontProviders\GoogleFontProvider;
use Filament\Panel;
use Filament\Support\Assets\Css;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Contracts\Support\Htmlable;
use ThalysJuvenal\Aurum\Presets\AurumPreset;
use ThalysJuvenal\Aurum\Presets\Gold;

class AurumTheme implements Plugin
{
    protected ?string $brandName = null;

    protected ?string $brandTagline = null;

    protected bool $hideBrandText = false;

    protected string|AurumPreset $preset = Gold::class;

    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'aurum-theme';
    }

    /**
     * Brand name shown in the block above the login card. Null (default)
     * uses the panel's own brand name at render time.
     */
    public function brandName(?string $name): static
    {
        $this->brandName = $name;

        return $this;
    }

    /**
     * Caption shown under the brand name (e.g. "EXECUTIVE ERP"). Null
     * (default) omits the element, with no space reserved.
     */
    public function brandTagline(?string $tagline): static
    {
        $this->brandTagline = $tagline;

        return $this;
    }

    public function getBrandName(): ?string
    {
        return $this->brandName;
    }

    public function getBrandTagline(): ?string
    {
        return $this->brandTagline;
    }

    /**
     * When true AND the panel defines a logo (->brandLogo()/->darkModeBrandLogo()),
     * hides the wordmark/tagline in the brand block — for consumers whose
     * logo already contains the brand name. Without a configured logo, the
     * text is still shown (the square alone, with no name, would look empty).
     */
    public function hideBrandText(bool $hide = true): static
    {
        $this->hideBrandText = $hide;

        return $this;
    }

    public function getHideBrandText(): bool
    {
        return $this->hideBrandText;
    }

    /**
     * Sets the theme's visual preset (an AurumPreset instance or
     * class-string). Default: Gold.
     */
    public function preset(string|AurumPreset $preset): static
    {
        if (is_string($preset) && ! is_subclass_of($preset, AurumPreset::class)) {
            throw new \InvalidArgumentException(
                "Preset class [{$preset}] must extend ".AurumPreset::class
            );
        }

        $this->preset = $preset;

        return $this;
    }

    public function getPreset(): AurumPreset
    {
        if ($this->preset instanceof AurumPreset) {
            return $this->preset;
        }

        return app($this->preset);
    }

    public function register(Panel $panel): void
    {
        $panel
            ->colors([
                'primary' => $this->getPreset()->palette(),
                'gray' => Color::Zinc,
                'success' => '#46A578',
                'warning' => '#D98B41',
                'danger' => '#D2605E',
                'info' => '#6B93D6',
            ])
            ->font('Instrument Sans', provider: GoogleFontProvider::class)
            // Scoped to the panel: only panels with ->plugin(AurumTheme::make())
            // load the CSS (avoids a half-themed look in other panels of the app).
            ->assets([
                Css::make('aurum-theme', __DIR__.'/../resources/css/aurum.css'),
            ], 'thalysjuvenal/aurum-filament-theme');

        $this->registerAuthBrandRenderHook($panel);
        $this->registerPresetStyleRenderHook($panel);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    /**
     * Brand block (square logo + wordmark + tagline) ABOVE the card on ALL
     * of the panel's simple-layout pages — login, register, password
     * request and reset: SIMPLE_LAYOUT_START fires on any SimplePage-based
     * page, and the brand treatment must be the same across the whole auth
     * journey (Filament's native logo is hidden by CSS on these pages).
     * Uses the LAYOUT hook, not the form one (AUTH_LOGIN_FORM_BEFORE): the
     * latter renders INSIDE the card (.fi-simple-main), while the block
     * needs to sit outside and above it — only the layout hook, outside
     * `.fi-simple-main-ctn`, reaches that position (see Filament v5's
     * resources/views/components/layout/simple.blade.php).
     *
     * The registration itself is global to the ViewManager
     * (FilamentView::registerRenderHook is not panel-scoped), so the
     * closure checks at render time whether the CURRENT panel is this same
     * panel (by id) before rendering anything — this avoids leaking into
     * other panels of the app and avoids duplicating the block when more
     * than one panel uses the plugin.
     */
    protected function registerAuthBrandRenderHook(Panel $panel): void
    {
        FilamentView::registerRenderHook(
            PanelsRenderHook::SIMPLE_LAYOUT_START,
            function () use ($panel): string {
                if (Filament::getCurrentPanel()?->getId() !== $panel->getId()) {
                    return '';
                }

                $brandName = $this->getBrandName();

                if (blank($brandName)) {
                    $panelBrandName = $panel->getBrandName();

                    $brandName = $panelBrandName instanceof Htmlable
                        ? strip_tags($panelBrandName->toHtml())
                        : (string) $panelBrandName;
                }

                // The Aurum brand area is ALWAYS dark, so it prefers the
                // panel's dark-mode logo; falls back to the default logo
                // only if there isn't a dedicated one.
                $brandLogo = $panel->getDarkModeBrandLogo() ?? $panel->getBrandLogo();

                return view('aurum-filament-theme::login-brand', [
                    'brandName' => $brandName,
                    'brandTagline' => $this->getBrandTagline(),
                    'brandLogo' => $brandLogo,
                    'brandLogoHeight' => $panel->getBrandLogoHeight(),
                    'hideBrandText' => $this->getHideBrandText(),
                ])->render();
            }
        );
    }

    /**
     * Injects `<style data-aurum-preset="{name}">:root { ... }</style>` into
     * the panel's <head>, overriding the gold defaults set in `:root` in
     * aurum.css. Uses HEAD_END (not STYLES_BEFORE/AFTER): in Filament v5's
     * base layout (resources/views/components/layout/base.blade.php),
     * `@filamentStyles` — which loads the aurum.css <link> registered via
     * `->assets()` — renders BEFORE HEAD_END, and nothing else in <head>
     * comes after it. Only HEAD_END guarantees this inline <style> appears
     * AFTER the theme's <link> in the document, winning by source order
     * (same specificity). Same per-panel-id guard pattern as the brand
     * block in registerAuthBrandRenderHook: the registration is global to
     * the ViewManager, so the closure checks the current panel at render
     * time.
     */
    protected function registerPresetStyleRenderHook(Panel $panel): void
    {
        FilamentView::registerRenderHook(
            PanelsRenderHook::HEAD_END,
            function () use ($panel): string {
                if (Filament::getCurrentPanel()?->getId() !== $panel->getId()) {
                    return '';
                }

                return $this->getPreset()->styleTag();
            }
        );
    }

    /**
     * The Aurum "gold" scale (hex → OKLCH; hex reference in the comment).
     *
     * Kept for public API compatibility; the values now live in
     * Presets\Gold::palette().
     *
     * @return array<int, string>
     */
    public static function gold(): array
    {
        return (new Gold)->palette();
    }
}
