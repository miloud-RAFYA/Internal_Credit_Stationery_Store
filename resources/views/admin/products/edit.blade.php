@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <a href="{{ route('admin.products.index') }}" class="text-slate-400 hover:text-indigo-600 font-bold text-sm flex items-center gap-2 mb-6">
        ← Retour au catalogue
    </a>

    <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 overflow-hidden">
        <div class="p-10 border-b border-slate-50 bg-slate-50/50">
            <h1 class="text-3xl font-black tracking-tighter">Modifier l'article</h1>
            <p class="text-slate-500">ID du produit : #{{ $product->id }}</p>
        </div>

        <form action="{{ route('admin.products.update', $product) }}" method="POST" class="p-10 space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-1">Nom de l'article</label>
                    <input type="text" name="name" value="{{ $product->name }}" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-transparent focus:border-indigo-500 focus:bg-white transition-all font-bold">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-1">Prix (Tokens)</label>
                    <input type="number" name="price_tokens" value="{{ $product->price_tokens }}" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-transparent focus:border-indigo-500 focus:bg-white transition-all font-black text-indigo-600">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-1">Stock Actuel</label>
                    <input type="number" name="stock" value="{{ $product->stock }}" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-transparent focus:border-indigo-500 focus:bg-white transition-all font-bold">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-1">Catégorie</label>
                    <select name="category_id" class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-2 border-transparent focus:border-indigo-500 focus:bg-white transition-all font-bold appearance-none">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="p-6 rounded-3xl border-2 {{ $product->is_premium ? 'border-purple-200 bg-purple-50' : 'border-slate-100 bg-slate-50' }} flex items-center justify-between transition-colors">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center shadow-sm text-xl">✨</div>
                    <div>
                        <p class="font-black text-slate-800">Statut Premium</p>
                        <p class="text-xs text-slate-500">Nécessite une validation Manager si activé</p>
                    </div>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_premium" value="1" class="sr-only peer" {{ $product->is_premium ? 'checked' : '' }}>
                    <div class="w-14 h-7 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-600"></div>
                </label>
            </div>

            <button type="submit" class="w-full py-5 bg-indigo-600 text-white rounded-2xl font-black uppercase tracking-widest hover:bg-indigo-700 shadow-xl shadow-indigo-100 transition-all">
                Mettre à jour l'inventaire
            </button>
        </form>
    </div>
</div>
@endsection