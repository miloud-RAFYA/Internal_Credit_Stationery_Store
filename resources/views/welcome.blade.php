@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-600 to-purple-800 flex items-center justify-center px-4">
    <div class="max-w-lg w-full">
        <!-- Logo Section -->
        <div class="text-center mb-10">
            <h1 class="text-5xl font-bold text-white mb-2">🏪 CREDIT STORE</h1>
            <p class="text-indigo-100 text-lg">Bienvenue dans notre boutique de crédit en ligne</p>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-2xl shadow-2xl p-8 mb-6">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-slate-800">Rejoignez-nous!</h2>
                <p class="text-slate-600 mt-2">Accédez à des milliers de produits avec vos tokens</p>
            </div>

            <!-- Features -->
            <div class="grid grid-cols-3 gap-4 mb-8">
                <div class="text-center">
                    <div class="text-3xl mb-2">🛍️</div>
                    <p class="text-xs font-semibold text-slate-600">Produits</p>
                </div>
                <div class="text-center">
                    <div class="text-3xl mb-2">💰</div>
                    <p class="text-xs font-semibold text-slate-600">Tokens</p>
                </div>
                <div class="text-center">
                    <div class="text-3xl mb-2">⚡</div>
                    <p class="text-xs font-semibold text-slate-600">Rapide</p>
                </div>
            </div>

            <!-- CTA Buttons -->
            <div class="space-y-3">
                <a href="{{ route('login') }}" class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg transition text-center">
                    🔓 Se Connecter
                </a>
                <a href="{{ route('register') }}" class="block w-full bg-white hover:bg-slate-50 text-indigo-600 font-bold py-3 rounded-lg border-2 border-indigo-600 transition text-center">
                    ✍️ S'Inscrire
                </a>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="text-center text-indigo-100 text-sm">
            <p>© 2026 Credit Store. Tous droits réservés.</p>
        </div>
    </div>
</div>
@endsection
