<<<<<<< HEAD

<nav class="bg-gradient-to-r from-indigo-600 to-indigo-800 shadow-lg text-white sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}" class="text-2xl font-bold tracking-wider hover:text-indigo-200 transition flex items-center gap-2">
                    🏪 <span>CREDIT STORE</span>
                </a>
            </div>

            <!-- Menu Desktop -->
            <div class="hidden sm:flex sm:items-center sm:space-x-1">
                <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition duration-200">
                    📊 Dashboard
                </a>
                <a href="admin/products" class="px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition duration-200">
                    🛍️ Produits
                </a>
                <a href="#" class="px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition duration-200">
                    📋 Commandes
                </a>

                {{-- @if(auth()->user())
                    @if(auth()->user()->role_id && auth()->user()->role->nom === 'admin')
                        <a href="#" class="px-4 py-2 rounded-md text-sm font-medium bg-indigo-900 hover:bg-indigo-950 border border-indigo-400 transition duration-200">
                            ⚙️ Admin
                        </a>
                    @elseif(auth()->user()->role_id && auth()->user()->role->nom === 'manager')
                        <a href="{{ route('manager.index') }}" class="px-4 py-2 rounded-md text-sm font-medium bg-indigo-900 hover:bg-indigo-950 border border-indigo-400 transition duration-200">
                            📈 Manager
                        </a>
                    @endif
                @endif --}}
            </div>

            <!-- User Dropdown + Mobile Menu Toggle -->
            <div class="flex items-center space-x-4">
                @if(auth()->user())
                    <div class="relative group">
                        <button class="flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-indigo-700 transition duration-200">
                            <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </button>
                        <div class="absolute right-0 w-48 bg-white text-slate-800 rounded-lg shadow-lg hidden group-hover:block mt-0">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-slate-100 rounded-t-lg">👤 Profil</a>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-slate-100 rounded-b-lg text-red-600 font-semibold">🚪 Déconnexion</button>
                            </form>
                        </div>
                    </div>
                @endif

                <!-- Mobile Menu Toggle -->
                <button class="sm:hidden text-white hover:text-indigo-200 focus:outline-none" onclick="toggleMobileMenu()">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="sm:hidden hidden pb-4 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition">📊 Dashboard</a>
            <a href="#" class="block px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition">🛍️ Produits</a>
            <a href="#" class="block px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition">📋 Commandes</a>
            {{-- @if(auth()->user() && auth()->user()->role_id && auth()->user()->role->name === 'admin')
                <a href="#" class="block px-4 py-2 rounded-md text-sm font-medium bg-indigo-900 hover:bg-indigo-950 transition">⚙️ Admin</a>
            @endif --}}
        </div>
    </div>
</nav>

<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
}
</script>
=======
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
>>>>>>> 85f33ff8ff9a0d8dd049fac2413b2feeb44ce5ab
