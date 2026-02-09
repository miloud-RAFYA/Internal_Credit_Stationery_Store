@extends('layouts.app')



@section('content')
<div class="max-w-4xl mx-auto p-6">

    
    <div class="bg-white rounded shadow p-6 mb-6">
        <h2 class="text-xl font-bold mb-2">
            Solde de tokens
        </h2>

        <p class="text-4xl font-extrabold text-blue-600">
            {{ $token }} Tokens
        </p>

        <p class="text-gray-500 mt-2">
            Ceci représente votre pouvoir d’achat pour ce mois.
        </p>
    </div>

    
    <div class="bg-gray-100 rounded p-6 mb-6">
        <h2 class="text-xl font-bold mb-2">
            Attribution mensuelle
        </h2>
        <p class="text-gray-400">
            À venir...
        </p>
    </div>

    
    <div class="bg-gray-100 rounded p-6">
        <h2 class="text-xl font-bold mb-2">
            Historique des transactions
        </h2>
        <p class="text-gray-400">
            À venir...
        </p>
    </div>

</div>
@endsection
