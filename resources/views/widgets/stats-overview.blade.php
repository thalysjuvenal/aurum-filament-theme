<div class="aurum-stats-grid">
    @foreach ($stats as $stat)
        <div class="aurum-stat fi-section">
            <div class="aurum-stat-header">
                <span class="aurum-stat-label">{{ $stat->getLabel() }}</span>
                @if ($stat->getIcon())
                    <x-filament::icon :icon="$stat->getIcon()" class="aurum-stat-icon" />
                @endif
            </div>
            <div @class(['aurum-stat-value', 'aurum-mono' => $stat->isMonoValue()])>{{ $stat->getValue() }}</div>
            <div class="aurum-stat-footer">
                @if ($stat->getDelta())
                    <span class="aurum-stat-trend is-{{ $stat->getTrend() }}">{{ $stat->getDelta() }}</span>
                @endif
                @if ($stat->getDescription())
                    <span class="aurum-stat-description">{{ $stat->getDescription() }}</span>
                @endif
            </div>
        </div>
    @endforeach
</div>
