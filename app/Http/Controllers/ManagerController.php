<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ManagerController extends Controller
{
    /**
     * Display approvals page with pending commands and notifications
     */
    public function approvals()
    {
        $user = Auth::user();
        
        if ($user->role_id === 3) { 
            $departement = $user->manager->departement;
        } else {
            $departement = $user->employe->departement;
        }
        
        $commandes = Commande::whereHas('user.employe', function($query) use ($departement) {
            $query->where('departement_id', $departement->id);
        })->where('status', 'en_attente')->get();
        var_dump(Commande::whereHas('user.employe', function($query) use ($departement) {
            $query->where('departement_id', $departement->id);
        }));
        exit;
        return view('manager.approvals', [
            'commandes' => $commandes,
        ]);
    }

    /**
     * Validate/Reject a command
     */
    public function valider(Request $request, Commande $commande)
    {
        if (Auth::id() !== $commande->user->employe->departement->manager_id) {
            abort(403, "Vous n'êtes pas autorisé à valider cette commande.");
        }

        $nouveauStatut = ($request->action === 'accepter') ? 'approuve' : 'rejetee';
        $commande->update(['status' => $nouveauStatut]);

        Auth::user()->unreadNotifications
            ->where('data.commande_id', $commande->id)
            ->markAsRead();

        return back()->with('status', "La commande a été {$nouveauStatut}.");
    }

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Manager $manager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manager $manager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manager $manager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manager $manager)
    {
        //
    }
}
