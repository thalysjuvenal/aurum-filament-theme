{{--
    Brand block rendered above the card on auth pages: a square with the
    initial (or the consumer's logo) + wordmark + optional tagline.

    Props:
    - string $brandName: brand name (never empty — falls back to the panel name).
    - string|null $brandTagline: optional caption; element omitted when null.
    - string|\Illuminate\Contracts\Support\Htmlable|null $brandLogo: panel logo
      (prefer ->darkModeBrandLogo(), since the Aurum brand area is always
      dark). Null (default) keeps the gradient square with the initial.
    - string|null $brandLogoHeight: logo height (panel's ->brandLogoHeight()).
      Null → 44px, matching the gradient square's height.
    - bool $hideBrandText: when true AND a logo is present, hides the
      wordmark/tagline (for logos that already contain the brand name).
      Without a logo, the text is always shown — the square alone, with no
      name, would look empty.
--}}
@php
    $brandInitial = mb_substr(trim($brandName), 0, 1);
    $hasBrandLogo = filled($brandLogo ?? null);
    $showBrandText = ! ($hasBrandLogo && ($hideBrandText ?? false));
    $brandLogoHeightValue = ($brandLogoHeight ?? null) ?: '44px';
@endphp

<div class="aurum-auth-brand">
    @if ($hasBrandLogo)
        @if ($brandLogo instanceof \Illuminate\Contracts\Support\Htmlable)
            <div class="aurum-auth-brand-logo" style="height: {{ e($brandLogoHeightValue) }}">
                {{ $brandLogo }}
            </div>
        @else
            <img
                src="{{ $brandLogo }}"
                alt="{{ $brandName }}"
                class="aurum-auth-brand-logo"
                style="height: {{ e($brandLogoHeightValue) }}"
            />
        @endif
    @else
        <div class="aurum-auth-brand-mark" aria-hidden="true">{{ $brandInitial }}</div>
    @endif

    @if ($showBrandText)
        <div class="aurum-auth-brand-text">
            <div class="aurum-auth-brand-name">{{ $brandName }}</div>

            @if (filled($brandTagline))
                <div class="aurum-auth-brand-tagline">{{ $brandTagline }}</div>
            @endif
        </div>
    @endif
</div>
