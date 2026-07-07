<?php

it('defines the aurum semantic accent variables with gold defaults', function () {
    $css = file_get_contents(__DIR__.'/../resources/css/aurum.css');

    expect($css)
        ->toContain('--aurum-accent-300: #E8BC66')
        ->toContain('--aurum-accent-400: #D9A441')
        ->toContain('--aurum-accent-500: #C08A2E')
        ->toContain('--aurum-accent-600: #A87A22')
        ->toContain('--aurum-accent-rgb: 217, 164, 65')
        ->toContain('--aurum-on-accent-dark: #17130A')
        ->toContain('--aurum-logo-to: #B8862F');
});

it('references accent colors only through the semantic variables', function () {
    $css = file_get_contents(__DIR__.'/../resources/css/aurum.css');
    $body = preg_replace('/:root\s*\{[^}]*\}/s', '', $css, limit: 1); // remove the defaults block

    expect($body)
        ->not->toContain('#E8BC66')
        ->not->toContain('#D9A441')
        ->not->toContain('#C08A2E')
        ->not->toContain('#A87A22')
        ->not->toContain('#17130A')
        ->not->toContain('217, 164, 65');
});

it('theme css contains the aurum signature tokens', function () {
    $css = file_get_contents(__DIR__.'/../resources/css/aurum.css');

    expect($css)
        ->toContain('IBM Plex Mono')
        ->toContain('.aurum-mono')
        ->toContain('tabular-nums')
        ->toContain('#0F1013')  // sidebar always dark
        ->toContain('#141519')  // dark background
        ->toContain('#F4F3EF'); // light background
});

it('theme css styles the always-dark sidebar and interactions', function () {
    $css = file_get_contents(__DIR__.'/../resources/css/aurum.css');

    expect($css)
        ->toContain('.fi-sidebar')
        ->toContain('.fi-sidebar-item-btn')       // v5's real class name (not -button)
        ->toContain('rgba(var(--aurum-accent-rgb), 0.11)')   // active sidebar item
        ->toContain('rgba(var(--aurum-accent-rgb), 0.15)')   // focus ring
        ->toContain('.fi-simple-layout')          // login
        ->toContain('.fi-simple-header-heading'); // login is always dark
});

it('theme css applies the primary button gradients', function () {
    $css = file_get_contents(__DIR__.'/../resources/css/aurum.css');

    expect($css)
        // dark: 300→500 gradient, on-accent-dark text
        ->toContain('linear-gradient(180deg, var(--aurum-accent-300), var(--aurum-accent-500))')
        ->toContain('color: var(--aurum-on-accent-dark)')
        // light: 500→600 gradient, white text
        ->toContain('linear-gradient(180deg, var(--aurum-accent-500), var(--aurum-accent-600))')
        ->toContain('color: var(--aurum-on-accent-light)');
});

it('theme css guards the selectors validated against the real v5 dom', function () {
    $css = file_get_contents(__DIR__.'/../resources/css/aurum.css');

    expect($css)
        ->toContain('.fi-wi-stats-overview-stat') // exact dark card #1B1D22
        ->toContain('.fi-topbar')                 // topbar is the nav itself
        ->toContain('.fi-fo-field-label');        // dark-mode login labels
});

it('theme css elevates dropdowns and modals to #2A2C33 in dark', function () {
    $css = file_get_contents(__DIR__.'/../resources/css/aurum.css');

    expect($css)
        ->toContain('.fi-dropdown-panel') // dropdowns (filters, bulk, user menu, select)
        ->toContain('.fi-modal-window')   // modals + slide-overs
        ->toContain('#2A2C33');           // elevated tone
});

it('theme css gives the active pagination page the gold pill', function () {
    $css = file_get_contents(__DIR__.'/../resources/css/aurum.css');

    expect($css)
        ->toContain('.fi-pagination-item.fi-active .fi-pagination-item-btn')
        ->toContain('rgba(var(--aurum-accent-rgb), 0.14)')  // gold background for the active page
        ->toContain('.fi-pagination-item-label'); // mono/tabular values
});

