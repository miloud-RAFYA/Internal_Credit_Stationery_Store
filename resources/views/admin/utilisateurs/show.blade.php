@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <a href="{{ route('admin.utilisateurs.index') }}" class="text-indigo-600 hover:underline">← Retour</a>

    <div class="bg-white rounded shadow p-6 mt-4">
        <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
        <p class="text-sm text-slate-500">{{ $user->email }}</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
            <div>
                <p class="text-xs text-slate-500">Département</p>
                <p class="font-semibold">{{ $user->employe->departement->nom ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-500">Tokens</p>
                <p class="font-semibold">{{ $user->employe->token ?? 0 }} TK</p>
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            @can('update', $user)
            <a href="{{ route('admin.utilisateurs.edit', $user->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded">Modifier</a>
            @endcan
            <a href="{{ route('admin.utilisateurs.index') }}" class="px-4 py-2 border rounded">Fermer</a>
        </div>
    </div>
</div>
@endsection
