@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-slate-900">Validations en attente</h1>
        <p class="text-slate-500 mt-2">Articles Premium à approuver</p>
    </div>

    <!-- Filtres -->
    <div class="flex gap-2 mb-6">
        <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">En attente</button>
        <button class="px-4 py-2 border border-slate-200 text-slate-700 rounded-lg hover:bg-slate-50">Approuvés</button>
        <button class="px-4 py-2 border border-slate-200 text-slate-700 rounded-lg hover:bg-slate-50">Rejetés</button>
    </div>

    <!-- Liste des demandes -->
    <div class="space-y-4">
        @for($i = 1; $i <= 3; $i++)
        <div class="bg-white p-6 rounded-lg shadow border border-slate-100 hover:shadow-md transition">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-slate-100 rounded-lg flex items-center justify-center text-2xl">
                        📦
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900">Cahier Premium A4 Luxe</h3>
                        <p class="text-sm text-slate-500">Demandé par <strong>Marie Martin</strong> - Marketing</p>
                        <p class="text-sm text-slate-400 mt-1">Il y a 2 heures</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-2xl font-bold text-indigo-600">500 TK</p>
                    <p class="text-xs text-slate-400">Prix unitaire</p>
                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t border-slate-100">
                <button class="flex-1 px-4 py-2 bg-green-100 text-green-700 rounded-lg font-semibold hover:bg-green-200">
                    ✓ Approuver
                </button>
                <button class="flex-1 px-4 py-2 bg-red-100 text-red-700 rounded-lg font-semibold hover:bg-red-200">
                    ✕ Rejeter
                </button>
                <button class="px-4 py-2 border border-slate-200 text-slate-700 rounded-lg hover:bg-slate-50">
                    Détails
                </button>
            </div>
        </div>
        @endfor
    </div>
</div>
@endsection
