@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
    <div>
        <h1 class="text-4xl font-extrabold tracking-tight">Catalogue Articles</h1>
        <p class="text-slate-500">Gérez les fournitures et les niveaux de stock</p>
    </div>
    <button  class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all flex items-center gap-2">
        <span>+</span> Ajouter un article
    </button>
</div>

<div class="flex gap-3 mb-6">
    <span class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-600 shadow-sm cursor-pointer hover:border-indigo-400">Tous</span>
    <span class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-400 shadow-sm cursor-pointer hover:border-indigo-400 text-red-500">Stock Faible</span>
    <span class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-400 shadow-sm cursor-pointer hover:border-indigo-400 text-purple-600">Premium</span>
</div>

<div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                <tr>
                    <th class="px-8 py-5 text-left">Article</th>
                    <th class="px-8 py-5 text-center">Description</th>
                    <th class="px-8 py-5 text-center">Statut</th>
                    <th class="px-8 py-5 text-center">Stock</th>
                    <th class="px-8 py-5 text-right">Prix</th>
                    <th class="px-8 py-5 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($produits as $product)
                <tr class="hover:bg-indigo-50/30 transition-colors group">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center text-xl shadow-inner">
                                @if($product->image_produit)
                                     <img src="{{ asset('storage/' . $product->image_produit) }}" alt="Product Image">
                                @else
                                     <div class="placeholder">📦</div>
                                @endif
                            </div>
                            <span class="font-bold text-slate-700 text-base">{{ $product->nom }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-5 text-center text-slate-500 font-medium">
                        {{ $product->description ?? 'Général' }}
                    </td>
                    <td class="px-8 py-5 text-center">
                        @if($product->est_premuim)
                            <span class="bg-purple-100 text-purple-600 px-3 py-1 rounded-lg text-[10px] font-black uppercase ring-1 ring-purple-200">Premium</span>
                        @else
                            <span class="bg-slate-100 text-slate-500 px-3 py-1 rounded-lg text-[10px] font-black uppercase">Standard</span>
                        @endif
                    </td>
                    <td class="px-8 py-5 text-center">
                        <div class="inline-flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full {{ $product->stock <= 5 ? 'bg-red-500 animate-pulse' : 'bg-emerald-500' }}"></span>
                            <span class="font-bold {{ $product->stock <= 5 ? 'text-red-600' : 'text-slate-600' }}">{{ $product->stock }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <span class="font-black text-indigo-600 text-lg">{{ $product->prix_tokens }} <span class="text-xs">TK</span></span>
                    </td>
                    <td class="px-8 py-5 text-center">
                        <div class="flex justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button class="p-2 hover:bg-white rounded-lg border border-transparent hover:border-slate-200 text-slate-400 hover:text-indigo-600">✏️</button>
                            <button class="p-2 hover:bg-white rounded-lg border border-transparent hover:border-slate-200 text-slate-400 hover:text-red-600">🗑️</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection