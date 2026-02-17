@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-slate-900">Rapports Financiers</h1>
        <p class="text-slate-500 mt-2">Analyse des dépenses par département</p>
    </div>

    <!-- Filtres -->
    <div class="flex gap-4 mb-6">
        <select class="px-4 py-2 border border-slate-200 rounded-lg bg-white">
            <option>Tous les départements</option>
        </select>
        <input type="date" class="px-4 py-2 border border-slate-200 rounded-lg">
    </div>

    <!-- Graphiques -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg shadow border border-slate-100">
            <h2 class="text-lg font-bold mb-4">Dépenses par département</h2>
            <!-- Placeholder pour graphique -->
            <div class="h-64 bg-slate-50 rounded flex items-center justify-center text-slate-400">
                Graphique en barres
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow border border-slate-100">
            <h2 class="text-lg font-bold mb-4">Top Articles commandés</h2>
            <!-- Placeholder pour graphique -->
            <div class="h-64 bg-slate-50 rounded flex items-center justify-center text-slate-400">
                Graphique circulaire
            </div>
        </div>
    </div>

    <!-- Tableau détaillé -->
    <div class="bg-white rounded-lg shadow border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100">
            <h2 class="text-lg font-bold">Détail des transactions</h2>
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
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4">2026-02-05</td>
                        <td class="px-6 py-4">Ressources Humaines</td>
                        <td class="px-6 py-4">Jean Dupont</td>
                        <td class="px-6 py-4 text-right font-bold">250 TK</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs">Validée</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
