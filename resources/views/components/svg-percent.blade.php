@php
// it is there sos that tailwind could generate he classes
$class = "stroke-green-800 stroke-red-800 stroke-blue-800 stroke-yellow-800";
$bgClass = "bg-green-500/50 bg-red-500/50 bg-blue-500/50 bg-yellow-500/50";
@endphp
<svg viewBox="0 0 36 36" {{ $attributes }}>
    <path
        d="M18 2.0845
      a 15.9155 15.9155 0 0 1 0 31.831
      a 15.9155 15.9155 0 0 1 0 -31.831"
        fill="none"
        stroke-dasharray="{{ $attributes->get('percent') }}, 100"
    />
</svg>
