<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartementResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Departement::orderBy('nom_departement')->get();
        return view('Administration/departement', compact('departments'));
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

        // upload du logo dans storage/app/public/logo, nomme d'apres le sigle
        if ($request->hasFile('logo_departement')) {
            $data['logo_departement'] = $this->stockerLogo(
                $request->file('logo_departement'),
                $data['sigle_departement']
            );
        }

        // enregistrement
        Departement::create($data);

        // redirection de la page
        return redirect()->route('departements.index')
            ->with('success', 'Département ajouté avec succès.');
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
    public function update(Request $request, Departement $departement)
    {
        $data = $request->validateWithBag('edition', $this->regles($departement));
        $disque = Storage::disk('public');
        if($request->hasFile('logo_departement')){
            if($departement->logo_departement){
                $disque->delete($departement->logo_departement);
                $data['logo_departement']=$this->stockerLogo($request->file('logo_departement'),
                $data['sigle_departement']);
            }else{
                unset($data['logo_departement']);
                $ancien = $departement->logo_departement;
                if($ancien && $disque->exists($ancien)){
                    $nouveau = $this->cheminLogo($data['sigle_departement'],pathinfo($ancien, PATHINFO_EXTENSION));
                    if($nouveau !== $ancien){
                        $disque->delete($nouveau);
                        $disque->move($ancien, $nouveau);
                        $data['logo_departement']  = $nouveau;
                    }
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departement $departement)
    {
        if($departement->users()->exists()){
            return redirect()->route('departement.index')->with('error', 'Impossible de supprimer ce departement : des utilisateurs y sont rattachés.');
        }
        if($departement->filieres()->exists()){
            return redirect()->route('departement.index')->with('error', 'Impossible de supprimer ce departement : des filieres y aont rattachées.');
        }

        $logo = $departement->logo_departement;
        $departement->delete();
        if($logo){
            Storage::disk('public')->delete($logo);
        }
        return redirect()->route('departement.index')->with('success', 'Département supprimé avec succès.');
    }

    /**
     * Construit le chemin du logo à partir du sigle
     * (caractères spéciaux remplacés par "_" pour un nom de fichier sûr).
     */
    private function cheminLogo(string $sigle, string $extension): string
    {
        $nom = preg_replace('/[^A-Za-z0-9_-]/', '_', trim($sigle));

        // fallback si le sigle ne contient que des caractères spéciaux
        if ($nom === '' || $nom === null) {
            $nom = 'logo_' . uniqid();
        }

        return 'logo/' . $nom . '.' . strtolower($extension);
    }

    /**
     * Retourne le chemin du logo d'un département.
     */
    private function stockerLogo(UploadedFile $fichier, string $sigle): string
    {
        $chemin = $this->cheminLogo($sigle, $fichier->getClientOriginalExtension());

        return $fichier->storeAs(dirname($chemin), basename($chemin), 'public');
    }

    /**
     * Ce sont les règles de validation pour la création et la modification d'un département.
     */
    private function regles(?Departement $departement = null): array
    {
        $sigleObligatoire = 'required';

        return [
            'nom_departement' => ['required', 'string', 'max:120'],
            'sigle_departement' => [
                $sigleObligatoire,
                'string',
                'max:20',
                Rule::unique('departement', 'sigle_departement')
                    ->ignore($departement?->id_departement, 'id_departement'),
            ],
            'description_departement' => ['nullable', 'string', 'max:255'],
            'logo_departement' => ['nullable', 'image', 'mimes:jpeg,png,gif,webp', 'max:2048'],
        ];
    }
}
