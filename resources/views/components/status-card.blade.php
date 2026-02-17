@props(['title' => '', 'value' => 0, 'icon' => '📊', 'color' => 'indigo', 'trend' => null, 'class' => ''])

@php
$colorClasses = [
    'indigo' => 'bg-indigo-50 text-indigo-600 border-indigo-100',
    'green' => 'bg-green-50 text-green-600 border-green-100',
    'red' => 'bg-red-50 text-red-600 border-red-100',
    'amber' => 'bg-amber-50 text-amber-600 border-amber-100',
    'purple' => 'bg-purple-50 text-purple-600 border-purple-100',
];

$colorClass = $colorClasses[$color] ?? $colorClasses['indigo'];
@endphp

<div class="bg-white rounded-lg shadow border border-slate-100 p-6 {{ $class }}">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide">{{ $title }}</p>
            <p class="text-3xl font-bold text-slate-900 mt-2">{{ $value }}</p>
            
            @if($trend)
            <p class="text-xs {{ $trend > 0 ? 'text-green-600' : 'text-red-600' }} mt-2">
                {{ $trend > 0 ? '↑' : '↓' }} {{ abs($trend) }}% par rapport au mois dernier
            </p>
            @endif
        </div>
        
        <div class="text-5xl opacity-20">
            {{ $icon }}
        </div>
    </div>

    <div class="mt-4 pt-4 border-t border-slate-100">
        <a href="#" class="text-sm font-semibold {{ $colorClass }} px-3 py-1 rounded-lg">
            Voir détails →
        </a>
    </div>
</div>
