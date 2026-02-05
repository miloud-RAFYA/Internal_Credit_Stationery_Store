<div id="modal-add-product" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-[2.5rem] w-full max-w-lg shadow-2xl overflow-hidden transform transition-all">
        <div class="p-8 border-b border-slate-100 flex justify-between items-center">
            <h3 class="text-2xl font-black italic uppercase tracking-tighter text-slate-800">Nouveau Produit</h3>
            <button onclick="toggleModal('modal-add-product')" class="w-10 h-10 rounded-full hover:bg-slate-100 flex items-center justify-center text-slate-400 transition">✕</button>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" class="p-8 space-y-6">
            @csrf
            
            <div class="space-y-2">
                <label class="text-xs font-black uppercase text-slate-400 ml-1">Nom de l'article</label>
                <input type="text" name="name" required class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 font-medium" placeholder="ex: Cahier Oxford A4">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-xs font-black uppercase text-slate-400 ml-1">Prix (Tokens)</label>
                    <input type="number" name="price_tokens" required class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 font-black text-indigo-600" placeholder="50">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-black uppercase text-slate-400 ml-1">Stock Initial</label>
                    <input type="number" name="stock" required class="w-full px-5 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-indigo-500 font-bold" placeholder="100">
                </div>
            </div>

            <div class="bg-indigo-50 p-6 rounded-3xl flex items-center justify-between border border-indigo-100">
                <div>
                    <p class="font-bold text-indigo-900">Article Premium ?</p>
                    <p class="text-xs text-indigo-600">Nécessite l'approbation d'un manager</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_premium" value="1" class="sr-only peer">
                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                </label>
            </div>

            <button type="submit" class="w-full py-5 bg-slate-900 text-white rounded-2xl font-black uppercase tracking-widest hover:bg-slate-800 shadow-xl shadow-slate-200 transition-all">
                Enregistrer en inventaire
            </button>
        </form>
    </div>
</div>