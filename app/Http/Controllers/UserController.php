<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employe;
use App\Models\Manager;
use App\Models\Role;
use App\Models\Departement;

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
