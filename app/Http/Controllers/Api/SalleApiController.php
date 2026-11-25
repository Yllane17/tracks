<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Salle;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class SalleApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $salles = Salle::query()
            ->when($request->filled('batiment'),
                fn ($q) => $q->where('batiment', $request->query('batiment')))
            ->when($request->filled('capacite_min'),
                fn ($q) => $q->where('nbre_place', '>=', (int) $request->query('capacite_min')))
            ->orderBy('libelle_salle')
            ->get();

        return response()->json([
            'total' => $salles->count(),
            'data'  => $salles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        $data  = $request->validate($this->regles());
        $salle = Salle::create($data);

        return response()->json([
            'message' => 'Salle créée avec succès.',
            'data'    => $salle,
        ], Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     */
    public function show(Salle $salle): Response
    {
        return response()->json(['data' => $salle]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salle $salle): Response
    {
        $partiel = $request->isMethod('patch');
        $data    = $request->validate($this->regles($salle, $partiel));

        $salle->update($data);

        return response()->json([
            'message' => 'Salle modifiée avec succès.',
            'data'    => $salle->fresh(),
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salle $salle): Response
    {
        if ($salle->seances()->exists()) {
            return response()->json([
                'message' => 'Impossible de supprimer cette salle : des séances y sont programmées.',
            ], Response::HTTP_CONFLICT);
        }
        $salle->delete();

        return response()->noContent();
    }

    private function regles(?Salle $salle = null, bool $partiel = false): array
    {
        $requis = $partiel ? 'sometimes' : 'required';
        return [
            'libelle_salle'  => [
                $requis, 'string', 'max:120',
                Rule::unique('salle', 'libelle_salle')->ignore($salle?->id_salle, 'id_salle'),
            ],
            'nbre_place'     => ['sometimes', 'integer', 'min:1', 'max:1000'],
            'batiment'       => [$requis, 'string', 'max:120'],
        ];
    }
}


