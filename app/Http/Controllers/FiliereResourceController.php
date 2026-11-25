<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Filiere;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\UploadedFile;


class FiliereResourceController extends Controller
{
    public function index()
    {
        $filieres = Filiere::with('departements')->get();
        $departements = Departement::all();

        return view('administration.filiere', compact('filieres', 'departements'));
    }

    private function regles(?Departement $departement = null): array{
        $sigleObligatoire = $departement?->logo_departement ? 'required' : 'required_with:logo_departement';

        return [
            'nom_departement' => ['required', 'string', 'max:128'],
            'sigle_departement' => [$sigleObligatoire, 'nullable', 'string', 'max:28', Rule::unique('departement', 'sigle_departement')->ignore($departement?->id_departement, 'id_departement')],
            'description_departement' => ['nullable', 'string', 'max:255'],
            'logo_departement' => ['nullable', 'image', 'mimes:jpeg,webp,png,gif,svg', 'max:2048'],
        ];
    }

    private function stockerLogo(UploadedFile $fichier, string $sigle):string{
        $chemin = $this->cheminLogo($sigle, $fichier->extension());
        return $fichier->storeAS(dirname($chemin), basename($chemin), 'public');
    }

    private function cheminLogo(string $sigle, string $extension):string{
        $nom = preg_replace('/[^a-zA-Z0-9]/', '_', trim($sigle) );
        return 'logo/' . $nom . '.' . strtolower($extension);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nomFiliere' => 'required|string|max:120',
            'code_filiere' => 'required|string|max:20|unique:filieres,code_filiere',
            'filiere_description' => 'nullable|string|max:255',
            'departements' => 'nullable|array',
            'departements.*' => 'exists:departement,id_departement',
        ]);

        $filiere = Filiere::create($data);

        Departement::whereIn('id_departement', $data['departements'] ?? [])
            ->update(['idFiliere' => $filiere->idFiliere]);

        return redirect()->route('filiere.store', compact('filiere'))->with('success', 'Filière ajoutée.');
    }

    public function update(Request $request, Filiere $filiere)
    {
        $data = $request->validate([
            'nomFiliere' => 'required|string|max:120',
            'code_filiere' => 'required|string|max:20|unique:filieres,code_filiere,' . $filiere->idFiliere . ',idFiliere',
            'filiere_description' => 'nullable|string|max:255',
            'departements' => 'nullable|array',
            'departements.*' => 'exists:departement,id_departement',
        ]);

        $filiere->update($data);

        Departement::where('idFiliere', $filiere->idFiliere)->update(['idFiliere' => null]);
        Departement::whereIn('id_departement', $data['departements'] ?? [])
            ->update(['idFiliere' => $filiere->idFiliere]);

        return redirect()->route('filiere.update')->with('success', 'Filière modifiée.');
    }

    public function destroy(Filiere $filiere)
    {
        $filiere->delete();

        return redirect()->route('filiere.destroy')->with('success', 'Filière supprimée.');
    }
}
