<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\LigneCommande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        foreach ($produits as $p) {
            $montantTotal += $p['total_ligne'];
        }

        $commande = Commande::create([
            'user_id' => auth()->user()->id,
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)
    {
        //
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
