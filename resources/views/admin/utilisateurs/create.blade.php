@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Ajouter un utilisateur</h1>

    <div class="bg-white p-6 rounded shadow">
        <form action="{{ route('admin.utilisateurs.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700">Nom</label>
                    <input type="text" name="nom" value="{{ old('nom') }}" class="mt-1 w-full rounded border px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full rounded border px-3 py-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700">Mot de passe</label>
                    <input type="password" name="password" value="{{ old('password') }}" class="mt-1 w-full rounded border px-3 py-2" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700">Département</label>
                    <select name="departement_id" value="" class=" overflow-y-auto mt-1 w-full rounded border px-3 py-2">
                        <option value="">-- Choisir --</option>
                        @foreach($departement as $dep)
                        <option value="{{ $dep->id }}">{{ $dep->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Tokens</label>
                    <input type="number" name="token" value="{{ old('token', 0) }}" class="mt-1 w-full rounded border px-3 py-2">
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium text-slate-700">Rôle</label>
                <select name="role_id" class="mt-1 w-full rounded border px-3 py-2">
                    <option value="2">Employé</option>
                    <option value="3">Manager</option>
                </select>
            </div>

            <div class="mt-6 flex gap-3">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Enregistrer</button>
                <a href="{{ route('admin.utilisateurs.index') }}" class="px-4 py-2 border rounded">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection
