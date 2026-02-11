@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-4xl font-bold mb-2">Bienvenue, {{ auth()->user()->name }}! 👋</h1>
                <p class="text-gray-600 mb-8">Vous êtes connecté à votre espace personnel</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Your Profile Card -->
                    <a href="{{ route('profile.edit') }}" class="bg-indigo-50 border border-indigo-200 rounded-lg p-6 hover:shadow-lg transition">
                        <div class="text-4xl mb-3">👤</div>
                        <h2 class="text-lg font-bold text-indigo-900">Mon Profil</h2>
                        <p class="text-sm text-indigo-700 mt-2">Gérer vos informations personnelles</p>
                    </a>

                    <!-- Shop Card -->
                    <a href="#" class="bg-emerald-50 border border-emerald-200 rounded-lg p-6 hover:shadow-lg transition">
                        <div class="text-4xl mb-3">🛍️</div>
                        <h2 class="text-lg font-bold text-emerald-900">Boutique</h2>
                        <p class="text-sm text-emerald-700 mt-2">Parcourir les produits disponibles</p>
                    </a>

                    <!-- Orders Card -->
                    <a href="#" class="bg-amber-50 border border-amber-200 rounded-lg p-6 hover:shadow-lg transition">
                        <div class="text-4xl mb-3">📋</div>
                        <h2 class="text-lg font-bold text-amber-900">Mes Commandes</h2>
                        <p class="text-sm text-amber-700 mt-2">Suivi de vos commandes</p>
                    </a>
                </div>
                
                <!-- Manager Section -->
                @if(auth()->user()->role_id && auth()->user()->role->name === 'manager')
                <div class="mt-12 pt-8 border-t-2 border-slate-200">
                    <h2 class="text-2xl font-bold text-slate-800 mb-6">📈 Section Manager</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <a href="{{ route('manager.index') }}" class="bg-blue-600 text-white rounded-lg p-6 hover:bg-blue-700 transition">
                            <div class="text-3xl mb-3">✅</div>
                            <h3 class="text-lg font-bold">Approbations</h3>
                            <p class="text-sm text-blue-200 mt-2">Approuver les commandes en attente</p>
                        </a>

                        <a href="#" class="bg-teal-600 text-white rounded-lg p-6 hover:bg-teal-700 transition">
                            <div class="text-3xl mb-3">📊</div>
                            <h3 class="text-lg font-bold">Rapports</h3>
                            <p class="text-sm text-teal-200 mt-2">Consulter les rapports d'activité</p>
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
