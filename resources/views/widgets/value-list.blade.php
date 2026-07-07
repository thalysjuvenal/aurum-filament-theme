<div class="aurum-value-list fi-section">
    @if ($heading)
        <h3 class="aurum-vl-heading">{{ $heading }}</h3>
    @endif
    <ul>
        @foreach ($items as $item)
            <li class="aurum-vl-item">
                <span class="aurum-vl-dot is-{{ $item->getStatus() }}"></span>
                @if ($item->getUrl())
                    <a href="{{ $item->getUrl() }}" class="aurum-vl-label">{{ $item->getLabel() }}</a>
                @else
                    <span class="aurum-vl-label">{{ $item->getLabel() }}</span>
                @endif
                <span class="aurum-vl-value aurum-mono">{{ $item->getValue() }}</span>
            </li>
        @endforeach
    </ul>
</div>
