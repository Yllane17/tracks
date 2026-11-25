@extends('template.template')
@section('content')

    <section class="d-flex justify-content-between align-items-center mb-4">
        <h2> Gestion des Filières </h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreation">
            <i class="fa-solid fa-plus"></i> Ajouter
        </button>
    </section>

    {{-- Tableau des filières --}}
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Code</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Durée</th>
                    <th>Departement</th>
                    <th>Crée le</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($filieres as $filiere)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $filiere->nom_filiere }}</td>
                        <td>{{ $filiere->description_filiere ?? 'Aucune description disponible' }}</td>
                        <td>{{ $filiere->duree_filiere}}</td>
                        <td>{{ $filiere->id_departement}}</td>
                        <td>{{ $filiere->created_at }}</td>

                        <td class="text-end text-nowrap">
                            {{-- Bouton Modifier avec icône --}}
                            <button type="button" class="btn btn-sm btn-warning" title="Modifier"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEdition{{ $filiere->code_filiere }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            {{-- Bouton Supprimer avec icône --}}
                            <button type="button" class="btn btn-sm btn-danger" title="Supprimer"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalSuppression{{ $filiere->code_filiere }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Aucune filière enregistré.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Les modals --}}
    @foreach ($filieres as $filiere)

        {{-- Modal de création --}}
        <div class="modal fade" id="modalCreation" tabindex="-1" aria-labelledby="modalCreationLabel"
            aria-hidden="true">

            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="/filiere/store">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCreationLabel">
                            Ajouter une filière
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="creation_nom_filiere" class="form-label">
                                Nom <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="creation_nom_filiere" name="nom_filiere"
                                class="form-control" maxlength="120" value="{{ old('nom_filiere') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="creation_description_filiere" class="form-label">
                                Description
                            </label>
                            <textarea id="creation_description_filiere" name="description_filiere" class="form-control" rows="3"
                                maxlength="255">{{ old('description_filiere') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="creation_duree_filiere" class="form-label">
                                Durée <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="creation_duree_filiere" name="duree_filiere"
                                class="form-control" maxlength="120" value="{{ old('duree_filiere') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="creation_departement" class="form-label">
                                Département <span class="text-danger">*</span>
                            </label>
                            <select id="creation_departement" name="nom_departement" class="form-select">
                                <option>Sélectionner une filière</option>
                                @foreach ($departments as $departement)
                                    <option value="{{$departement->nom_departement}}">{{$departement->nom_departement}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fa-solid fa-times"></i> Annuler
                        </button>

                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-plus"></i> Ajouter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal d'édition --}}
        <div class="modal fade" id="modalEdition{{ $filiere->code_filiere }}" tabindex="-1"
             aria-labelledby="modalEditionLabel{{ $filiere->code_filiere }}" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content bg-white" method="POST" action="/filiere/update">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditionLabel{{ $filiere->code_filiere }}">
                            Modifier la filière
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nom <span class="text-danger">*</span></label>
                            <input type="text" name="nom_filiere" class="form-control"
                                   maxlength="120" required value="{{ $filiere->nom_filiere }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description_filiere" class="form-control" rows="3"
                                      maxlength="255">{{ $filiere->description_filiere }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Durée <span class="text-danger">*</span></label>
                            <input type="text" name="duree_filiere" class="form-control"
                                   maxlength="120" required value="{{ $filiere->duree_filiere }}">
                        </div>

                        <div class="mb-3">
                            <label for="creation_departement" class="form-label">
                                Département <span class="text-danger">*</span>
                            </label>
                            <select id="creation_departement" name="nom_departement" class="form-select">
                                <option>Sélectionner une filière</option>
                                @foreach ($departments as $departement)
                                    <option value="{{$departement->nom_departement}}">{{$departement->nom_departement}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-times"></i> Annuler</button>
                        <button type="submit" class="btn btn-warning">
                            <i class="fa-solid fa-floppy-disk"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal de confirmation de suppression --}}
        <div class="modal fade" id="modalSuppression{{ $filiere->code_filiere }}" tabindex="-1"
             aria-labelledby="modalSuppressionLabel{{ $filiere->code_filiere }}" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content bg-white" method="POST" action="/filiere/delete">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalSuppressionLabel{{ $filiere->code_filiere }}">
                            Confirmer la suppression
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        Voulez-vous vraiment supprimer la filière
                        <strong>{{ $filiere->nom_filiere }}</strong> ?
                        Cette action est irréversible.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-times"></i> Annuler</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i> Supprimer
                        </button>
                    </div>
                </form>
            </div>
        </div>

    @endforeach
@endsection
