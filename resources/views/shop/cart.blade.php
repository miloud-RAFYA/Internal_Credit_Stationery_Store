@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <h1 class="text-4xl font-bold text-slate-900 mb-8">Mon panier</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Articles du panier -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow border border-slate-100 overflow-hidden">
                @if(false)
                <div class="p-6 text-center text-slate-500">
                    <p class="text-lg">Votre panier est vide</p>
                </div>
                @else
                <div class="divide-y divide-slate-100">
                    @for($i = 1; $i <= 3; $i++)
                    <div class="p-6 flex items-center gap-4 hover:bg-slate-50">
                        <div class="w-20 h-20 bg-slate-100 rounded-lg flex items-center justify-center text-2xl">
                            📦
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-slate-900">Produit {{ $i }}</h3>
                            <p class="text-sm text-slate-500">250 TK</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button class="px-2 py-1 border border-slate-200 rounded">-</button>
                            <span class="w-8 text-center">{{ $i }}</span>
                            <button class="px-2 py-1 border border-slate-200 rounded">+</button>
                        </div>
                        <p class="font-bold text-slate-900 w-20 text-right">{{ 250 * $i }} TK</p>
                        <button class="text-red-600 hover:text-red-700 font-bold">🗑️</button>
                    </div>
                    @endfor
                </div>
                @endif
            </div>
        </div>

        <!-- Résumé panier -->
        <div class="bg-white rounded-lg shadow border border-slate-100 p-6 h-fit sticky top-6">
            <h2 class="text-xl font-bold text-slate-900 mb-6">Résumé</h2>
            
            <div class="space-y-3 pb-6 border-b border-slate-100 mb-6">
                <div class="flex justify-between text-slate-600">
                    <span>Sous-total</span>
                    <span>750 TK</span>
                </div>
                <div class="flex justify-between text-slate-600">
                    <span>Frais de service</span>
                    <span>0 TK</span>
                </div>
            </div>

            <div class="flex justify-between text-lg font-bold text-slate-900 mb-6">
                <span>Total</span>
                <span class="text-indigo-600">750 TK</span>
            </div>

            <!-- Solde utilisateur -->
            <div class="p-4 bg-slate-50 rounded-lg mb-6">
                <p class="text-sm text-slate-600">Solde disponible</p>
                <p class="text-2xl font-bold text-slate-900">2000 TK</p>
            </div>

            <button class="w-full px-6 py-3 bg-indigo-600 text-white rounded-lg font-bold hover:bg-indigo-700">
                Confirmer la commande
            </button>

            <a href="{{ route('shop.index') }}" class="block text-center mt-3 text-indigo-600 hover:text-indigo-700 font-semibold">
                Continuer vos achats
            </a>
        </div>
    </div>
</div>
@endsection
