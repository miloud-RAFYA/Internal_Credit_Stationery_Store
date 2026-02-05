<nav class="bg-blue-700 shadow-lg text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <div class="flex-shrink-0 flex items-center">
                <a href="/dashboard" class="text-xl font-bold tracking-wider hover:text-blue-200 transition">
                    TOKEN <span class="font-light text-blue-300">STORE</span>
                </a>
            </div>

            <div class="hidden sm:flex sm:items-center sm:space-x-8">
                <a href="/dashboard" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-600 transition">Dashboard</a>
                <a href="/products" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-600 transition">Produits</a>
                <a href="/orders" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-600 transition">Commandes</a>

                @if(auth()->user() && auth()->user()->role == 'admin')
                    <a href="/admin/products" class="px-3 py-2 rounded-md text-sm font-medium bg-blue-800 hover:bg-blue-900 border border-blue-400 transition">
                        🛠 Admin
                    </a>
                @endif

                <form method="POST" action="/logout" class="inline">
                    @csrf
                    <button type="submit" class="ml-4 px-4 py-2 bg-red-500 hover:bg-red-600 rounded-lg text-sm font-semibold transition shadow-sm">
                        Déconnexion
                    </button>
                </form>
            </div>

            <div class="sm:hidden flex items-center">
                <button class="text-white hover:text-blue-200 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>