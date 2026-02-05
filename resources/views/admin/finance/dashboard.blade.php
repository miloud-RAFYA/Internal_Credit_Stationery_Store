@extends('layouts.app')
@section('content')
    <div class="flex justify-between items-end mb-10">
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
    </div>
@endsection