@props(['balance' => 0, 'limit' => 5000, 'class' => ''])

@php
$percentage = ($balance / $limit) * 100;
$statusColor = $balance < 500 ? 'text-red-600' : ($balance < 2000 ? 'text-amber-600' : 'text-green-600');
$barColor = $balance < 500 ? 'bg-red-500' : ($balance < 2000 ? 'bg-amber-500' : 'bg-green-500');
@endphp

<div class="p-4 bg-white rounded-lg border border-slate-200 {{ $class }}">
    <div class="flex items-center justify-between mb-2">
        <p class="text-sm font-semibold text-slate-600">Solde de Tokens</p>
        <p class="text-lg font-bold {{ $statusColor }}">{{ $balance }} TK</p>
    </div>
    
    <div class="w-full h-2 bg-slate-200 rounded-full overflow-hidden">
        <div class="{{ $barColor }} h-full rounded-full transition-all" style="width: {{ min($percentage, 100) }}%"></div>
    </div>
    
    <p class="text-xs text-slate-500 mt-2">Limite: {{ $limit }} TK</p>
</div>
