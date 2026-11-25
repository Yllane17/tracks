<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Niveau;
use Illuminate\Http\Request;

class ClasseResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classe::orderBy('code_classe')->get();
        $niveaux = Niveau::orderBy('libelle_niveau')->get();
        return view('Administration/classe', compact('classes', 'niveaux'));
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
        // validation des donnees
        $data = $request->validateWithBag('ajout', $this->regles());

        // enregistrement
        Classe::create($data);

        // redirection de la page
        return redirect()->route('classe.index')
            ->with('success', 'Classe ajouté avec succès.');
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
     * Ce sont les règles de validation pour la création et la modification d'une classe.
     */
    private function regles(?Classe $classe = null): array
    {
        return [
            'nb_etudiant' => ['required', 'integer', 'min:1', 'max:40'],
            'id_niveau'   => ['required', 'integer', 'exists:niveau,id_niveau'],
        ];
    }
}
