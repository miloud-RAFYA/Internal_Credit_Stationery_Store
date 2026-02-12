@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <a href="{{ route('admin.utilisateurs.index') }}" class="text-indigo-600 hover:underline">← Retour</a>

        <div class="bg-white rounded shadow p-6 mt-4">
            <h2 class="text-2xl font-bold">Modifier {{ $user->nom }}</h2>
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Oups ! Il y a quelques problèmes :</strong>
                    <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.utilisateurs.update', $user->id) }}" method="POST" class="mt-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Nom</label>
                        <input type="text" name="nom" value="{{ old('nom', $user->nom) }}"
                            class="mt-1 w-full rounded border px-3 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="mt-1 w-full rounded border px-3 py-2">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Département</label>
                        <select name="departement_id" class="mt-1 w-full rounded border px-3 py-2">
                            <option value="">-- Choisir --</option>
                            @foreach(App\Models\Departement::all() as $dep)
                                <option value="{{ $dep->id }}" {{ (old('departement_id', $user->employe->departement_id ?? '') == $dep->id) ? 'selected' : '' }}>{{ $dep->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Tokens</label>
                        <input type="number" name="token" value="{{ old('token', $user->employe->token ?? 0) }}"
                            class="mt-1 w-full rounded border px-3 py-2">
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-slate-700">Rôle</label>
                    <select name="role_id" class="mt-1 w-full rounded border px-3 py-2">
                        <option value="2" {{ $user->role == 'employe' ? 'selected' : '' }}>Employé</option>
                        <option value="3" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
                    </select>
                </div>

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Mettre à jour</button>
                    <a href="{{ route('admin.utilisateurs.index') }}" class="px-4 py-2 border rounded">Annuler</a>
                </div>
            </form>
        </div>
    </div>
@endsection