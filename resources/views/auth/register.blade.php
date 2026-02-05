@extends('layouts.guest')

@section('content')
<div class="w-full">
    <div class="text-center mb-6">
        <a href="/" class="text-2xl font-extrabold text-indigo-600">Stationery<span class="text-indigo-400">Pro</span></a>
        <p class="text-sm text-slate-500 mt-2">Créez un compte pour commander depuis la boutique interne</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        @if($errors->any())
            <div class="bg-red-50 border border-red-100 text-red-700 p-3 rounded">
                <ul class="text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Nom complet</label>
            <input type="text" name="nom" value="{{ old('nom') }}" required autofocus
                   class="w-full px-4 py-3 rounded-lg border border-slate-200 bg-white focus:ring-2 focus:ring-indigo-500"/>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full px-4 py-3 rounded-lg border border-slate-200 bg-white focus:ring-2 focus:ring-indigo-500"/>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Mot de passe</label>
                <input type="password" name="password" required
                       class="w-full px-4 py-3 rounded-lg border border-slate-200 bg-white focus:ring-2 focus:ring-indigo-500"/>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Confirmer mot de passe</label>
                <input type="password" name="password_confirmation" required
                       class="w-full px-4 py-3 rounded-lg border border-slate-200 bg-white focus:ring-2 focus:ring-indigo-500"/>
            </div>
        </div>

        <button type="submit" class="w-full px-4 py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700">Créer un compte</button>

        <p class="text-center text-sm text-slate-500">Déjà inscrit ? <a href="{{ route('login') }}" class="text-indigo-600 font-semibold">Se connecter</a></p>
    </form>
</div>
@endsection
