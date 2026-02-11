@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 min-h-screen pb-24 font-sans">
        <div class="max-w-7xl mx-auto px-4 py-6">

            {{-- Header --}}
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Votre Panier</h1>
                <div id="user-tokens"
                    class="px-6 py-3 bg-white border border-gray-200 rounded-xl font-bold text-indigo-600">
                    Solde: <span class="token-value">1000</span> TK
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- Cart items --}}
                <div class="lg:col-span-8">
                    <div class="space-y-4" id="cart-items-container"></div>
                </div>

                {{-- Resume --}}
                <div class="lg:col-span-4">
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 sticky top-6">
                        <h2 class="text-xl font-bold mb-6 text-gray-900">Résumé</h2>

                        <div class="flex justify-between font-bold text-gray-900 text-lg border-t pt-4">
                            <span>Total</span>
                            <span class="text-2xl font-black text-red-600">
                                <span id="grand-total">0</span> TK
                            </span>
                        </div>

                        <form method="POST" action="{{ route('commande.store') }}" id="checkout-form">
                            @csrf
                            <input type="hidden" name="produits" id="produits-input">

                            <button id="checkout-btn" type="submit" class="w-full flex items-center justify-center gap-3
                                    bg-indigo-600 hover:bg-indigo-700
                                    text-white mt-8 py-4 rounded-2xl
                                    font-bold text-lg
                                    shadow-md hover:shadow-xl
                                    transition-all duration-300
                                    disabled:opacity-40 disabled:cursor-not-allowed">
                                <span>Confirmer la commande</span>
                                <span class="text-xl">✔️</span>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const currentUserId = {{ auth()->id() }};
        const initialTokens = parseInt(document.querySelector('.token-value').textContent);

        function getCurrentAvailableTokens() {
            return parseInt(document.querySelector('.token-value').textContent);
        }

        function renderCart() {
            const container = document.getElementById('cart-items-container');
            const panier = JSON.parse(localStorage.getItem('mon_panier')) || [];
            const userPanier = panier.filter(item => item.idUser === currentUserId);

            let total = 0;
            container.innerHTML = '';

            if (userPanier.length === 0) {
                container.innerHTML = `
                    <div class="bg-white p-10 rounded-xl text-center">
                        Panier vide
                    </div>`;
                document.getElementById('grand-total').textContent = '0';
                updateTokenDisplay(0);
                return;
            }

            userPanier.forEach(item => {
                const itemTotal = item.prixTokens * item.qte;
                total += itemTotal;

                container.innerHTML += `
                <div class="bg-white rounded-xl p-4 flex gap-4 shadow-sm border border-gray-100">
                    <div class="w-24 h-24 bg-gray-50 rounded-lg overflow-hidden">
                        <img src="${item.image || '#'}" class="w-full h-full object-cover">
                    </div>

                    <div class="flex-1">
                        <div class="flex justify-between">
                            <h3 class="font-bold text-gray-800">${item.nom}</h3>
                            <button onclick="removeItem('${item.idProduit}')"
                                class="text-gray-400 hover:text-red-500">✕</button>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <span class="text-lg font-bold text-indigo-600">${item.prixTokens} TK</span>

                            <div class="flex items-center border rounded-lg">
                                <button onclick="updateQty('${item.idProduit}', -1)" class="px-3 py-1">-</button>
                                <span class="px-4 font-bold">${item.qte}</span>
                                <button onclick="updateQty('${item.idProduit}', 1)"
                                    class="px-3 py-1 text-indigo-600">+</button>
                            </div>
                        </div>
                    </div>
                </div>`;
            });

            document.getElementById('grand-total').textContent = total.toFixed(0);
            updateTokenDisplay(total);
        }

        function updateTokenDisplay(spent) {
            const remaining = initialTokens - spent;
            document.querySelector('.token-value').textContent = remaining.toFixed(0);
        }

        window.updateQty = function (id, change) {
            let panier = JSON.parse(localStorage.getItem('mon_panier')) || [];
            const index = panier.findIndex(
                item => item.idProduit === id && item.idUser === currentUserId
            );

            if (index > -1) {
                const prixProduit = panier[index].prixTokens;
                const available = getCurrentAvailableTokens();

                if (change > 0 && prixProduit > available) {
                    alert('Tokens insuffisants !');
                    return;
                }

                if (panier[index].qte + change > 0) {
                    panier[index].qte += change;
                    localStorage.setItem('mon_panier', JSON.stringify(panier));
                    renderCart();
                }
            }
        }

        window.removeItem = function (id) {
            let panier = JSON.parse(localStorage.getItem('mon_panier')) || [];
            panier = panier.filter(
                item => !(item.idProduit === id && item.idUser === currentUserId)
            );
            localStorage.setItem('mon_panier', JSON.stringify(panier));
            renderCart();
        }

        document.getElementById('checkout-form').addEventListener('submit', function (e) {

            const panier = JSON.parse(localStorage.getItem('mon_panier')) || [];
            const userPanier = panier.filter(item => item.idUser === currentUserId);

            if (userPanier.length === 0) {
                e.preventDefault();
                alert('Panier vide');
                return;
            }

            const produits = userPanier.map(item => ({
                produit_id: item.idProduit,
                qte: item.qte,
                prix_tokens: item.prixTokens,
                total_ligne: item.prixTokens * item.qte,
                prix_unitaire : item.prixTokens,
            }));


            document.getElementById('produits-input').value = JSON.stringify(produits);

            // اختياري: تفريغ السلة
            // localStorage.removeItem('mon_panier');
        });

        document.addEventListener('DOMContentLoaded', renderCart);
    </script>
@endsection