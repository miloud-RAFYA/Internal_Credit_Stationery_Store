@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto py-12 px-4">
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
        <div class="p-8 border-b border-slate-100 flex items-center justify-between">
            <h1 class="text-2xl font-black italic uppercase tracking-tighter text-slate-800">Nouveau Produit</h1>
            <a href="{{ route('products.index') }}" class="text-sm text-slate-500 hover:underline">Retour aux produits</a>
        </div>

        <div class="p-8">
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-lg">
                    <p class="font-bold text-red-700">Veuillez corriger les erreurs suivantes :</p>
                    <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="text-xs font-black uppercase text-slate-400 ml-1">Nom de l'article</label>
                    <input type="text" name="nom" required value="{{ old('nom') }}" class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 font-medium" placeholder="ex: Cahier Oxford A4">
                    @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-xs font-black uppercase text-slate-400 ml-1">Description</label>
                    <textarea name="description" rows="5" class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 font-medium" placeholder="Courte description du produit">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-black uppercase text-slate-400 ml-1">Prix (Tokens)</label>
                        <input type="number" name="prix_tokens" required min="0" step="1" value="{{ old('prix_tokens') }}" class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 font-black text-indigo-600" placeholder="50">
                        @error('prix_tokens') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="text-xs font-black uppercase text-slate-400 ml-1">Stock Initial</label>
                        <input type="number" name="stock" required min="0" step="1" value="{{ old('stock', 0) }}" class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 font-bold" placeholder="100">
                        @error('stock') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="text-xs font-black uppercase text-slate-400 ml-1">Image (optionnelle)</label>
                    <input type="file" name="image_produit" accept="image/*" class="w-full text-sm text-slate-600">
                    @error('image_produit') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="bg-indigo-50 p-6 rounded-3xl flex items-center justify-between border border-indigo-100">
                    <div>
                        <p class="font-bold text-indigo-900">Article Premium ?</p>
                        <p class="text-xs text-indigo-600">Nécessite l'approbation d'un manager</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="est_premuim" value="1" class="sr-only peer" {{ old('est_premuim') ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                    </label>
                </div>

                <div>
                    <button type="submit" class="w-full py-5 bg-slate-900 text-white rounded-2xl font-black uppercase tracking-widest hover:bg-slate-800 shadow-xl shadow-slate-200 transition-all">
                        Enregistrer en inventaire
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection