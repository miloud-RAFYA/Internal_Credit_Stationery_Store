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
                <a class="text-blue-600 font-medium hover:text-gray-900" href="{{route('admin.dashboard')}}">Dashboard</a>
                <a class="text-blue-600 font-medium hover:text-gray-900 " href="{{route('products.index')}}">Produits</a>
                <a class="text-blue-600 font-medium hover:text-gray-900" href="{{route('admin.utilisateurs.index')}}">Utilisateurs</a>
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
                        <p class="text-sm font-bold">{{ auth()->user()->nom }}</p>
                        <p class="text-xs text-indigo-600 font-semibold uppercase">{{ auth()->user()->role->nom }}</p>
                    </div>
                    <img class="w-10 h-10 rounded-full ring-2 ring-indigo-500"
                        src="https://ui-avatars.com/api/?name=Morad+Benaissa&background=6366f1&color=fff">
                </div>
            </div>

        </div>  
    </div>
</nav>
