<div class="aurum-totals">
    @foreach ($rows as $row)
        <div class="aurum-totals-row">
            <span>{{ $row->getLabel() }}</span>
            <span class="aurum-mono">{{ $row->getValue() }}</span>
        </div>
    @endforeach
    @if ($total)
        <div class="aurum-totals-total">
            <span>{{ $total->getLabel() }}</span>
            <span class="aurum-mono">{{ $total->getValue() }}</span>
        </div>
    @endif
</div>
