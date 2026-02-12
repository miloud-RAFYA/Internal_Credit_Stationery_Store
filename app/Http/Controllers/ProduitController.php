<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::all();
        return view('admin.products.index', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prix_tokens' => 'required',
            'stock' => 'required',
            'description' => 'required',
            'image_produit' => 'nullable|image|max:3072',
            'est_premuim' => 'boolean'
        ]);
        $data = $request->only('nom', 'prix_tokens', 'stock', 'description', 'est_premuim');
        if ($request->hasFile('image_produit')) {
            $path = $request->file('image_produit')->store('products', 'public');
            $data['image_produit'] = $path;
        }
        Produit::create($data);
        return redirect()->route('products.index')
            ->with('success', 'Produit créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $product)
    {
        return view('admin.products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       
        $produit=Produit::find($id);
        $produit->update([
            'nom' => $request->nom,
            'description'=> $request->nom,
            'stock' => $request->stock,
            'prix_tokens'=>$request->prix_tokens,
            'est_premuim'=>$request->est_premuim ?? false
        ]);
        return redirect()->route('products.index')->with('success','Product updated successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $product=Produit::find($id);
        $product->delete();
        return redirect()->route('products.index')->with('success','Product delete successfully');
    }
}
