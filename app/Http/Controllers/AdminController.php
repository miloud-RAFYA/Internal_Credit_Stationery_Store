<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\User;
use App\Models\Manager;
use App\Models\Commande;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'totalProduits' => Produit::count(),
            'totalUsers' => User::whereRelation('role', 'nom', '!=', 'admin')->count(),
            'totalTokens' => Manager::sum('token'),
        ];

        $commandes = Commande::latest()->paginate(5);
        return view('admin/finance/dashboard', compact('stats', 'commandes'));
    }

    // public function showProduits()
    // {
    //     $produits = Produit::latest()->get(); 
    //     return view('admin/produits', compact('produits'));
    // }

    public function showUtilisateurs()
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
    public function reports(){
        return view('admin.finance.reports');
    }
}
