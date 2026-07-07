<ol class="aurum-timeline">
    @foreach ($items as $item)
        <li class="aurum-tl-item">
            <span class="aurum-tl-dot {{ $item->isActive() ? 'is-active' : '' }}"></span>
            <div class="aurum-tl-body">
                <span class="aurum-tl-title">{{ $item->getTitle() }}</span>
                @if ($item->getDescription())
                    <span class="aurum-tl-description">{{ $item->getDescription() }}</span>
                @endif
                @if ($item->getTimestamp())
                    <span class="aurum-tl-time aurum-mono">{{ $item->getTimestamp() }}</span>
                @endif
            </div>
        </li>
    @endforeach
</ol>
