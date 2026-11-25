<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Classe;
use App\Models\Departement;


class EtudiantResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudiants = User::orderBy('name_user')->get();
        $departements = Departement::orderBy('nom_departement')->get();
        $classes = Classe::orderBy('code_classe')->get();

        return view('Utilisateur/etudiant', compact('etudiants', 'departements', 'classes'));
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

    /**
     * Règles de validation.
     */
    private function regles(?User $etudiant = null): array
    {
        return [
            'name_user'      => ['required', 'string', 'max:255'],
            'last_name_user' => ['nullable', 'string', 'max:255'],
            'email'          => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($etudiant?->id_user, 'id_user')],
            'matricule'      => ['required', 'string', 'max:255', Rule::unique('users', 'matricule')->ignore($etudiant?->id_user, 'id_user')],
            'phone_number'   => ['required', 'string', 'max:255'],
            'date_of_birth'  => ['required', 'date'],
            'sexe'           => ['required', 'string', 'max:255'],
            'password'       => [$etudiant ? 'nullable' : 'required', 'string', 'min:8'],
            'id_departement' => ['required', 'integer', 'exists:departement,id_departement'],
        ];
    }
}
