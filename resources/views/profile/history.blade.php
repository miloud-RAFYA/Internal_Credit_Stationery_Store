@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <h1 class="text-4xl font-bold text-slate-900 mb-2">Mes commandes</h1>
    <p class="text-slate-500 mb-8">Historique de toutes vos achats</p>

    <!-- Filtres -->
    <div class="flex gap-2 mb-6">
        <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Toutes</button>
        <button class="px-4 py-2 border border-slate-200 text-slate-700 rounded-lg hover:bg-slate-50">En cours</button>
        <button class="px-4 py-2 border border-slate-200 text-slate-700 rounded-lg hover:bg-slate-50">Livrées</button>
        <button class="px-4 py-2 border border-slate-200 text-slate-700 rounded-lg hover:bg-slate-50">Annulées</button>
    </div>

    <!-- Liste des commandes -->
    <div class="space-y-4">
        @for($i = 1; $i <= 5; $i++)
        <div class="bg-white rounded-lg shadow border border-slate-100 p-6 hover:shadow-md transition">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-sm text-slate-500">Commande #{{ 1000 + $i }}</p>
                    <h3 class="text-lg font-bold text-slate-900">{{ 2 + $i }} articles</h3>
                    <p class="text-sm text-slate-500 mt-1">{{ now()->subDays($i)->format('d M Y') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold text-indigo-600">{{ 300 + ($i * 100) }} TK</p>
                    <span class="inline-block mt-2 px-3 py-1 bg-{{ $i % 2 ? 'green' : 'amber' }}-100 text-{{ $i % 2 ? 'green' : 'amber' }}-700 rounded-full text-xs font-semibold">
                        {{ $i % 2 ? 'Livrée' : 'En attente' }}
                    </span>
                </div>
            </div>

            <div class="border-t border-slate-100 pt-4 flex gap-3">
                <button class="px-4 py-2 border border-slate-200 text-slate-700 rounded-lg text-sm hover:bg-slate-50">
                    Voir détails
                </button>
                <button class="px-4 py-2 border border-slate-200 text-slate-700 rounded-lg text-sm hover:bg-slate-50">
                    Télécharger reçu
                </button>
            </div>
        </div>
        @endfor
    </div>
</div>
@endsection
