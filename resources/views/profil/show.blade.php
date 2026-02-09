@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-6 text-sm">
        <ol class="list-reset flex text-gray-700">
            <li><a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800">Accueil</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-gray-500">Mon Profil</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Profile Card Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <div class="mb-4">
                    <div class="w-24 h-24 mx-auto bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white text-3xl font-bold">
                        {{ strtoupper(substr(auth()->user()->nom, 0, 1)) }}
                    </div>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ auth()->user()->nom }}</h2>
                <p class="text-gray-500 mb-4">{{ auth()->user()->role->nom ?? 'N/A' }}</p>
                <hr class="my-4">
                <div class="text-left">
                    <p class="text-sm text-gray-600 mb-2">
                        <strong>Email:</strong> {{ auth()->user()->email }}
                    </p>
                    <p class="text-sm text-gray-600 mb-4">
                        <strong>ID Utilisateur:</strong> #{{ auth()->user()->id }}
                    </p>
                </div>
                <div class="flex gap-2 mt-4">
                    <a href="{{ route('profile.edit') }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                        Modifier
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Profile Content -->
        <div class="lg:col-span-3">
            <!-- Personal Information -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 pb-3 border-b border-gray-200">
                    Informations Personnelles
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-gray-600 text-sm font-semibold">Nom</label>
                        <p class="text-gray-800 text-lg">{{ auth()->user()->nom }}</p>
                    </div>
                    <div>
                        <label class="text-gray-600 text-sm font-semibold">Email</label>
                        <p class="text-gray-800 text-lg">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Role Information -->
            @if(auth()->user()->role)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 pb-3 border-b border-gray-200">
                    Rôle
                </h3>
                <div class="flex items-center">
                    <span class="inline-block bg-blue-100 text-blue-800 px-4 py-2 rounded-full font-semibold">
                        {{ auth()->user()->role->nom }}
                    </span>
                </div>
                @if(auth()->user()->role->description)
                <p class="text-gray-600 mt-3">{{ auth()->user()->role->description }}</p>
                @endif
            </div>
            @endif

            <!-- Employee Information (if applicable) -->
            @if(auth()->user()->employe)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 pb-3 border-b border-gray-200">
                    Informations Employé
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if(auth()->user()->employe->salaire)
                    <div>
                        <label class="text-gray-600 text-sm font-semibold">Salaire</label>
                        <p class="text-gray-800 text-lg">{{ number_format(auth()->user()->employe->salaire, 2, ',', ' ') }} €</p>
                    </div>
                    @endif
                    @if(auth()->user()->employe->date_embauche)
                    <div>
                        <label class="text-gray-600 text-sm font-semibold">Date d'Embauche</label>
                        <p class="text-gray-800 text-lg">{{ \Carbon\Carbon::parse(auth()->user()->employe->date_embauche)->format('d/m/Y') }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Manager Information (if applicable) -->
            @if(auth()->user()->manager)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 pb-3 border-b border-gray-200">
                    Informations Manager
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if(auth()->user()->manager->salaire)
                    <div>
                        <label class="text-gray-600 text-sm font-semibold">Salaire</label>
                        <p class="text-gray-800 text-lg">{{ number_format(auth()->user()->manager->salaire, 2, ',', ' ') }} €</p>
                    </div>
                    @endif
                    @if(auth()->user()->manager->date_embauche)
                    <div>
                        <label class="text-gray-600 text-sm font-semibold">Date d'Embauche</label>
                        <p class="text-gray-800 text-lg">{{ \Carbon\Carbon::parse(auth()->user()->manager->date_embauche)->format('d/m/Y') }}</p>
                    </div>
                    @endif
                    @if(auth()->user()->manager->departement)
                    <div>
                        <label class="text-gray-600 text-sm font-semibold">Département</label>
                        <p class="text-gray-800 text-lg">{{ auth()->user()->manager->departement->nom }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Account Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 pb-3 border-b border-gray-200">
                    Compte
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Compte créé le:</span>
                        <span class="text-gray-800">{{ auth()->user()->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Dernière modification:</span>
                        <span class="text-gray-800">{{ auth()->user()->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
                <div class="mt-6 flex gap-2">
                    <a href="{{ route('profile.edit') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                        Modifier le Profil
                    </a>
                    <a href="{{ route('password.request') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition">
                        Changer le Mot de Passe
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
