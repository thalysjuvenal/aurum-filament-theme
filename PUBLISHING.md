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

- [ ] Check the current submission process at the time of publishing (the Filament docs' "Publishing" section under [filamentphp.com/docs](https://filamentphp.com/docs) — the process has changed between Filament versions, so re-verify rather than assuming this list is current).
- [ ] Prepare the assets the gallery typically requires:
  - [ ] Plugin icon/logo (square, per the gallery's current size spec).
  - [ ] Screenshots (the `art/` directory already has dashboard, login, and orders screenshots for Gold plus dark-mode dashboards for Emerald/Sapphire/Ruby — resize/crop per the gallery's requirements).
  - [ ] Short description and long description copy (can be adapted from this README's tagline and Features section).
  - [ ] Packagist package name (`thalysjuvenal/aurum-filament-theme`) and GitHub URL.
- [ ] Submit via the gallery's current form/PR process.

## 5. Uncomment the Packagist badges

- [x] Done 2026-07-07 — badges live in `README.md` and `README.pt-BR.md`.

## 6. Announce the release

- [ ] Filament Discord, `#plugins` channel.
- [ ] X/Twitter.
- [ ] Laravel News (submission form / tip line, if applicable).
