@extends('template.template')
@section('content')
    <section>
        <!-- Informations de Bienvenues -->
        <div>
            <h1>Bienvenue sur la page d'accueil</h1>
            <p>Cette page est la page d'accueil de l'application Tracks.</p>
            <p>Vous pouvez naviguer à travers les différentes sections de l'application en utilisant le menu de navigation.</p>
        </div>

        <!-- Liste des départements-->
        <div>
        <!-- Départements en cartes -->
        <h2>Nos départements</h2>
        <div class="row g-3 mb-5">
            @foreach ($departments as $department)
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $department->nom_departement }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $department->sigle_departement }}</h6>
                            <p class="card-text">{{ $department->description_departement }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Filières en listes -->
        <div>
            <h2>Nos filières</h2>
            <ul type = "square">
                @foreach ($filieres as $filiere)
                    <li >
                        {{ $filiere->nom_filiere }}
                        <p>
                            {{ $filiere->description_filiere }}
                        </p>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection
