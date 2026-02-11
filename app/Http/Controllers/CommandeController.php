<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\LigneCommande;
use App\Notifications\NouvelleCommandePremium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        
        // Get manager's department
        $user = Auth::user();
        if ($user->role_id === 3) { // Manager role
            $departement = $user->manager->departement;
        } else {
            $departement = $user->employe->departement;
        }
        
        $query = Commande::whereHas('user.employe', function($q) use ($departement) {
            $q->where('departement_id', $departement->id);
        });
        
        if ($filter === 'approuve') {
            $query->where('status', 'approuve');
        } elseif ($filter === 'rejetee') {
            $query->where('status', 'rejetee');
        } else {
            $query->whereIn('status', ['approuve', 'rejetee', 'recue']);
        }
        
        $commandes = $query->get();
        
        return view('manager.approvals', [
            'commandes' => $commandes,
            'filter' => $filter,
        ]);
    }

    /**
     * Display pending commands
     */
    public function pendantes()
    {
        $user = Auth::user();
        
        // Get manager's department
        if ($user->role_id === 3) { // Manager role
            $departement = $user->manager->departement;
        } else {
            $departement = $user->employe->departement;
        }
        
        $commandes = Commande::whereHas('user.employe', function($query) use ($departement) {
            $query->where('departement_id', $departement->id);
        })->where('status', 'en_attente')->get();
        
        return view('manager.approvals', [
            'commandes' => $commandes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->produits);
        $produits = json_decode($request->produits, true);
        $montantTotal = 0;
        $commandePremuim = false;
        foreach ($produits as $p) {
            $montantTotal += $p['total_ligne'];
            if($p['premuim'] == '1'){
                $commandePremuim=true;
            }
        }

        $commande = Commande::create([
            'user_id' => Auth::user()->id,
            'status' => 'rejetee',
            'montant_tokens' => $montantTotal,
        ]);

        foreach ($produits as $p) {
            LigneCommande::create([
                'commande_id' => $commande->id,
                'produit_id' => $p['produit_id'],
                'qte' => $p['qte'],
                'prix_unitaire' => $p['prix_tokens']
            ]);
        }
        if($commandePremuim){
           $manager=Auth::user()->departement->manager;
           if($manager){
            $manager->notify(new NouvelleCommandePremium($commande));
           }
        }

        return redirect()->route('shop.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)
    {
        // Pour l'instant, retourner à la vue d'approbation
        return view('commandes.show', [
            'commande' => $commande,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commande $commande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        //
    }
}
