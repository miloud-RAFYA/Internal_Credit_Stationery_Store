@extends('layouts.guest')

@section('content')
<div class="w-full">
    <div class="text-center mb-6">
        <a href="/" class="text-2xl font-extrabold text-indigo-600">Stationery<span class="text-indigo-400">Pro</span></a>
        <p class="text-sm text-slate-500 mt-2">Connectez-vous pour accéder à la boutique interne</p>
    </div>

    @if(session('status'))
        <div class="bg-green-50 border border-green-100 text-green-700 p-3 rounded mb-4">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
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
            <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="w-full px-4 py-3 rounded-lg border border-slate-200 bg-white focus:ring-2 focus:ring-indigo-500"/>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Mot de passe</label>
            <input type="password" name="password" required
                   class="w-full px-4 py-3 rounded-lg border border-slate-200 bg-white focus:ring-2 focus:ring-indigo-500"/>
        </div>

        <div class="flex items-center justify-between">
            <label class="inline-flex items-center gap-2 text-sm">
                <input type="checkbox" name="remember" class="rounded border-slate-200" />
                <span class="text-sm text-slate-600">Se souvenir de moi</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">Mot de passe oublié ?</a>
            @endif
        </div>

        <button type="submit" class="w-full px-4 py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700">Se connecter</button>

        <p class="text-center text-sm text-slate-500">Pas encore de compte ? <a href="{{ route('register') }}" class="text-indigo-600 font-semibold">S'inscrire</a></p>
    </form>
</div>
@endsection
