@extends('template.template')
@section('content')
    <section class="d-flex justify-content-between align-items-center mb-4">
        <h2> Gestion des Départements </h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreation">
            <i class="fa-solid fa-plus"></i> Ajouter
        </button>
    </section>

    {{-- Tableau des départements --}}
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle table-bordered">
            <thead class="table-light">
                <tr>
                    <th>N°</th>
                    <th>Nom</th>
                    <th>Sigle</th>
                    <th>Description</th>
                    <th>Logo</th>
                    <th>Crée le</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($departments as $departement)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $departement->nom_departement }}</td>
                        <td>{{ $departement->sigle_departement }}</td>
                        <td>{{ $departement->description_departement ?? 'Aucune description disponible' }}</td>
                        <td><img src="{{ $departement->logo_departement }}" alt="{{ $departement->nom_departement }}"></td>
                        <td>{{ $departement->created_at }}</td>
                        <td class="text-end text-nowrap">
                            {{-- Bouton Modifier avec icône --}}
                            <button type="button" class="btn btn-sm btn-warning" title="Modifier" data-bs-toggle="modal"
                                data-bs-target="#modalEdition{{ $departement->id_departement }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            {{-- Bouton Supprimer avec icône --}}
                            <button type="button" class="btn btn-sm btn-danger" title="Supprimer" data-bs-toggle="modal"
                                data-bs-target="#modalSuppression{{ $departement->id_departement }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Aucun département enregistré.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Les modals --}}
    @foreach ($departments as $departement)
        {{-- Modal de création --}}
        <div class="modal fade" id="modalCreation" tabindex="-1" aria-labelledby="modalCreationLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="/departements/store">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCreationLabel">
                            Ajouter un département
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="creation_nom_departement" class="form-label">
                                Nom <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="creation_nom_departement" name="nom_departement" class="form-control"
                                maxlength="120" value="{{ old('nom_departement') }}" required>
                            @error('nom_departement', 'ajout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="creation_sigle_departement" class="form-label">
                                Sigle
                            </label>
                            <input type="text" id="creation_sigle_departement" name="sigle_departement"
                                class="form-control" maxlength="20" value="{{ old('sigle_departement') }}">
                            @error('sigle_departement', 'ajout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="creation_description_departement" class="form-label">
                                Description
                            </label>
                            <textarea id="creation_description_departement" name="description_departement" class="form-control" rows="3"
                                maxlength="255">{{ old('description_departement') }}</textarea>

                            @error('description_departement', 'ajout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="creation_logo_departement" class="form-label">
                                Logo
                            </label>
                            <input type="file" name="logo_departement"
                                accept="image/png, image/jpeg, image/gif, image/webp" class="form-control"
                                @error('logo_departement', 'ajout') is-invalid @enderror>
                            <div class="form-text">Formats acceptés : JPG, PNG, JPEG, GIF, WEBP (2 Mo max).</div>
                            @error('logo_departement', 'ajout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
        <div class="modal fade" id="modalEdition{{ $departement->id_departement }}" tabindex="-1"
            aria-labelledby="modalEditionLabel{{ $departement->id_departement }}" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content bg-white" method="POST" action="/departement/update">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditionLabel{{ $departement->id_departement }}">
                            Modifier le département
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nom <span class="text-danger">*</span></label>
                            <input type="text" name="nom_departement" class="form-control" maxlength="120" required
                                value="{{ $departement->nom_departement }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sigle</label>
                            <input type="text" name="sigle_departement" class="form-control" maxlength="20"
                                value="{{ $departement->sigle_departement }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description_departement" class="form-control" rows="3" maxlength="255">{{ $departement->description_departement }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="creation_logo_departement" class="form-label">
                                Logo
                            </label>
                            <input type="file" name="logo_departement"
                                accept="image/png, image/jpeg, image/gif, image/webp" class="form-control"
                                @error('logo_departement', 'ajout') is-invalid @enderror>
                            <div class="form-text">Formats acceptés : JPG, PNG, JPEG, GIF, WEBP (2 Mo max).</div>
                            @error('logo_departement', 'ajout')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="fa-solid fa-times"></i> Annuler</button>
                        <button type="submit" class="btn btn-warning">
                            <i class="fa-solid fa-floppy-disk"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal de confirmation de suppression --}}
        <div class="modal fade" id="modalSuppression{{ $departement->id_departement }}" tabindex="-1"
            aria-labelledby="modalSuppressionLabel{{ $departement->id_departement }}" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content bg-white" method="POST" action="/departement/delete">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalSuppressionLabel{{ $departement->id_departement }}">
                            Confirmer la suppression
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        Voulez-vous vraiment supprimer le département
                        <strong>{{ $departement->nom_departement }}</strong> ?
                        Cette action est irréversible.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="fa-solid fa-times"></i> Annuler</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i> Supprimer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection
