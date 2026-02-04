<!-- resources/views/admin/utilisateurs_dashboard.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin – Utilisateurs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-50 text-slate-800">

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
                <button onclick="toggleModal('modal-ajouter-user')"
                class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">+ Ajouter Utilisateur</button>

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

<main class="max-w-7xl mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-4">Liste des utilisateurs</h1>
    <p class="text-slate-500 mb-6">Gérer tous les utilisateurs et leurs informations</p>

    <!-- Table Utilisateurs -->
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
                    <td class="px-6 py-4 font-semibold">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4 text-center">{{ $user->employe->departement->nom ?? '-' }}</td>
                    <td class="px-6 py-4 text-center">{{ $user->employe->token ?? 0 }}</td>
                    <td class="px-6 py-4 text-center flex justify-center gap-2">
                        <!-- Consulter -->
                        <a href="{{ route('admin.utilisateur.show', $user->id) }}"
                           class="px-3 py-1 bg-slate-100 text-slate-700 rounded hover:bg-slate-200">Voir</a>
                        <!-- Modifier -->
                        <button onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', {{ $user->employe->token ?? 0 }})"
                                class="px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">Modifier</button>
                        <!-- Supprimer -->
                        <form action="{{ route('admin.utilisateur.delete', $user->id) }}" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-rose-100 text-rose-700 rounded hover:bg-rose-200">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</main>

<!-- ================= MODAL Ajouter Utilisateur ================= -->
<div id="modal-ajouter-user" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold">Ajouter Utilisateur</h2>
            <button onclick="toggleModal('modal-ajouter-user')" class="text-slate-500">✕</button>
        </div>
        <form action="" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nom" class="w-full p-3 mb-3 rounded border border-slate-200">
            <input type="email" name="email" placeholder="Email" class="w-full p-3 mb-3 rounded border border-slate-200">
            <input type="number" name="token" placeholder="Tokens" class="w-full p-3 mb-3 rounded border border-slate-200">
            
            <select name="departement_id" class="w-full p-3 mb-3 rounded border border-slate-200">
                <option value="">Choisir Département</option>
                @foreach(App\Models\Departement::all() as $dep)
                    <option value="{{ $dep->id }}">{{ $dep->nom }}</option>
                @endforeach
            </select>

            <!-- Nouveau: Role -->
            <select name="role" class="w-full p-3 mb-3 rounded border border-slate-200">
                <option value="">Choisir Rôle</option>
                <!-- <option value="admin">Admin</option> -->
                <option value="employe">Employé</option>
                <option value="manager">Manager</option>
            </select>

            <button type="submit" class="w-full bg-indigo-600 text-white p-3 rounded hover:bg-indigo-700">Enregistrer</button>
        </form>
    </div>
</div>

<!-- ================= MODAL Modifier Utilisateur ================= -->
<div id="modal-edit-user" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold">Modifier Utilisateur</h2>
            <button onclick="toggleModal('modal-edit-user')" class="text-slate-500">✕</button>
        </div>
        <form id="edit-user-form" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="name" id="edit-name" placeholder="Nom" class="w-full p-3 mb-3 rounded border border-slate-200">
            <input type="email" name="email" id="edit-email" placeholder="Email" class="w-full p-3 mb-3 rounded border border-slate-200">
            <input type="number" name="token" id="edit-token" placeholder="Tokens" class="w-full p-3 mb-3 rounded border border-slate-200">
            
            <select name="departement_id" id="edit-departement" class="w-full p-3 mb-3 rounded border border-slate-200">
                <option value="">Choisir Département</option>
                @foreach(App\Models\Departement::all() as $dep)
                    <option value="{{ $dep->id }}">{{ $dep->nom }}</option>
                @endforeach
            </select>

            <!-- Nouveau: Role -->
            <select name="role" id="edit-role" class="w-full p-3 mb-3 rounded border border-slate-200">
                <option value="">Choisir Rôle</option>
                <!-- <option value="admin">Admin</option> -->
                <option value="employe">Employé</option>
                <option value="manager">Manager</option>
            </select>

            <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded hover:bg-blue-700">Mettre à jour</button>
        </form>
    </div>
</div>

<script>
function openEditModal(id, name, email, token, departement_id, role) {
    toggleModal('modal-edit-user');
    document.getElementById('edit-name').value = name;
    document.getElementById('edit-email').value = email;
    document.getElementById('edit-token').value = token;
    document.getElementById('edit-departement').value = departement_id;
    document.getElementById('edit-role').value = role;
    document.getElementById('edit-user-form').action = '/admin/utilisateurs/' + id; // route PUT
}
</script>

<script>
function toggleModal(id) {
    const modal = document.getElementById(id);
    modal.classList.toggle('hidden');
    modal.classList.toggle('flex');
}
</script>

</body>
</html>
