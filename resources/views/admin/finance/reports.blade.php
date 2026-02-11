@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-slate-900">Rapports Financiers</h1>
        <p class="text-slate-500 mt-2">Analyse des dépenses et commandes par département</p>
    </div>

    <!-- Filtres -->
    <form method="GET" action="{{ route('admin.finance.reports') }}" class="flex flex-col md:flex-row gap-4 mb-6">
        <select name="departement_id" class="px-4 py-2 border border-slate-200 rounded-lg bg-white">
            <option value="">Tous les départements</option>
            @if(isset($departements))
                @foreach($departements as $dept)
                    <option value="{{ $dept->id }}" @selected(request('departement_id') == $dept->id)>{{ $dept->nom }}</option>
                @endforeach
            @endif
        </select>

        <input type="date" name="start_date" value="{{ request('start_date') }}" class="px-4 py-2 border border-slate-200 rounded-lg" />
        <input type="date" name="end_date" value="{{ request('end_date') }}" class="px-4 py-2 border border-slate-200 rounded-lg" />

        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Filtrer</button>
        <a href="#" class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg">Commandes en attente</a>
          {{-- {{ route('commandes.pendantes') }} --}}
    </form>

    <!-- Cartes de synthèse -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg shadow border border-slate-100">
            <p class="text-sm text-slate-500">Revenu total</p>
            <p class="text-2xl font-bold">{{ number_format($totalRevenue ?? 0) }} TK</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow border border-slate-100">
            <p class="text-sm text-slate-500">Nombre de commandes</p>
            <p class="text-2xl font-bold">{{ $totalCommandes ?? 0 }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow border border-slate-100">
            <p class="text-sm text-slate-500">Commandes premium</p>
            <p class="text-2xl font-bold">{{ $totalPremium ?? 0 }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow border border-slate-100">
            <p class="text-sm text-slate-500">Notifications en attente</p>
            <p class="text-2xl font-bold">{{ $pendingApprovals ?? 0 }}</p>
        </div>
    </div>

    <!-- Graphiques (placeholders, à remplacer par Chart.js ou autre) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg shadow border border-slate-100">
            <h2 class="text-lg font-bold mb-4">Dépenses par département</h2>
            <div id="chart-departements" class="h-64 bg-slate-50 rounded flex items-center justify-center text-slate-400">Graphique en barres</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow border border-slate-100">
            <h2 class="text-lg font-bold mb-4">Top articles commandés</h2>
            <div id="chart-top" class="h-64 bg-slate-50 rounded flex items-center justify-center text-slate-400">Graphique circulaire</div>
        </div>
    </div>

    <!-- Tableau détaillé -->
    <div class="bg-white rounded-lg shadow border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-lg font-bold">Détail des transactions</h2>
            <div class="flex gap-2">
                <a href="?export=csv" class="px-3 py-2 border rounded text-sm">Exporter CSV</a>
                <a href="?export=xlsx" class="px-3 py-2 border rounded text-sm">Exporter XLSX</a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">Date</th>
                        <th class="px-6 py-3 text-left">Département</th>
                        <th class="px-6 py-3 text-left">Utilisateur</th>
                        <th class="px-6 py-3 text-right">Montant (Tokens)</th>
                        <th class="px-6 py-3 text-center">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @if(isset($transactions) && $transactions->count())
                        @foreach($transactions as $t)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4">{{ optional($t->created_at)->format('Y-m-d') ?? ($t->date ?? '-') }}</td>
                                <td class="px-6 py-4">{{ data_get($t, 'user.employe.departement.nom') ?? data_get($t, 'departement.nom') ?? '-' }}</td>
                                <td class="px-6 py-4">{{ data_get($t, 'user.nom') ?? data_get($t, 'employe.user.nom') ?? '-' }}</td>
                                <td class="px-6 py-4 text-right font-bold">{{ number_format($t->montant_tokens ?? ($t->montant ?? 0)) }} TK</td>
                                <td class="px-6 py-4 text-center">
                                    @switch($t->status ?? $t->etat ?? null)
                                        @case('en_attente')
                                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">En attente</span>
                                            @break
                                        @case('approuve')
                                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs">Approuvée</span>
                                            @break
                                        @case('rejetee')
                                            <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs">Rejetée</span>
                                            @break
                                        @default
                                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">{{ $t->status ?? $t->etat ?? '-' }}</span>
                                    @endswitch
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-600">Aucune transaction trouvée pour les filtres sélectionnés.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        @if(isset($transactions) && method_exists($transactions, 'links'))
            <div class="p-4">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
