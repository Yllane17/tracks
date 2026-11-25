<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departement;
use App\Models\Filiere;

class HomeResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //On charge la liste des filières et départements et on envoie à la page Welcome
        $departments = Departement::all();
        $filieres = Filiere::all();
        //compact permet de prendre un éléments et l'envoyés sous forme de tableau associatif à la vue.
        return view('welcome', compact('departments', 'filieres'));
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
}
