@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-slate-900">
            @if(auth()->user()->role_id === 2)
                Mes Commandes
            @else
                Commandes du Département
            @endif
        </h1>
        <p class="text-slate-600 mt-2">
            @if(auth()->user()->role_id === 2)
                Consultez et gérez vos commandes
            @else
                Approuvez et gérez les commandes des employés
            @endif
        </p>
    </div>

    <!-- Filters -->
    <div class="mb-6 flex flex-wrap gap-3">
        <a href="{{ route('commandes.index') }}" 
            class="px-4 py-2 rounded-lg font-medium transition @if(!request('filter')) bg-indigo-600 text-white hover:bg-indigo-700 @else bg-gray-200 text-gray-800 hover:bg-gray-300 @endif">
            Tous
        </a>
        <a href="{{ route('commandes.index', ['filter' => 'en_attente']) }}" 
            class="px-4 py-2 rounded-lg font-medium transition @if(request('filter') === 'en_attente') bg-amber-500 text-white hover:bg-amber-600 @else bg-gray-200 text-gray-800 hover:bg-gray-300 @endif">
            En attente
        </a>
        <a href="{{ route('commandes.index', ['filter' => 'approuve']) }}" 
            class="px-4 py-2 rounded-lg font-medium transition @if(request('filter') === 'approuve') bg-green-600 text-white hover:bg-green-700 @else bg-gray-200 text-gray-800 hover:bg-gray-300 @endif">
            Approuvés
        </a>
        <a href="{{ route('commandes.index', ['filter' => 'rejetee']) }}" 
            class="px-4 py-2 rounded-lg font-medium transition @if(request('filter') === 'rejetee') bg-red-600 text-white hover:bg-red-700 @else bg-gray-200 text-gray-800 hover:bg-gray-300 @endif">
            Rejetés
        </a>
        <a href="{{ route('commandes.index', ['filter' => 'recue']) }}" 
            class="px-4 py-2 rounded-lg font-medium transition @if(request('filter') === 'recue') bg-blue-600 text-white hover:bg-blue-700 @else bg-gray-200 text-gray-800 hover:bg-gray-300 @endif">
            Reçus
        </a>
    </div>

    <!-- Commands List -->
    @if($commandes->count() > 0)
        <div class="grid grid-cols-1 gap-6">
            @foreach($commandes as $commande)
                <div class="bg-white rounded-lg shadow border border-slate-100 hover:shadow-lg transition overflow-hidden">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <!-- Commande Info -->
                            <div class="flex-1">
                                <div class="flex items-start gap-4">
                                    <div>
                                        <h3 class="text-lg font-bold text-slate-900">
                                            Commande #{{ $commande->id }}
                                        </h3>
                                        <p class="text-sm text-slate-600 mt-1">
                                            @if(auth()->user()->role_id === 3)
                                                <span class="font-medium">{{ $commande->user->nom ?? 'N/A' }}</span>
                                            @endif
                                            {{ $commande->created_at->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Articles Preview -->
                                <div class="mt-4 grid grid-cols-1 gap-2">
                                    @foreach($commande->ligneCommande->take(3) as $ligne)
                                        <div class="flex justify-between items-center text-sm">
                                            <span class="text-slate-700">
                                                {{ $ligne->produit->nom ?? 'Produit' }} 
                                                <span class="text-slate-600">x{{ $ligne->qte }}</span>
                                            </span>
                                            <span class="text-indigo-600 font-semibold">{{ $ligne->qte * ($ligne->prix_unitaire ?? 0) }} TK</span>
                                        </div>
                                    @endforeach
                                    @if($commande->ligneCommande->count() > 3)
                                        <p class="text-sm text-slate-600">... et {{ $commande->ligneCommande->count() - 3 }} autre(s) article(s)</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Status & Total -->
                            <div class="flex flex-col items-end gap-4">
                                <!-- Status Badge -->
                                <div>
                                    @if ($commande->status === 'en_attente')
                                        <span class="px-4 py-2 bg-amber-100 text-amber-700 rounded-full text-sm font-medium">En attente</span>
                                    @elseif ($commande->status === 'approuve')
                                        <span class="px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-medium">Approuvé</span>
                                    @elseif ($commande->status === 'rejetee')
                                        <span class="px-4 py-2 bg-red-100 text-red-700 rounded-full text-sm font-medium">Rejeté</span>
                                    @elseif ($commande->status === 'recue')
                                        <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">Reçu</span>
                                    @endif
                                </div>

                                <!-- Total Amount -->
                                <div class="text-right">
                                    <p class="text-sm text-slate-600">Montant total</p>
                                    <p class="text-2xl font-bold text-indigo-600">{{ $commande->montant_tokens ?? 0 }} TK</p>
                                </div>

                                <!-- Premium Badge -->
                                @if($commande->estPremium())
                                    <div>
                                        <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-bold">⭐ PREMIUM</span>
                                    </div>
                                @endif

                                <!-- Action Button -->
                                <a href="{{ route('commandes.show', $commande->id) }}" 
                                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium inline-block">
                                    Voir détails →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-lg shadow border border-slate-100 p-12 text-center">
            <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="mt-4 text-lg font-medium text-slate-900">Aucune commande</h3>
            <p class="mt-2 text-sm text-slate-600">
                @if(!request('filter'))
                    Il n'y a aucune commande pour le moment.
                @else
                    Aucune commande trouvée avec ce filtre.
                @endif
            </p>
            @if(auth()->user()->role_id === 2)
                <a href="{{ route('shop.index') }}" class="mt-4 inline-block px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">
                    Créer une nouvelle commande
                </a>
            @endif
        </div>
    @endif
</div>

<!-- Statistics Section -->
@if($commandes->count() > 0)
    <div class="mt-12 grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Total Commandes -->
        <div class="bg-white rounded-lg shadow border border-slate-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-600">Total des commandes</p>
                    <p class="text-2xl font-bold text-slate-900">{{ $commandes->count() }}</p>
                </div>
                <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
        </div>

        <!-- Total Montant -->
        <div class="bg-white rounded-lg shadow border border-slate-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-600">Montant total</p>
                    <p class="text-2xl font-bold text-indigo-600">{{ $commandes->sum('montant_tokens') }} TK</p>
                </div>
                <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <!-- Approuvés -->
        <div class="bg-white rounded-lg shadow border border-slate-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-600">Approuvés</p>
                    <p class="text-2xl font-bold text-green-600">{{ $commandes->where('status', 'approuve')->count() }}</p>
                </div>
                <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>

        <!-- En attente -->
        <div class="bg-white rounded-lg shadow border border-slate-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-600">En attente</p>
                    <p class="text-2xl font-bold text-amber-600">{{ $commandes->where('status', 'en_attente')->count() }}</p>
                </div>
                <svg class="h-8 w-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>
@endif

@endsection
