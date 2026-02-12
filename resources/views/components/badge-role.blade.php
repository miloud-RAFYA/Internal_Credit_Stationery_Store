@props(['role' => 'user', 'class' => ''])

@php
$styles = [
    'admin' => 'bg-red-100 text-red-700',
    'manager' => 'bg-blue-100 text-blue-700',
    'employee' => 'bg-slate-100 text-slate-700',
    'user' => 'bg-slate-100 text-slate-700',
];

$labels = [
    'admin' => 'Admin',
    'manager' => 'Manager',
    'employee' => 'Collaborateur',
    'user' => 'Utilisateur',
];

$style = $styles[$role] ?? $styles['user'];
$label = $labels[$role] ?? $labels['user'];
@endphp

<span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $style }} {{ $class }}">
    {{ $label }}
</span>
