<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard – Stationery Pro</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 to-slate-100 text-slate-800">

<!-- ================= NAVBAR ================= -->
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
                <!-- <button onclick="toggleModal('modal-product')"
                    class="hidden sm:flex items-center gap-2 px-5 py-2.5 rounded-xl bg-indigo-600 text-white font-semibold shadow-lg hover:bg-indigo-700 transition">
                    + Nouveau
                </button> -->

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

<!-- ================= MAIN ================= -->
<main class="max-w-7xl mx-auto px-6 py-10">

    <!-- Header -->
    <div class="mb-10">
        <h1 class="text-4xl font-extrabold tracking-tight">Tableau de bord</h1>
        <p class="text-slate-500 mt-1">Vue générale de votre boutique</p>
    </div>

    <!-- ================= STATS ================= -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">

        <!-- Card -->
        <div class="bg-white/80 backdrop-blur rounded-3xl p-6 shadow hover:shadow-lg transition flex items-center gap-5">
            <div class="p-4 rounded-2xl bg-indigo-100 text-indigo-600">
                📦
            </div>
            <div>
                <p class="text-xs uppercase font-bold text-slate-400">Produits</p>
                <p class="text-3xl font-extrabold">{{ $stats['total_products'] }}</p>
            </div>
        </div>

        <div class="bg-white/80 backdrop-blur rounded-3xl p-6 shadow hover:shadow-lg transition flex items-center gap-5">
            <div class="p-4 rounded-2xl bg-emerald-100 text-emerald-600">
                💰
            </div>
            <div>
                <p class="text-xs uppercase font-bold text-slate-400">Tokens</p>
                <p class="text-3xl font-extrabold">
                    {{ number_format($stats['total_tokens'] ?? 0, 0, ',', ' ') }}
                    <span class="text-sm text-slate-400">TK</span>
                </p>
            </div>
        </div>

        <div class="bg-white/80 backdrop-blur rounded-3xl p-6 shadow hover:shadow-lg transition flex items-center gap-5">
            <div class="p-4 rounded-2xl bg-amber-100 text-amber-600">
                👥
            </div>
            <div>
                <p class="text-xs uppercase font-bold text-slate-400">Utilisateurs</p>
                <p class="text-3xl font-extrabold">{{ $stats['total_users'] }}</p>
            </div>
        </div>

    </div>

    <!-- ================= TABLE ================= -->
    <div class="bg-white rounded-[2.5rem] shadow-xl overflow-hidden">
        <div class="p-8 border-b flex justify-between items-center">
            <h2 class="text-xl font-extrabold">Transactions récentes</h2>
            <span class="text-sm text-slate-500">30 derniers jours</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-400 uppercase text-xs">
                    <tr>
                        <th class="px-8 py-4 text-left">ID</th>
                        <th class="px-8 py-4 text-left">Client</th>
                        <th class="px-8 py-4 text-center">Date</th>
                        <th class="px-8 py-4 text-right">Montant</th>
                        <th class="px-8 py-4 text-center">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($orders as $order)
                    <tr class="hover:bg-indigo-50/40 transition">
                        <td class="px-8 py-5 font-bold">#CMD-{{ $order->id }}</td>
                        <td class="px-8 py-5 font-semibold">{{ $order->user->name }}</td>
                        <td class="px-8 py-5 text-center text-slate-500">
                            {{ $order->created_at->format('d M Y') }}
                        </td>
                        <td class="px-8 py-5 text-right font-extrabold text-indigo-600">
                            {{ $order->montant_tokens }} TK
                        </td>
                        <td class="px-8 py-5 text-center">
                            <span class="px-4 py-1 rounded-full text-xs font-bold
                                @if($order->status=='approuve') bg-emerald-100 text-emerald-600
                                @elseif($order->status=='rejetee') bg-rose-100 text-rose-600
                                @elseif($order->status=='recue') bg-blue-100 text-blue-600
                                @else bg-amber-100 text-amber-600 @endif">
                                {{ strtoupper(str_replace('_',' ',$order->status)) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</main>

<!-- ================= MODAL ================= -->
<div id="modal-product"
     class="fixed inset-0 bg-black/60 backdrop-blur hidden items-center justify-center z-50">
    <div class="bg-white rounded-3xl p-8 w-full max-w-md shadow-2xl">
        <div class="flex justify-between mb-6">
            <h3 class="text-xl font-extrabold">Nouveau produit</h3>
            <button onclick="toggleModal('modal-product')" class="text-slate-400">✕</button>
        </div>

        <form class="space-y-4">
            <input class="w-full p-4 rounded-xl bg-slate-50 focus:ring-2 focus:ring-indigo-500 outline-none"
                   placeholder="Nom du produit">
            <div class="grid grid-cols-2 gap-4">
                <input type="number" placeholder="Prix TK" class="p-4 rounded-xl bg-slate-50">
                <input type="number" placeholder="Stock" class="p-4 rounded-xl bg-slate-50">
            </div>
            <button class="w-full py-4 rounded-xl bg-indigo-600 text-white font-bold hover:bg-indigo-700 transition">
                Enregistrer
            </button>
        </form>
    </div>
</div>

<script>
function toggleModal(id) {
    const modal = document.getElementById(id);
    modal.classList.toggle('hidden');
    modal.classList.toggle('flex');
}
</script>

</body>
</html>
