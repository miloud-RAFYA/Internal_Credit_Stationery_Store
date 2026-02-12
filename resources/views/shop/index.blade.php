@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-4xl font-bold text-slate-900">Boutique</h1>
            <p class="text-slate-500 mt-2">Découvrez nos fournitures de bureau</p>
        </div>

        <div class="flex items-center gap-4">
            @php
                $userToken = auth()->user()->role->nom === 'Employee' 
                    ? auth()->user()->employe->token 
                    : auth()->user()->manager->token;
            @endphp

            <div id="user-tokens"
                 class="px-6 py-3 bg-indigo-100 text-indigo-700 rounded-lg font-bold"
                 data-initial="{{ $userToken }}">
                <span class="token-value">{{ $userToken }}</span> TK
            </div>

            <a href="{{ route('shop.cart') }}"
               class="relative px-6 py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700">
                🛒 Mon panier
                <span id="cart-badge"
                      class="hidden absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full border-2 border-white">
                    0
                </span>
            </a>
        </div>
    </div>

    <div class="flex gap-3 mb-6">
        <input type="text" placeholder="Rechercher..." class="flex-1 px-4 py-2 border border-slate-200 rounded-lg">
        <select class="px-4 py-2 border border-slate-200 rounded-lg bg-white">
            <option>Toutes les catégories</option>
        </select>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($produits as $product)
            <div class="carte-produit bg-white rounded-lg shadow border border-slate-100 hover:shadow-lg transition overflow-hidden"
                 data-id="{{ $product->id }}">
                <div class="h-48 bg-slate-100 flex items-center justify-center">
                    @if($product->image_produit)
                        <img src="{{ Storage::url($product->image_produit) }}" alt="{{ $product->nom }}"
                             class="w-full h-full object-cover">
                    @else
                        <span class="text-4xl">📦</span>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="nom-produit font-bold text-slate-900">{{ $product->nom }}</h3>
                    <p class="nom-description text-sm text-slate-500 mt-1 line-clamp-2">{{ $product->description }}</p>

                    <div class="flex items-center justify-between mt-4">
                        <p class="text-xl font-bold text-indigo-600"><span class="prix-tokens">{{ $product->prix_tokens }}</span> TK</p>
                        <button class="add-produit px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700">
                            Ajouter
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    const currentUserId = {{ auth()->id() }};

    function updateUI() {
        const panier = JSON.parse(localStorage.getItem('mon_panier')) || [];
        const userPanier = panier.filter(item => item.idUser === currentUserId);

        const badge = document.getElementById('cart-badge');
        const totalQty = userPanier.reduce((acc, item) => acc + item.qte, 0);
        if (totalQty > 0) {
            badge.textContent = totalQty;
            badge.classList.remove('hidden');
        } else {
            badge.classList.add('hidden');
        }

        const tokenContainer = document.getElementById('user-tokens');
        const initialTokens = parseFloat(tokenContainer.dataset.initial);
        const totalSpent = userPanier.reduce((acc, item) => acc + (item.prixTokens * item.qte), 0);
        tokenContainer.querySelector('.token-value').textContent = (initialTokens - totalSpent).toFixed(0);
    }

    document.querySelectorAll('.add-produit').forEach(btn => {
        btn.addEventListener('click', function () {
            const card = btn.closest('.carte-produit');
            const id = card.dataset.id;
            const prix = parseFloat(card.querySelector('.prix-tokens').textContent);
            const currentAvailable = parseFloat(document.querySelector('.token-value').textContent);

            if (prix > currentAvailable) {
                alert("Tokens insuffisants !");
                return;
            }

            let panier = JSON.parse(localStorage.getItem('mon_panier')) || [];
            const index = panier.findIndex(item => item.idProduit === id && item.idUser === currentUserId);

            if (index > -1) {
                panier[index].qte += 1;
            } else {
                panier.push({
                    idProduit: id,
                    idUser: currentUserId,
                    nom: card.querySelector('.nom-produit').textContent.trim(),
                    image: card.querySelector('img')?.src || null,
                    prixTokens: prix,
                    qte: 1
                });
            }

            localStorage.setItem('mon_panier', JSON.stringify(panier));
            updateUI();
        });
    });

    document.addEventListener('DOMContentLoaded', updateUI);
</script>
@endsection
