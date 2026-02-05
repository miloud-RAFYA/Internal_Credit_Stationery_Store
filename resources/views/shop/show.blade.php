@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <a href="{{ route('shop.index') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold mb-6 inline-block">
        ← Retour à la boutique
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Image produit -->
        <div class="bg-slate-100 rounded-lg h-96 flex items-center justify-center text-6xl">
            📦
        </div>

        <!-- Détails produit -->
        <div class="flex flex-col justify-between">
            <div>
                <h1 class="text-4xl font-bold text-slate-900">Nom du produit</h1>
                <p class="text-slate-500 mt-2">Catégorie : Fournitures</p>
                
                <div class="flex items-center gap-4 mt-6">
                    <p class="text-5xl font-bold text-indigo-600">500 TK</p>
                    @if(false)
                    <span class="px-4 py-2 bg-purple-100 text-purple-700 rounded-full text-sm font-semibold">Premium</span>
                    @endif
                </div>

                <div class="mt-6 p-4 bg-slate-50 rounded-lg">
                    <p class="font-semibold text-slate-900">Description du produit</p>
                    <p class="text-slate-600 mt-2">
                        Découvrez les détails complets de ce produit. Haute qualité, conforme aux normes professionnelles.
                    </p>
                </div>

                <div class="mt-6">
                    <p class="font-semibold text-slate-900 mb-2">Stock disponible</p>
                    <p class="text-2xl font-bold text-slate-700">47 unités</p>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="flex gap-3 mt-8">
                <button class="flex-1 px-6 py-4 bg-indigo-600 text-white rounded-lg font-bold text-lg hover:bg-indigo-700">
                    Ajouter au panier
                </button>
                <button class="px-6 py-4 border-2 border-indigo-600 text-indigo-600 rounded-lg font-bold hover:bg-indigo-50">
                    ♥
                </button>
            </div>
        </div>
    </div>

    <!-- Avis clients -->
    <div class="mt-12 bg-white rounded-lg shadow border border-slate-100 p-8">
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Avis clients</h2>
        <div class="space-y-4">
            @for($i = 1; $i <= 3; $i++)
            <div class="pb-4 border-b border-slate-100 last:border-0">
                <div class="flex items-center gap-2 mb-2">
                    <span class="font-semibold">Client {{ $i }}</span>
                    <span class="text-yellow-400">★★★★★</span>
                </div>
                <p class="text-slate-600">Très bon produit, conforme à mes attentes !</p>
            </div>
            @endfor
        </div>
    </div>
</div>
@endsection
