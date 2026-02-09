<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employe;
use App\Models\Manager;
use App\Models\Role;
use App\Models\Departement;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $utilisateurs = User::all();
        return view('admin.utilisateurs.index', compact('utilisateurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departement = Departement::all();
        return view('admin.utilisateurs.create', compact('departement'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'nom' => 'required',
            'email' => 'email|unique:users',
            'password' => 'required',
            'departement_id' => 'required|integer',
            'token' => 'required|integer',
            'role_id' => 'required|integer'
        ]);

        $formFields['password'] = Hash::make($formFields['password']);

        $role = Role::find($formFields['role_id']);
        $user = User::create($formFields);

        if ($role->nom === "Employee") {
            Employe::create([
                'user_id' => $user->id,
                'token' => $formFields['token'],
                'departement_id' => $formFields['departement_id']
            ]);
        }

        if ($role->nom === "manager") {
            Manager::create([
                'user_id' => $user->id,
                'token' => $formFields['token'],
                'departement_id' => $formFields['departement_id']
            ]);
        }

        return redirect()->route('admin.utilisateurs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find((Integer) $id);
        return view('admin.utilisateurs.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $formFields = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_id' => 'required',
            'departement_id' => 'nullable|exists:departements,id',
            'token' => 'nullable|integer|min:0',
        ]);

        $user = User::find($id);
        $role = Role::find($formFields['role_id']);

        $user->update([
            'nom' => $request->nom,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ]);

        if ($role->nom === "Employee") {
            $user->employe()->update([
                'departement_id' => $request->departement_id,
                'token' => $request->token ?? 0,
            ]);
        }

        if ($role->nom === "manager") {
            $user->manager()->update([
                'departement_id' => $request->departement_id,
                'token' => $request->token ?? 0,
            ]);
        }

        return redirect()
            ->route('admin.utilisateurs.index')
            ->with('success', 'Utilisateur mis à jour avec succès');
    }
    public function destroy(string $id)
    {
        $user = User::find($id);
        $role = $user->role->nom;

        if ($role === "Employee") {
            $user->employe()->delete();
        }

        if ($role === "manager") {
            $user->manager()->delete();
        }
        $user->delete();
         return redirect()->route('admin.utilisateurs.index');
    }
}
