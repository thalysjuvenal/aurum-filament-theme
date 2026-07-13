# Aurum — Filament v5 Theme

[🇬🇧 English](https://github.com/thalysjuvenal/aurum-filament-theme/blob/main/README.md) | 🇧🇷 **Português**

**Um motor de temas e kit de UI executivo dourado-sobre-grafite para painéis FilamentPHP v5.**

[![CI](https://github.com/thalysjuvenal/aurum-filament-theme/actions/workflows/ci.yml/badge.svg)](https://github.com/thalysjuvenal/aurum-filament-theme/actions/workflows/ci.yml)
[![License: MIT](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/thalysjuvenal/aurum-filament-theme/blob/main/LICENSE)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/thalysjuvenal/aurum-filament-theme.svg?style=flat-square)](https://packagist.org/packages/thalysjuvenal/aurum-filament-theme)
[![Total Downloads](https://img.shields.io/packagist/dt/thalysjuvenal/aurum-filament-theme.svg?style=flat-square)](https://packagist.org/packages/thalysjuvenal/aurum-filament-theme)
[![Pontuação Plumb](https://plumbphp.dev/badges/thalysjuvenal/aurum-filament-theme/composite.svg)](https://plumbphp.dev/thalysjuvenal/aurum-filament-theme)

## Screenshots

**Gold (padrão) — dashboard**

| Dashboard — escuro | Dashboard — claro |
|---|---|
| ![Dashboard Gold, modo escuro](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/gold-dashboard-dark.png) | ![Dashboard Gold, modo claro](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/gold-dashboard-light.png) |

| Login | Pedidos |
|---|---|
| ![Página de login com o bloco de marca Aurum](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/gold-login.png) | ![Tabela de pedidos](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/gold-orders.png) |

**Presets — dashboard, escuro e claro**

| Preset | Dashboard — escuro | Dashboard — claro |
|---|---|---|
| Emerald | ![Dashboard Emerald, modo escuro](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/emerald-dashboard-dark.png) | ![Dashboard Emerald, modo claro](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/emerald-dashboard-light.png) |
| Sapphire | ![Dashboard Sapphire, modo escuro](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/sapphire-dashboard-dark.png) | ![Dashboard Sapphire, modo claro](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/sapphire-dashboard-light.png) |
| Ruby | ![Dashboard Ruby, modo escuro](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/ruby-dashboard-dark.png) | ![Dashboard Ruby, modo claro](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/ruby-dashboard-light.png) |

As capturas de login de cada preset estão na seção [Presets](#presets) abaixo.

## Funcionalidades

- **4 presets curados** — Gold (padrão), Emerald, Sapphire, Ruby — cada um com uma escala OKLCH 50–950 e tokens de acento para modo claro/escuro.
- **Assinatura de sidebar sempre escura** — a barra lateral permanece escura mesmo com o painel em modo claro.
- **Tipografia executiva** — Instrument Sans para o texto da UI, IBM Plex Mono com algarismos tabulares (`.aurum-mono`) para colunas numéricas.
- **Bloco de marca no login** — um bloco configurável de logo + wordmark + tagline renderizado acima do card de autenticação nas páginas de login, registro e redefinição de senha.
- **4 componentes prontos** — `AurumStatsOverview`/`AurumStat`, `AurumValueList`, `Timeline`, `TotalsBlock`.
- **Instalação sem build** — o CSS do tema é registrado pelo plugin; nenhum passo de Tailwind/Vite é necessário na aplicação consumidora.
- **Modo claro e escuro completos**, validados de ponta a ponta contra uma aplicação Filament v5.6.8 real.

## Requisitos

- PHP `^8.2`
- `filament/filament` `^5.0`

> Contribuir com este pacote (rodar a suíte de testes) requer PHP `>= 8.3` — veja [CONTRIBUTING.md](https://github.com/thalysjuvenal/aurum-filament-theme/blob/main/CONTRIBUTING.md).

## Instalação

```bash
composer require thalysjuvenal/aurum-filament-theme
php artisan filament:assets
```

No seu `PanelProvider`:

```php
use ThalysJuvenal\Aurum\AurumTheme;

public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->plugin(AurumTheme::make());
}
```

Cores, fontes e o CSS do tema são registrados pelo plugin, escopados ao painel ao qual ele está anexado — painéis sem `->plugin(AurumTheme::make())` permanecem intocados. Nenhum passo de build é necessário na aplicação consumidora.

## Presets

O Aurum vem com quatro presets de cor. Gold é o padrão; troque com `->preset()`:

```php
use ThalysJuvenal\Aurum\AurumTheme;
use ThalysJuvenal\Aurum\Presets\Sapphire;

->plugin(
    AurumTheme::make()->preset(Sapphire::class)
)
```

| Preset | Login | Classe |
|---|---|---|
| Gold (padrão) | ![Login Gold](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/gold-login.png) | `ThalysJuvenal\Aurum\Presets\Gold` |
| Emerald | ![Login Emerald](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/emerald-login.png) | `ThalysJuvenal\Aurum\Presets\Emerald` |
| Sapphire | ![Login Sapphire](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/sapphire-login.png) | `ThalysJuvenal\Aurum\Presets\Sapphire` |
| Ruby | ![Login Ruby](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/ruby-login.png) | `ThalysJuvenal\Aurum\Presets\Ruby` |

**Botões, por preset (modo claro)**

| Gold | Emerald | Sapphire | Ruby |
|---|---|---|---|
| ![Botões Gold — sólidos, outlined, tamanhos e estados](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/buttons-gold.png) | ![Botões Emerald — sólidos, outlined, tamanhos e estados](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/buttons-emerald.png) | ![Botões Sapphire — sólidos, outlined, tamanhos e estados](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/buttons-sapphire.png) | ![Botões Ruby — sólidos, outlined, tamanhos e estados](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/buttons-ruby.png) |

Os quatro presets passam nos gates de contraste WCAG do pacote (`tests/PresetContrastTest.php`): AA para o texto de botão no modo escuro, AA de texto grande para o texto de botão no modo claro, e uma razão mínima de 3:1 entre acento e fundo.

### Presets customizados

Estenda `AurumPreset` e implemente seus três métodos abstratos — `name()`, `palette()` (uma escala OKLCH 50–950 para `$panel->colors()`) e `accentHex()` (stops hex de referência usados para derivar as variáveis CSS `--aurum-*`):

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

Depois use como qualquer outro preset: `->preset(Amethyst::class)`.

## Componentes

Leia o código-fonte em `src/Widgets` e `src/Schemas` para a API completa; os exemplos abaixo são copiar-e-colar prontos para uso.

### Formulários

Todos os tipos de campo nativos do Filament são temáticos de ponta a ponta — campos de texto com afixos, sliders, selects, radios, checkboxes e toggles herdam automaticamente o acento do preset ativo:

![Campos de formulário — textos, selects, radio, lista de checkboxes e toggle, preset Gold](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/form-fields-gold.png)

### `AurumStatsOverview` + `AurumStat`

```php
use ThalysJuvenal\Aurum\Widgets\AurumStat;
use ThalysJuvenal\Aurum\Widgets\AurumStatsOverview;

class RevenueOverview extends AurumStatsOverview
{
    protected function getStats(): array
    {
        return [
            AurumStat::make('Faturamento', 'R$ 128.450,00')
                ->description('vs. mês anterior')
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
    protected ?string $heading = 'Principais clientes';

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
        TimelineItem::make('Pedido realizado')
            ->timestamp('2026-07-01 09:12')
            ->description('Aguardando confirmação de pagamento'),
        TimelineItem::make('Pagamento confirmado')
            ->timestamp('2026-07-01 10:03')
            ->active(),
    ])
```

| Gold | Emerald | Sapphire | Ruby |
|---|---|---|---|
| ![Timeline, preset Gold — etapa ativa com ponto e anel dourados](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/timeline-gold.png) | ![Timeline, preset Emerald — etapa ativa com ponto e anel esmeralda](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/timeline-emerald.png) | ![Timeline, preset Sapphire — etapa ativa com ponto e anel safira](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/timeline-sapphire.png) | ![Timeline, preset Ruby — etapa ativa com ponto e anel rubi](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/timeline-ruby.png) |

### `TotalsBlock` + `TotalsRow`

```php
use ThalysJuvenal\Aurum\Schemas\TotalsBlock;
use ThalysJuvenal\Aurum\Schemas\TotalsRow;

TotalsBlock::make()
    ->rows([
        TotalsRow::make('Subtotal', 'R$ 1.250,00'),
        TotalsRow::make('Impostos', 'R$ 125,00'),
    ])
    ->total(TotalsRow::make('Total', 'R$ 1.375,00'))
```

| Escuro | Claro |
|---|---|
| ![TotalsBlock, modo escuro — linhas de Subtotal, Frete e Total com algarismos tabulares](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/totals-block-dark.png) | ![TotalsBlock, modo claro — linhas de Subtotal, Frete e Total com algarismos tabulares](https://raw.githubusercontent.com/thalysjuvenal/aurum-filament-theme/main/art/totals-block-light.png) |

### Gráficos com tema dinâmico

`AurumPreset` expõe `accentRgb()` e `accentRgba(float $alpha)` para que um `ChartWidget` leia o accent do preset *ativo* em vez de fixar uma cor no código — as barras seguem o preset (Gold/Emerald/Sapphire/Ruby) configurado no painel:

```php
use Filament\Facades\Filament;

$preset = Filament::getCurrentPanel()->getPlugin('aurum-theme')->getPreset();

'backgroundColor' => $preset->accentRgba(0.38), // meses anteriores
'borderColor' => $preset->accentRgba(1.0),      // mês atual / traço
```

## Bloco de marca no login

Configure um nome de marca e uma legenda renderizados acima do card de autenticação nas páginas de login, registro e redefinição de senha:

```php
->plugin(
    AurumTheme::make()
        ->brandName('AURUM')
        ->brandTagline('ERP EXECUTIVO')
)
```

Se `brandName()` não for definido, o bloco usa o nome de marca do próprio painel em tempo de render. Se `brandTagline()` não for definido, o elemento da legenda é omitido por completo (sem espaço reservado).

### Usando a própria logo

Por padrão o bloco renderiza um quadrado gradiente com a inicial da marca. Se o painel definir uma logo, o bloco a renderiza no lugar:

```php
->brandLogo(asset('images/logo.png'))
->darkModeBrandLogo(asset('images/logo-dark.png')) // opcional, ver nota abaixo
->brandLogoHeight('2.75rem') // opcional, padrão de 44px
```

O wordmark e a tagline continuam sendo renderizados abaixo da logo, a menos que você opte por ocultá-los:

```php
->plugin(
    AurumTheme::make()
        ->brandName('AURUM')
        ->hideBrandText() // oculta o wordmark/tagline quando há uma logo
)
```

`hideBrandText()` só tem efeito quando o painel tem uma logo — sem ela, o bloco ficaria só com o quadrado vazio, sem nenhum texto, então o texto sempre é renderizado nesse caso.

**A área de marca é sempre escura**, tanto no modo claro quanto no escuro do painel (é a assinatura visual do Aurum, ver [Compatibilidade](#compatibilidade) e as capturas de login acima). Por isso, o bloco prioriza `->darkModeBrandLogo()` sobre `->brandLogo()` quando ambos estão definidos — forneça uma variante de logo legível sobre fundo escuro (marca/wordmark claros, ou com contraste suficiente). Se você só tiver um único arquivo de logo, garanta que ele seja legível em fundo escuro antes de confiar apenas em `->brandLogo()`.

**Corte (trim) o arquivo da sua logo antes.** Um PNG sem corte, com bastante espaço transparente ao redor da marca (comum em ícones de app exportados), é renderizado minúsculo dentro do bloco de altura fixa — a `height` definida se aplica à tela inteira, não só à marca visível, então o preenchimento vazio "encolhe" a logo visível. Corte o arquivo para o conteúdo visível (ex.: `magick logo.png -trim +repage logo.png` ou `sips` no macOS) antes de publicá-lo.

## Colunas numéricas

Aplique a classe utilitária `.aurum-mono` em colunas de moeda, data e código para IBM Plex Mono + algarismos tabulares:

```php
TextColumn::make('total')->money('BRL')->extraAttributes(['class' => 'aurum-mono']);
```

## Tema Vite opcional

Para aplicações que compilam o próprio CSS Tailwind junto do Aurum:

```bash
php artisan vendor:publish --tag=aurum-theme-vite
```

Depois registre no painel e adicione o arquivo publicado ao `input` do seu `vite.config.js`:

```php
->viteTheme('resources/css/filament/admin/aurum-theme.css')
```

O CSS do tema Aurum registrado pelo plugin continua funcionando normalmente; o stub Vite só é necessário se você também compilar o próprio CSS do painel.

## Compatibilidade

Os seletores CSS do tema (`.fi-*`) foram validados contra o DOM real do **Filament v5.6.8**, incluindo QA visual sistemático (modos claro e escuro) nas 10 áreas da documentação oficial: forms, schemas, tables, resources, infolists, actions, notifications, widgets, navigation e users (modais, slide-overs, dropdowns, wizard/tabs, repeater, paginação, seleção em lote, notificações de banco, etc.). Os classnames `.fi-*` **não** são cobertos por semver — versões minor do Filament podem renomeá-los e exigir pequenos ajustes no `aurum.css`.

## Limitações conhecidas

- **Largura da sidebar recolhida:** o Filament v5 usa uma largura fixa de 88px no estado recolhido (não dirigida por CSS variable); a spec original do Aurum previa 64px. Forçar 64px via CSS descentraliza os ícones (o padding é compartilhado com o estado expandido), então o tema mantém os 88px padrão do Filament — ícones, fundo escuro e o item ativo dourado seguem fiéis à spec.
- **Dependência de Google Fonts em tempo de execução:** o tema carrega a Instrument Sans via provedor de fontes do Google do Filament, e a IBM Plex Mono via `@import` de CSS a partir de `fonts.googleapis.com`, ambas em tempo de execução. Implantações air-gapped ou de intranet sem acesso à internet farão fallback silencioso para fontes do sistema, e organizações sujeitas à LGPD/GDPR podem preferir não ter o navegador requisitando fontes ao Google. Hospedar as próprias fontes (self-hosted) ou empacotá-las está no roadmap.

## Roadmap

Planejado para a v2:

- Troca de preset por usuário (persistida a nível de usuário, não apenas por painel).
- Suporte a RTL.
- Modos de densidade (compacto/confortável).
- Presets adicionais.
- Fontes empacotadas/self-hosted (remover a dependência em tempo de execução do Google Fonts).

## Contribuindo

Veja [CONTRIBUTING.md](https://github.com/thalysjuvenal/aurum-filament-theme/blob/main/CONTRIBUTING.md) para requisitos de versão do PHP, scripts de desenvolvimento e o checklist de pull request.

## Licença

A licença MIT (MIT). Veja [LICENSE](https://github.com/thalysjuvenal/aurum-filament-theme/blob/main/LICENSE) para mais informações.
