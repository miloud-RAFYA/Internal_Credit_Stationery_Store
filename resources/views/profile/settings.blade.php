@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <h1 class="text-4xl font-bold text-slate-900 mb-2">Paramètres du compte</h1>
    <p class="text-slate-500 mb-8">Gérez votre profil et vos préférences</p>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Menu latéral -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow border border-slate-100 overflow-hidden">
                <div class="space-y-2 p-4">
                    <button class="w-full text-left px-4 py-3 bg-indigo-100 text-indigo-700 rounded-lg font-semibold">
                        Profil
                    </button>
                    <button class="w-full text-left px-4 py-3 text-slate-700 hover:bg-slate-50 rounded-lg">
                        Sécurité
                    </button>
                    <button class="w-full text-left px-4 py-3 text-slate-700 hover:bg-slate-50 rounded-lg">
                        Notifications
                    </button>
                    <button class="w-full text-left px-4 py-3 text-slate-700 hover:bg-slate-50 rounded-lg">
                        Confidentialité
                    </button>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informations personnelles -->
            <div class="bg-white rounded-lg shadow border border-slate-100 p-6">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Informations personnelles</h2>
                
                <form class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Prénom</label>
                            <input type="text" value="Jean" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:border-indigo-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nom</label>
                            <input type="text" value="Dupont" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:border-indigo-500 focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                        <input type="email" value="jean.dupont@example.com" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:border-indigo-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Département</label>
                        <input type="text" value="Ressources Humaines" disabled class="w-full px-4 py-2 border border-slate-200 rounded-lg bg-slate-50 text-slate-500">
                    </div>

                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 mt-4">
                        Enregistrer les modifications
                    </button>
                </form>
            </div>

            <!-- Informations Tokens -->
            <div class="bg-white rounded-lg shadow border border-slate-100 p-6">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Vos Tokens</h2>
                
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="p-4 bg-indigo-50 rounded-lg">
                        <p class="text-sm text-indigo-600 font-semibold">Solde actuel</p>
                        <p class="text-3xl font-bold text-indigo-700 mt-2">2500 TK</p>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-lg">
                        <p class="text-sm text-slate-600 font-semibold">Dépensés ce mois</p>
                        <p class="text-3xl font-bold text-slate-700 mt-2">1200 TK</p>
                    </div>
                </div>

                <a href="#" class="text-indigo-600 hover:text-indigo-700 font-semibold">
                    Voir l'historique des Tokens →
                </a>
            </div>

            <!-- Déconnexion -->
            <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                <h2 class="text-lg font-bold text-red-700 mb-2">Zone de danger</h2>
                <p class="text-red-600 mb-4">Attention : Ces actions sont irréversibles</p>
                <button class="px-6 py-2 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700">
                    Se déconnecter
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
