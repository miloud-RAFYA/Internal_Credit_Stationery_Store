@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('manager.approvals') }}" class="text-indigo-600 hover:text-indigo-700 mb-4 inline-block">← Retour</a>
            <h1 class="text-4xl font-bold text-slate-900">Détails de la commande #{{ $commande->id }}</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Informations principales -->
            <div class="md:col-span-2 space-y-6">
                <!-- Commande info -->
                <div class="bg-white p-6 rounded-lg shadow border border-slate-100">
                    <h2 class="text-xl font-bold text-slate-900 mb-4">Informations générale</h2>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-slate-600">Numéro de commande</p>
                            <p class="font-semibold text-slate-900">#{{ $commande->id }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-600">Demandé par</p>
                            <p class="font-semibold text-slate-900">{{ $commande->user->nom ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-600">Département</p>
                            <p class="font-semibold text-slate-900">{{ $commande->user->employe->departement->nom ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-600">Statut</p>
                            <div class="mt-1">
                                @if ($commande->status === 'en_attente')
                                    <span class="px-3 py-1 bg-amber-100 text-amber-600 rounded-full text-sm font-medium">En attente</span>
                                @elseif ($commande->status === 'approuve')
                                    <span class="px-3 py-1 bg-emerald-100 text-emerald-600 rounded-full text-sm font-medium">Approuvé</span>
                                @elseif ($commande->status === 'rejetee')
                                    <span class="px-3 py-1 bg-rose-100 text-rose-600 rounded-full text-sm font-medium">Rejeté</span>
                                
                                @endif
                            </div>
                        </div>
                        <div>
                            <p class="text-sm text-slate-600">Date de la commande</p>
                            <p class="font-semibold text-slate-900">{{ $commande->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Articles commandés -->
                <div class="bg-white p-6 rounded-lg shadow border border-slate-100">
                    <h2 class="text-xl font-bold text-slate-900 mb-4">Articles commandés</h2>
                    @if ($commande->ligneCommande->count())
                        <div class="space-y-3">
                            @foreach ($commande->ligneCommande as $ligne)
                                <div class="flex justify-between items-start pb-3 border-b border-slate-100">
                                    <div>
                                        <p class="font-semibold text-slate-900">{{ $ligne->produit->nom ?? 'Produit' }}</p>
                                        <p class="text-sm text-slate-600">Quantité: {{ $ligne->qte }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-indigo-600">{{ $ligne->qte * ($ligne->produit->prix_tokens ?? 0) }} TK</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-slate-600">Aucun article pour cette commande.</p>
                    @endif
                </div>
            </div>

            <!-- Résumé et actions -->
            <div class="space-y-6">
                <!-- Totaux -->
                <div class="bg-white p-6 rounded-lg shadow border border-slate-100">
                    <h2 class="text-xl font-bold text-slate-900 mb-4">Résumé</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center pt-4 border-t border-slate-100">
                            <p class="text-slate-600">Montant total</p>
                            <p class="text-2xl font-bold text-indigo-600">{{ $commande->montant_tokens ?? 0 }} TK</p>
                        </div>
                    </div>
                </div>

                <!-- Actions pour manager -->
                @if (auth()->user()->role_id === 3 && $commande->status === 'en_attente')
                    <div class="bg-white p-6 rounded-lg shadow border border-slate-100">
                        <h2 class="text-lg font-bold text-slate-900 mb-4">Actions</h2>
                        <div class="space-y-3">
                            <form action="{{ route('commandes.valider', $commande->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" name="action" value="accepter" 
                                    class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium">
                                    ✅ Approuver
                                </button>
                            </form>
                            <form action="{{ route('commandes.valider', $commande->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" name="action" value="refuser" 
                                    class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                                    ❌ Refuser
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
