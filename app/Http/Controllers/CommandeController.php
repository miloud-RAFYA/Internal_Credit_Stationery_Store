<?php

namespace App\Http\Controllers;

use App\Models\Commande;
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
        
        // Default: show all statuses except pending
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
        //
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
