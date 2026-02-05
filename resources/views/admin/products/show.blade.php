@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-slate-100 text-center">
            <div class="w-24 h-24 bg-slate-50 rounded-3xl flex items-center justify-center text-4xl mx-auto mb-4 shadow-inner">
                {{ $product->emoji ?? '📦' }}
            </div>
            <h1 class="text-2xl font-black text-slate-800">{{ $product->name }}</h1>
            <p class="text-indigo-600 font-bold mb-6">{{ $product->category->name }}</p>
            
            <div class="flex justify-center gap-2 mb-8">
                @if($product->is_premium)
                    <span class="bg-purple-100 text-purple-700 px-4 py-1 rounded-full text-[10px] font-black uppercase">Premium</span>
                @endif
                <span class="bg-slate-100 text-slate-600 px-4 py-1 rounded-full text-[10px] font-black uppercase">ID: #{{ $product->id }}</span>
            </div>

            <div class="grid grid-cols-2 gap-4 border-t pt-8">
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase">Prix</p>
                    <p class="text-xl font-black text-indigo-600">{{ $product->price_tokens }} TK</p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase">Stock</p>
                    <p class="text-xl font-black {{ $product->stock < 10 ? 'text-red-500' : 'text-slate-800' }}">{{ $product->stock }}</p>
                </div>
            </div>
        </div>

        <a href="{{ route('admin.products.edit', $product) }}" class="block w-full py-4 bg-slate-900 text-white rounded-2xl text-center font-bold hover:bg-slate-800 transition">
            Modifier l'article
        </a>
    </div>

    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-slate-100">
            <h2 class="text-xl font-black mb-6">Historique des Commandes</h2>
            
            <div class="space-y-4">
                @forelse($product->orders as $order)
                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl hover:bg-indigo-50 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-sm font-bold text-xs text-slate-400">
                            {{ $loop->iteration }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800">{{ $order->user->name }}</p>
                            <p class="text-[10px] text-slate-400 font-medium">{{ $order->created_at->format('d M Y à H:i') }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-black text-slate-700">x{{ $order->pivot->quantity ?? 1 }}</p>
                        <p class="text-[10px] font-bold text-indigo-500">{{ $order->total_tokens }} TK</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-10">
                    <p class="text-slate-400 italic">Aucune commande pour le moment.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection