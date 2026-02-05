@extends('layouts.app')

@section('content')
    <!-- <div class="flex justify-between items-end mb-10">
            <div>
                <h1 class="text-4xl font-extrabold tracking-tight">Vue d'ensemble</h1>
                <p class="text-slate-500 mt-1">Statistiques globales et rapports financiers</p>
            </div>
            <button onclick="toggleModal('modal-product')" class="px-6 py-3 rounded-2xl bg-indigo-600 text-white font-bold shadow-lg hover:bg-indigo-700 transition">
                + Ajouter Produit
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center gap-5">
                <div class="p-4 rounded-2xl bg-indigo-50 text-indigo-600 text-2xl">📦</div>
                <div>
                    <p class="text-xs uppercase font-bold text-slate-400">Total Produits</p>
                    <p class="text-3xl font-extrabold"></p>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center gap-5">
                <div class="p-4 rounded-2xl bg-emerald-50 text-emerald-600 text-2xl">💰</div>
                <div>
                    <p class="text-xs uppercase font-bold text-slate-400">Dépenses (Tokens)</p>
                    <p class="text-3xl font-extrabold"></p>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 flex items-center gap-5">
                <div class="p-4 rounded-2xl bg-amber-50 text-amber-600 text-2xl">👥</div>
                <div>
                    <p class="text-xs uppercase font-bold text-slate-400">Collaborateurs</p>
                    <p class="text-3xl font-extrabold"></p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl overflow-hidden border border-slate-100">
            <div class="p-8 border-b flex justify-between items-center">
                <h2 class="text-xl font-extrabold">Dernières Activités</h2>
                <span class="px-4 py-1 bg-slate-100 rounded-full text-xs font-bold text-slate-500">Finance & Logistique</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-slate-50 text-slate-400 uppercase text-xs">
                        <tr>
                            <th class="px-8 py-4 text-left">ID</th>
                            <th class="px-8 py-4 text-left">Utilisateur</th>
                            <th class="px-8 py-4 text-right">Montant</th>
                            <th class="px-8 py-4 text-center">Statut</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">

                        <tr class="hover:bg-indigo-50/30 transition">
                            <td class="px-8 py-5 font-bold text-slate-400">#</td>
                            <td class="px-8 py-5 font-semibold"></td>
                            <td class="px-8 py-5 text-right font-black text-indigo-600"> TK</td>
                            <td class="px-8 py-5 text-center">
                                <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase ">

                                </span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div> -->


    <!-- Header -->
    <div class="mb-10">
        <h1 class="text-4xl font-extrabold tracking-tight">Tableau de bord</h1>
        <p class="text-slate-500 mt-1">Vue générale de votre boutique</p>
    </div>

    <!-- ================= STATS ================= -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">

        <!-- Card -->
        <div class="bg-white/80 backdrop-blur rounded-3xl p-6 shadow hover:shadow-lg transition flex items-center gap-5">
            <div class="p-4 rounded-2xl bg-indigo-100 text-indigo-600">
                📦
            </div>
            <div>
                <p class="text-xs uppercase font-bold text-slate-400">Produits</p>
                <p class="text-3xl font-extrabold">{{ $stats['total_products'] }}</p>
            </div>
        </div>

        <div class="bg-white/80 backdrop-blur rounded-3xl p-6 shadow hover:shadow-lg transition flex items-center gap-5">
            <div class="p-4 rounded-2xl bg-emerald-100 text-emerald-600">
                💰
            </div>
            <div>
                <p class="text-xs uppercase font-bold text-slate-400">Tokens</p>
                <p class="text-3xl font-extrabold">
                    {{ number_format($stats['total_tokens'] ?? 0, 0, ',', ' ') }}
                    <span class="text-sm text-slate-400">TK</span>
                </p>
            </div>
        </div>

        <div class="bg-white/80 backdrop-blur rounded-3xl p-6 shadow hover:shadow-lg transition flex items-center gap-5">
            <div class="p-4 rounded-2xl bg-amber-100 text-amber-600">
                👥
            </div>
            <div>
                <p class="text-xs uppercase font-bold text-slate-400">Utilisateurs</p>
                <p class="text-3xl font-extrabold">{{ $stats['total_users'] }}</p>
            </div>
        </div>

    </div>

    <!-- ================= TABLE ================= -->
    <div class="bg-white rounded-[2.5rem] shadow-xl overflow-hidden">
        <div class="p-8 border-b flex justify-between items-center">
            <h2 class="text-xl font-extrabold">Transactions récentes</h2>
            <span class="text-sm text-slate-500">30 derniers jours</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-400 uppercase text-xs">
                    <tr>
                        <th class="px-8 py-4 text-left">ID</th>
                        <th class="px-8 py-4 text-left">Client</th>
                        <th class="px-8 py-4 text-center">Date</th>
                        <th class="px-8 py-4 text-right">Montant</th>
                        <th class="px-8 py-4 text-center">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($commandes as $commande)
                        <tr class="hover:bg-indigo-50/40 transition">
                            <td class="px-8 py-5 font-bold">CMD-{{ $commande->id }}</td>
                            <td class="px-8 py-5 font-semibold">{{ $commande->user->nom }}</td>
                            <td class="px-8 py-5 text-center text-slate-500">
                                {{ $commande->created_at->format('d M Y') }}
                            </td>
                            <td class="px-8 py-5 text-right font-extrabold text-indigo-600">
                                {{ $commande->montant_tokens }} TK
                            </td>
                            <td class="px-8 py-5 text-center">
                                <span class="px-4 py-1 rounded-full text-xs font-bold
                                        @if($commande->status == 'approuve') bg-emerald-100 text-emerald-600
                                        @elseif($commande->status == 'rejetee') bg-rose-100 text-rose-600
                                        @elseif($commande->status == 'recue') bg-blue-100 text-blue-600
                                        @else bg-amber-100 text-amber-600 @endif">
                                    {{ strtoupper(str_replace('_', ' ', $commande->status)) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- ================= MODAL ================= -->
    <!-- <div id="modal-product" class="fixed inset-0 bg-black/60 backdrop-blur hidden items-center justify-center z-50">
        <div class="bg-white rounded-3xl p-8 w-full max-w-md shadow-2xl">
            <div class="flex justify-between mb-6">
                <h3 class="text-xl font-extrabold">Nouveau produit</h3>
                <button onclick="toggleModal('modal-product')" class="text-slate-400">✕</button>
            </div>

            <form class="space-y-4">
                <input class="w-full p-4 rounded-xl bg-slate-50 focus:ring-2 focus:ring-indigo-500 outline-none"
                    placeholder="Nom du produit">
                <div class="grid grid-cols-2 gap-4">
                    <input type="number" placeholder="Prix TK" class="p-4 rounded-xl bg-slate-50">
                    <input type="number" placeholder="Stock" class="p-4 rounded-xl bg-slate-50">
                </div>
                <button class="w-full py-4 rounded-xl bg-indigo-600 text-white font-bold hover:bg-indigo-700 transition">
                    Enregistrer
                </button>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(id) {
            const modal = document.getElementById(id);
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }
    </script> -->

@endsection