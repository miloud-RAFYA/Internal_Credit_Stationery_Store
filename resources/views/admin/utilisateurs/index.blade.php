@extends('layouts.app')

@section('content')
    <div class="py-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-semibold">Liste des utilisateurs</h1>
                <p class="text-sm text-slate-500">Gérer tous les utilisateurs et leurs informations</p>
            </div>
            <a href="{{route('admin.utilisateurs.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">+
                Ajouter</a>

        </div>
        
        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-100 text-slate-500 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Nom</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3 text-center">Département</th>
                        <th class="px-6 py-3 text-center">Tokens</th>
                        <th class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($utilisateurs as $user)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-bold">#{{ $user->id }}</td>
                            <td class="px-6 py-4 font-semibold">{{ $user->nom }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-center">{{ $user->employe->departement->nom ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">{{ $user->employe->token ?? 0 }}</td>
                            <td class="px-6 py-4 text-center flex justify-center gap-2">
                                <a href="" class="px-3 py-1 bg-slate-100 text-slate-700 rounded hover:bg-slate-200">
                                    Voir
                                </a>

                                <a href="{{route('admin.utilisateurs.edit', $user->id) }}"
                                    class="px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                                    Modifier
                                </a>

                                <form action="{{ route('admin.utilisateurs.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-rose-100 text-rose-700 rounded hover:bg-rose-200">
                                        Supprimer
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">

        </div>
    </div>
@endsection