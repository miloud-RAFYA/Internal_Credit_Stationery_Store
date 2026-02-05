@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-4xl font-bold text-slate-900">Boutique</h1>
            <p class="text-slate-500 mt-2">Découvrez nos fournitures de bureau</p>
        </div>
        <a href="{{ route('shop.cart') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700">
            🛒 Mon panier
        </a>
    </div>

    <!-- Filtres -->
    <div class="flex gap-3 mb-6">
        <input type="text" placeholder="Rechercher..." class="flex-1 px-4 py-2 border border-slate-200 rounded-lg">
        <select class="px-4 py-2 border border-slate-200 rounded-lg bg-white">
            <option>Toutes les catégories</option>
        </select>
    </div>

    <!-- Grille de produits -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @for($i = 1; $i <= 8; $i++)
        <div class="bg-white rounded-lg shadow border border-slate-100 hover:shadow-lg transition overflow-hidden">
            <div class="h-48 bg-slate-100 flex items-center justify-center text-4xl">
                📦
            </div>
            <div class="p-4">
                <h3 class="font-bold text-slate-900">Produit {{ $i }}</h3>
                <p class="text-sm text-slate-500 mt-1">Description courte du produit</p>
                
                <div class="flex items-center justify-between mt-4">
                    <p class="text-xl font-bold text-indigo-600">{{ 100 + $i * 50 }} TK</p>
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700">
                        Ajouter
                    </button>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>
@endsection
