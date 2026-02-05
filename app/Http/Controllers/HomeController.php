<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\User;
use App\Models\Manager;
use App\Models\Commande;

class HomeController extends Controller
{
    public function adminDashboard()
    {
        $stats = [
            'total_products' => Produit::count(),
            'total_users' => Manager::count(),
            'total_tokens' => Manager::sum('token'),
            'low_stock_count' => Produit::where('stock', '<', 5)->count(),
        ];

        $commandes = Commande::all();
            
        return view('admin.dashboard', compact('stats', 'commandes'));
    }

    public function showProduitsInAdminDashboard()
    {
        
        $produits = Produit::latest()->get(); 
        return view('admin/produits', compact('produits'));
    }

    public function showUtilisateurInAdminDashboard()
    {
        $utilisateurs = User::with('employe')->get(); 

        $stats = [
            'total_users' => $utilisateurs->count(),
            'total_tokens' => $utilisateurs->sum(function($user) {
                return $user->employe->token ?? 0;
            }),
        ];

        return view('admin.utilisateurs', compact('utilisateurs', 'stats'));
    }
}