it('theme css marks the active tab gold with a gold underline', function () {
    $css = file_get_contents(__DIR__.'/../resources/css/aurum.css');

    expect($css)
        ->toContain('.fi-tabs-item.fi-active')     // schema + listing
        ->toContain('inset 0 -2px 0 var(--aurum-accent-400)')      // 2px gold underline
        ->toContain('.fi-toggle.fi-toggle-off');   // disabled toggle track #3A3D45
});

it('theme css paints the input surface on the wrapper, not the inner control', function () {
    $css = file_get_contents(__DIR__.'/../resources/css/aurum.css');

    // Painting only `.fi-input`/`.fi-select-input` with #15161A created a
    // "box within a box" (opaque square rectangle inside the near-transparent
    // rounded wrapper) in global search, table search, and the "Group by"
    // select. The #15161A surface now lives on the wrapper; the inner
    // control is transparent so the layer isn't duplicated.
    expect($css)
        ->toContain('.dark .fi-input-wrp {')
        ->toContain('.dark .fi-input,
.dark .fi-select-input {
    background-color: transparent;
}');
});

it('theme css elevates the floating toast notification and themes the ColorPicker/FileUpload surfaces', function () {
    $css = file_get_contents(__DIR__.'/../resources/css/aurum.css');

    // The floating toast (.fi-no-notification, inside the .fi-no stack
    // teleported to the body) sits OUTSIDE .fi-dropdown-panel/.fi-modal-window
    // and so didn't inherit the elevated tone — it fell back to Tailwind's
    // default zinc gray in dark mode.
    expect($css)->toContain('.dark .fi-no-notification {');

    // The ColorPicker popover (.fi-fo-color-picker-panel) received NO
    // styling from Filament (transparent background, no border, no padding)
    // and floated loose over the content below.
    expect($css)
        ->toContain('.fi-fo-color-picker-panel {')
        ->toContain('.dark .fi-fo-color-picker-panel {')
        ->toContain(':root:not(.dark) .fi-fo-color-picker-panel {');

    // Even with the panel rounded, the saturation/hue square of the
    // <hex-color-picker> (its own canvas, square corners by default) stayed
    // square inside the rounded panel.
    expect($css)->toContain('.fi-fo-color-picker-panel hex-color-picker {');

    // The FileUpload dropzone (.filepond--hopper) used white at 5% opacity
    // in dark mode, much lighter than the #15161A input surface used by
    // every other field.
    expect($css)->toContain('.dark .fi-fo-file-upload .filepond--root.filepond--hopper {');
});

it('theme css cards exactly one element per widget, never the fi-wi-widget/not-contained wrappers', function () {
    $css = file_get_contents(__DIR__.'/../resources/css/aurum.css');

    // Styling `.fi-wi-widget` (the grid wrapper) too would duplicate the
    // native inner card (.fi-ta-ctn / .fi-section) with a different
    // radius/shadow -> the wrapper's square corners "peeking" behind the
    // real card's 14px radius (a frame/card-behind-card effect). The
    // `.fi-section-not-contained` grouper (the stats-overview row) had the
    // same bug. The visible card is always a single native element per widget.
    expect($css)
        ->toContain('.fi-section:not(.fi-section-not-contained)')
        ->toContain('.fi-ta-ctn {')
        ->not->toContain('.dark .fi-wi-widget')
        ->not->toContain('.fi-wi-widget {')
        ->not->toContain(':root:not(.dark) .fi-wi-widget');
});

it('theme css fixes the Slider fill to the dark-mode reference gold', function () {
    $css = file_get_contents(__DIR__.'/../resources/css/aurum.css');

    // Filament paints .noUi-connect with `bg-primary-500 dark:bg-primary-600`;
    // on this scale 600 (#A87A22) is darker than 500 (#C08A2E), the opposite
    // of the theme's pattern (lighter gold in dark mode). Pins the dark-mode
    // reference gold (#D9A441) in dark mode only, on the fill's real element.
    expect($css)->toContain('.dark .fi-fo-slider .noUi-connect {');
});

it('theme css keeps the gold focus ring only on the rounded input wrapper', function () {
    $css = file_get_contents(__DIR__.'/../resources/css/aurum.css');

    // TextInput's `.fi-input-wrp` has `overflow: hidden`, so a square
    // box-shadow (0 radius) also painted on `.fi-input`/`.fi-select-input`
    // would be clipped by the wrapper itself — invisible, masking any bug.
    // The DatePicker/TimePicker/DateTimePicker wrapper
    // (`.fi-fo-date-time-picker`) has `overflow: visible` and its native
    // input fills the SAME rectangle as the wrapper (no padding); a square
    // box-shadow on the input would show up on top of the wrapper's rounded
    // ring — a halo with square corners. `.fi-input`/`.fi-select-input` have
    // no visible border of their own (border-width 0 in Filament), so the
    // gold ring (color + box-shadow) must live only on
    // `.fi-input-wrp:focus-within`; the inner controls only suppress the
    // browser's native outline.
    expect($css)
        ->toContain('.fi-input-wrp:focus-within {')
        ->toContain('border-color: var(--aurum-accent-400);')
        ->toContain('box-shadow: 0 0 0 3px rgba(var(--aurum-accent-rgb), 0.15);');

    // The combined rule `.fi-input-wrp:focus-within, .fi-input:focus,
    // .fi-select-input:focus { border-color/box-shadow }` must not exist:
    // the inner selectors may only appear in a rule that contains
    // exclusively `outline: none`.
    expect($css)->not->toContain(".fi-input-wrp:focus-within,\n.fi-input:focus,\n.fi-select-input:focus {\n    border-color: var(--aurum-accent-400);");

    preg_match('/\.fi-input:focus,\s*\.fi-select-input:focus\s*\{([^}]*)\}/', $css, $matches);
    expect($matches)->toHaveCount(2);
    expect($matches[1])
        ->toContain('outline: none;')
        ->not->toContain('box-shadow')
        ->not->toContain('border-color');
});

it('theme css hides the native Filament logo inside the login card to avoid a duplicate brand mark', function () {
    $css = file_get_contents(__DIR__.'/../resources/css/aurum.css');

    // Aurum's own brand block is drawn ABOVE the card via a render hook
    // (AurumTheme::registerLoginBrandRenderHook); Filament's native logo,
    // rendered INSIDE the card, needs to stay hidden to avoid duplicating
    // the brand mark.
    expect($css)->toContain('.fi-simple-layout .fi-simple-header .fi-logo {')
        ->toContain('display: none;');
});

it('theme css styles the aurum-auth-brand block above the login card', function () {
    $css = file_get_contents(__DIR__.'/../resources/css/aurum.css');

    expect($css)
        ->toContain('.aurum-auth-brand {')
        ->toContain('.aurum-auth-brand-mark {')
        ->toContain('linear-gradient(135deg, var(--aurum-logo-from), var(--aurum-logo-to))') // 44px gold gradient square
        ->toContain('.aurum-auth-brand-name {')
        ->toContain('letter-spacing: 0.16em;') // "AURUM" wordmark tracked
        ->toContain('.aurum-auth-brand-tagline {');
});

it('theme css left-aligns the login card heading and subheading', function () {
    $css = file_get_contents(__DIR__.'/../resources/css/aurum.css');

    // `.fi-simple-header` is centered by default in Filament (flex flex-col
    // items-center); the design calls for heading + subheading left-aligned
    // inside the card, in contrast with the centered brand block above it.
    expect($css)
        ->toContain('.fi-simple-layout .fi-simple-header {')
        ->toContain('align-items: flex-start;');

    preg_match('/\.fi-simple-layout \.fi-simple-header-heading \{([^}]*)\}/', $css, $headingMatch);
    expect($headingMatch)->toHaveCount(2)
        ->and($headingMatch[1])->toContain('text-align: left;');

    preg_match('/\.fi-simple-layout \.fi-simple-header-subheading \{([^}]*)\}/', $css, $subheadingMatch);
    expect($subheadingMatch)->toHaveCount(2)
        ->and($subheadingMatch[1])->toContain('text-align: left;');
});

it('theme css styles the forgot-password hint link gold on the label row', function () {
    $css = file_get_contents(__DIR__.'/../resources/css/aurum.css');

    // The "Forgot password?" link is Filament's `->hint()` on the password
    // field, natively placed in `.fi-fo-field-label-ctn` (same line as the
    // "Password" label). Scoped to the link inside the label row so it
    // doesn't repaint other links in the simple layout (e.g. the footer).
    expect($css)
        ->toContain('.fi-simple-layout .fi-fo-field-label-ctn .fi-link {')
        ->toContain('color: var(--aurum-accent-400);');
});

it('theme css groups the brand block and card into one centered column', function () {
    $css = file_get_contents(__DIR__.'/../resources/css/aurum.css');

    // Native `.fi-simple-layout` is flex-col WITHOUT justify-center —
    // `.fi-simple-main-ctn` (flex-grow + items-center) used to center ONLY
    // the card in the remaining space, and the brand block from the hook
    // stayed pinned to the top of the viewport. The whole column (brand +
    // card) is now centered by the layout itself; the card container loses
    // the grow and the card loses its native my-16 (the gap between brand
    // and card comes from margin-bottom: 28px on .aurum-auth-brand).
    preg_match('/\.fi-simple-layout \{([^}]*)\}/', $css, $layoutMatch);
    expect($layoutMatch)->toHaveCount(2)
        ->and($layoutMatch[1])->toContain('justify-content: center;');

    preg_match('/\.fi-simple-main-ctn \{([^}]*)\}/', $css, $ctnMatch);
    expect($ctnMatch)->toHaveCount(2)
        ->and($ctnMatch[1])->toContain('flex-grow: 0;');

    preg_match('/\n\.fi-simple-main \{([^}]*)\}/', $css, $mainMatch);
    expect($mainMatch)->toHaveCount(2)
        ->and($mainMatch[1])->toContain('margin-top: 0;')
        ->and($mainMatch[1])->toContain('margin-bottom: 0;');
});

it('theme css hides the required asterisks only on simple-layout auth pages', function () {
    $css = file_get_contents(__DIR__.'/../resources/css/aurum.css');

    // Auth form labels don't mark required fields with `*`; admin forms
    // still REQUIRE the asterisk — so the selector must be scoped to
    // .fi-simple-layout (never global).
    expect($css)
        ->toContain('.fi-simple-layout .fi-fo-field-label-required-mark {')
        ->not->toMatch('/(^|\n)\.fi-fo-field-label-required-mark\s*\{/');
});

it('theme css tones the input affix divider for dark mode', function () {
    $css = file_get_contents(__DIR__.'/../resources/css/aurum.css');

    // The divider between the input and its affix
    // (`.fi-input-wrp-suffix`/`-prefix`, used by the password-reveal button
    // and prefixes like "R$"/"kg") only swaps from Filament's native light
    // gray (var(--gray-200)) to a dark tone via the `:where(.dark, .dark *)`
    // selector — but the login (`.fi-simple-layout`) is always dark without
    // ever getting the `.dark` class, so the divider showed up as a bright
    // white line over the dark input background. Needs to cover both the
    // always-dark login context and the panel's standard `.dark` mode, with
    // the same neutral tone (white rgba .05–.06) used by the theme's other
    // dividers.
    expect($css)
        ->toContain('.fi-simple-layout .fi-input-wrp-suffix:not(.fi-inline)')
        ->toContain('.fi-simple-layout .fi-input-wrp-prefix:not(.fi-inline)')
        ->toContain('.dark .fi-input-wrp-suffix:not(.fi-inline)')
        ->toContain('.dark .fi-input-wrp-prefix:not(.fi-inline)')
        ->toContain('border-color: rgba(255, 255, 255, 0.06);');
});
