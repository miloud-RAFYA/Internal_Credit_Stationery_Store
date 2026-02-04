<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits – Admin Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>

<body class="bg-gray-100 text-gray-800">

<!-- NAVBAR -->
<nav class="sticky top-0 z-40 backdrop-blur-xl bg-white/80 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center h-20">

            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-500 to-purple-600 text-white font-black flex items-center justify-center shadow-lg">
                    S
                </div>
                <span class="text-xl font-extrabold tracking-tight">
                    Stationery<span class="text-indigo-600">Pro</span>
                </span>
            </div>

            <!-- Menu -->
            <div class="hidden md:flex gap-6 text-sm">
                <a class="text-blue-600 font-medium hover:text-gray-900" href="dashboard">Dashboard</a>
                <a class="text-blue-600 font-medium hover:text-gray-900 " href="produits">Produits</a>
                <a class="text-blue-600 font-medium hover:text-gray-900" href="utilisateurs">Utilisateurs</a>
                <a class="text-blue-600 font-medium hover:text-gray-900">Finance</a>
            </div>

            <!-- Profile -->
            <div class="flex items-center gap-4">
                <button onclick="toggleModal('modal-add')" class="px-4 py-2 rounded bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition">
                    + Ajouter Produit
                </button>

                <div class="flex items-center gap-3 border-l pl-4">
                    <div class="hidden sm:block text-right">
                        <p class="text-sm font-bold">Morad Benaissa</p>
                        <p class="text-xs text-indigo-600 font-semibold uppercase">Admin</p>
                    </div>
                    <img class="w-10 h-10 rounded-full ring-2 ring-indigo-500"
                        src="https://ui-avatars.com/api/?name=Morad+Benaissa&background=6366f1&color=fff">
                </div>
            </div>

        </div>
    </div>
</nav>

<!-- MAIN -->
<main class="max-w-7xl mx-auto px-6 py-8">

    <h1 class="text-2xl font-semibold mb-4">Liste des Produits</h1>

    <div class="bg-white border shadow overflow-x-auto rounded">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3 text-left">ID</th>
                    <th class="px-6 py-3 text-left">Nom</th>
                    <th class="px-6 py-3 text-right">Prix (Tokens)</th>
                    <th class="px-6 py-3 text-right">Stock</th>
                    <th class="px-6 py-3 text-left">Premium</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($produits as $produit)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-3">{{ $produit->id }}</td>
                    <td class="px-6 py-3">{{ $produit->nom }}</td>
                    <td class="px-6 py-3 text-right">{{ $produit->prix_tokens }} TK</td>
                    <td class="px-6 py-3 text-right">{{ $produit->stock }}</td>
                    <td class="px-6 py-3">{{ $produit->est_premium ? 'Oui' : 'Non' }}</td>
                    <td class="px-6 py-3 flex gap-2">
                        <a href="{{ route('produits.show', $produit->id) }}" class="px-2 py-1 text-xs bg-gray-200 rounded hover:bg-gray-300">Consulter</a>
                        <a href="{{ route('produits.edit', $produit->id) }}" class="px-2 py-1 text-xs bg-blue-200 text-blue-800 rounded hover:bg-blue-300">Modifier</a>
                        <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 text-xs bg-red-200 text-red-800 rounded hover:bg-red-300">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</main>

<!-- MODAL AJOUTER PRODUIT -->
<div id="modal-add" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
        <div class="flex justify-between mb-4">
            <h3 class="font-semibold text-lg">Ajouter un produit</h3>
            <button onclick="toggleModal('modal-add')" class="text-gray-500">✕</button>
        </div>
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-3">
            @csrf
            <input type="text" name="nom" placeholder="Nom du produit" class="w-full p-2 border rounded" required>
            <input type="number" name="prix_tokens" placeholder="Prix en Tokens" class="w-full p-2 border rounded" required>
            <input type="number" name="stock" placeholder="Stock" class="w-full p-2 border rounded" required>
            <textarea name="description" placeholder="Description" class="w-full p-2 border rounded"></textarea>
            <input type="file" name="image_produit" class="w-full p-2 border rounded">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="est_premium">
                Produit Premium
            </label>
            <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Enregistrer</button>
        </form>
    </div>
</div>

<script>
function toggleModal(id){
    const modal = document.getElementById(id);
    modal.classList.toggle('hidden');
    modal.classList.toggle('flex');
}
</script>

</body>
</html>
