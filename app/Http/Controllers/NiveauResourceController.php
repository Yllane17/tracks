<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use Illuminate\Http\Request;

class NiveauResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $niveaux = Niveau::orderBy('libelle_niveau')->get();
        return view('Administration/niveau', compact('niveaux'));
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
        Niveau::create($data);

        // redirection de la page
        return redirect()->route('niveau.index')
            ->with('success', 'Niveau ajouté avec succès.');
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
     * Ce sont les règles de validation pour la création et la modification d'un département.
     */
    private function regles(?Niveau $niveau = null): array
    {
        return [
            'libelle_niveau' => ['required', 'string', 'max:120'],
        ];
    }
}
