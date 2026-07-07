# Publishing checklist

> **Nothing in this file runs automatically.** Every step below requires the
> repository owner (`thalysjuvenal`) to manually run a command or take an
> action outside this repo. This is a deferred checklist, not a script.

## 1. Make the repository public

- [x] Confirm the repo is ready to be public (no secrets in history, LICENSE present, README accurate).
- [x] Done 2026-07-07 — repo is PUBLIC.

## 2. Submit to Packagist

- [x] Done 2026-07-07 — submitted by the owner via <https://packagist.org/packages/submit>; package live at <https://packagist.org/packages/thalysjuvenal/aurum-filament-theme>.
- [x] Auto-update active (GitHub-linked Packagist account — no manual webhook was needed; the package page shows no "not auto-updated" warning).
- [x] Package page indexes `v1.1.0` and `dev-main`.

## 3. Add repository topics

- [x] Done pre-publication — repo metadata (description + topics) is safe to set on a private repo, so this happened ahead of time rather than at publish time. Topics set: `filamentphp`, `filament`, `filament-plugin`, `filament-theme`, `laravel`, `php`, `admin-panel`, `dark-mode`, `ui-kit`, `tailwindcss`.
- [x] Verified 2026-07-07 — community profile health at **100%** (`gh api repos/.../community/profile`).

## 4. Submit to the filamentphp.com/plugins gallery

> Process verified 2026-07-07: the old PR-based repository (`filamentphp/filamentphp.com`)
> is **archived**. Submissions now happen through an admin UI on the site.

- [ ] Request author-profile access at <https://filamentphp.com/author> (GitHub login; approval is manual and may take a while).
- [x] Assets prepared: `art/icon.png` (512², transparent), `art/banner.png` (2560×1280), screenshot set in `art/`.
- [x] Copy prepared: short + long descriptions, category suggestions (local kit, not committed).
- [ ] Once approved, submit the plugin via the author dashboard using the prepared kit.

## 5. Uncomment the Packagist badges

- [x] Done 2026-07-07 — badges live in `README.md` and `README.pt-BR.md`.

## 6. Announce the release

- [ ] Filament Discord, `#plugins` channel.
- [ ] X/Twitter.
- [ ] Laravel News (submission form / tip line, if applicable).
