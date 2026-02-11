@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-slate-900">Validations en attente</h1>
            <p class="text-slate-500 mt-2">Articles Premium à approuver</p>
        </div>

        <!-- Notifications en attente -->
         {{ var_dump(auth()->user()->unreadNotifications->count());}}
                   {{ exit;}}
        @if (auth()->user()->unreadNotifications->count())
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-4">Nouvelles notifications ({{ auth()->user()->unreadNotifications->count() }})</h2>
                <div class="space-y-3">
                   {{ var_dump(auth()->user()->unreadNotifications);}}
                   {{ exit;}}
                    @foreach (auth()->user()->unreadNotifications as $notification)
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-200 hover:shadow-md transition">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start gap-3 flex-1">
                                    <div class="text-xl mt-1">🔔</div>
                                    <div>
                                        <h3 class="font-semibold text-slate-900">
                                            {{ $notification->data['employe_name'] ?? 'Utilisateur' }} a passé une commande premium
                                        </h3>
                                        <p class="text-sm text-slate-600 mt-1">
                                            Montant : <span class="font-bold text-indigo-600">{{ $notification->data['montant'] ?? 0 }} Tokens</span>
                                        </p>
                                        <p class="text-xs text-slate-400 mt-2">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="flex gap-2 ml-4">
                                    <form action="{{ route('commandes.valider', $notification->data['commande_id']) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="action" value="accepter" 
                                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm font-medium">
                                            ✅ Approuver
                                        </button>
                                    </form>
                                    <form action="{{ route('commandes.valider', $notification->data['commande_id']) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="action" value="refuser" 
                                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm font-medium">
                                            ❌ Refuser
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- <!-- Filtres -->
        <div class="flex gap-2 mb-6">
            <a href="{{ route('commandes.pendantes') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">En attente</a>
            <a href="{{ route('commandes.index') }}?filter=approuve"
                class="px-4 py-2 border border-slate-200 text-slate-700 rounded-lg hover:bg-slate-50">Approuvés</a>
            <a href="{{ route('commandes.index') }}?filter=rejetee"
                class="px-4 py-2 border border-slate-200 text-slate-700 rounded-lg hover:bg-slate-50">Rejetés</a>
        </div> --}}

        <!-- Liste des commandes -->
        <div class="space-y-4">
            @if (isset($commandes) && $commandes->count())
                @foreach ($commandes as $commande)
                    <div class="bg-white p-6 rounded-lg shadow border border-slate-100 hover:shadow-md transition">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-slate-100 rounded-lg flex items-center justify-center text-2xl">
                                    📦
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900">
                                        @if ($commande->ligneCommande->count())
                                            {{ $commande->ligneCommande->first()->produit->nom ?? 'Produit' }}
                                        @else
                                            Commande #{{ $commande->id }}
                                        @endif
                                    </h3>
                                    <p class="text-sm text-slate-500">Demandé par
                                        <strong>{{ $commande->user->nom ?? 'Utilisateur' }}</strong> -
                                        {{ $commande->user->employe->departement->nom ?? '' }}</p>
                                    <p class="text-sm text-slate-400 mt-1">{{ $commande->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-indigo-600">{{ $commande->montant_tokens }} TK</p>
                                <p class="text-xs text-slate-400">Montant total</p>
                            </div>
                        </div>

                        <div class="flex gap-3 pt-4 border-t border-slate-100">
                            <a href="{{ route('commandes.show', $commande->id) }}"
                                class="px-4 py-2 border border-slate-200 text-slate-700 rounded-lg hover:bg-slate-50">
                                Détails
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-white p-6 rounded-lg shadow border border-slate-100">
                    <p class="text-slate-600">Aucune demande en attente pour le moment.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
