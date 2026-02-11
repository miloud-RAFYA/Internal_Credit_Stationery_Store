<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Employe;
use App\Models\Produit;
use App\Models\Departement;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits=Produit::latest()->paginate(5);
        return view('shop.index',compact('produits'));
    }
    public function cart()
    {
        $produits=Produit::latest()->paginate(5);
        return view('shop.index',compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    public function depensesParDepartement()
    {
        // On récupère chaque département avec la somme des commandes liées
        $departements = Departement::withSum('commandes', 'montant_total')->get();

        return view('manager.approvals', compact('departements'));
    }
    /**
     * Display the specified resource.
     */
    public function show(Employe $employe)
    {
        return view('shop.show');
    }
    public function approvals()
    {
        return view('manager.approvals');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employe $employe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employe $employe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employe $employe)
    {
        //
    }
}
