@php
    $total = max(0, (int) ($book->jumlah ?? 0));
    $borrowed = max(0, (int) ($book->dipinjam ?? 0));
    $available = max(0, $total - $borrowed);
    $pct = $total > 0 ? min(100, (int) round(($available / $total) * 100)) : 0;
    $stateClass = $available === 0 ? 'is-empty' : ($available <= 2 ? 'is-low' : '');
    $stateText = $available === 0 ? 'Habis dipinjam' : ($available <= 2 ? 'Stok menipis' : 'Tersedia');
@endphp
<div class="stock-meter">
    <div class="stock-meter-head">
        <span class="stock-meter-frac">{{ $available }} / {{ $total }}</span>
        <span class="stock-meter-state">{{ $stateText }}</span>
    </div>
    <div class="stock-meter-track" role="progressbar" aria-valuenow="{{ $available }}" aria-valuemin="0" aria-valuemax="{{ $total }}">
        <div class="stock-meter-fill {{ $stateClass }}" style="width: {{ $pct }}%;"></div>
    </div>
</div>
