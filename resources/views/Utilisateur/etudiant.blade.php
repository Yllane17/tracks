@extends('template.template')
@section('content')

    <section class="d-flex justify-content-between align-items-center mb-4">
        <h2> Gestion des Étudiants </h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreation">
            <i class="fa-solid fa-plus"></i> Ajouter
        </button>
    </section>

    {{-- Tableau des étudiants --}}
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle table-bordered">
            <thead class="table-light">
                <tr>
                    <th>N°</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Matricule</th>
                    <th>Téléphone</th>
                    <th>Date naissance</th>
                    <th>Sexe</th>
                    <th>Département</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($etudiants as $etudiant)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $etudiant->name_user }}</td>
                        <td>{{ $etudiant->last_name_user ?? '—' }}</td>
                        <td>{{ $etudiant->email }}</td>
                        <td>{{ $etudiant->matricule }}</td>
                        <td>{{ $etudiant->phone_number }}</td>
                        <td>{{ $etudiant->date_of_birth }}</td>
                        <td>{{ $etudiant->sexe }}</td>
                        <td>{{ $etudiant->departement->nom_departement ?? '—' }}</td>
                        <td class="text-end text-nowrap">
                            <button type="button" class="btn btn-sm btn-warning" title="Modifier"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEdition{{ $etudiant->id_user }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" title="Supprimer"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalSuppression{{ $etudiant->id_user }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted py-4">Aucun étudiant enregistré.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ============================================== --}}
    {{-- MODAL DE CRÉATION (HORS DE LA BOUCLE) --}}
    {{-- ============================================== --}}
    <div class="modal fade" id="modalCreation" tabindex="-1" aria-labelledby="modalCreationLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            {{-- ATTENTION ICI : route('etudiant.create') --}}
            <form class="modal-content" method="POST" action="{{ route('etudiant.create') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreationLabel">
                        Ajouter un étudiant
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nom <span class="text-danger">*</span></label>
                        <input type="text" name="name_user" class="form-control" maxlength="255"
                               value="{{ old('name_user') }}" required>
                        @error('name_user', 'ajout')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="last_name_user" class="form-control" maxlength="255"
                               value="{{ old('last_name_user') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" maxlength="255"
                               value="{{ old('email') }}" required>
                        @error('email', 'ajout')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Matricule <span class="text-danger">*</span></label>
                        <input type="text" name="matricule" class="form-control" maxlength="255"
                               value="{{ old('matricule') }}" required>
                        @error('matricule', 'ajout')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Téléphone <span class="text-danger">*</span></label>
                        <input type="text" name="phone_number" class="form-control" maxlength="255"
                               value="{{ old('phone_number') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date de naissance <span class="text-danger">*</span></label>
                        <input type="date" name="date_of_birth" class="form-control"
                               value="{{ old('date_of_birth') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sexe <span class="text-danger">*</span></label>
                        <select name="sexe" class="form-select" required>
                            <option value="">-- Choisir --</option>
                            <option value="M" @selected(old('sexe') == 'M')>Masculin</option>
                            <option value="F" @selected(old('sexe') == 'F')>Féminin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Département <span class="text-danger">*</span></label>
                        <select name="id_departement" class="form-select" required>
                            <option value="">Sélectionner un département</option>
                            @foreach ($departements as $departement)
                                <option value="{{ $departement->id_departement }}"
                                    @selected(old('id_departement') == $departement->id_departement)>
                                    {{ $departement->nom_departement }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mot de passe <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" minlength="8" required>
                        @error('password', 'ajout')
                            <div class="invalid-feedback">{{ $message }}</div>
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

    {{-- ============================================== --}}
    {{-- MODALS D'ÉDITION ET DE SUPPRESSION (DANS LA BOUCLE) --}}
    {{-- ============================================== --}}
    @foreach ($etudiants as $etudiant)
        {{-- Modal d'édition --}}
        <div class="modal fade" id="modalEdition{{ $etudiant->id_user }}" tabindex="-1"
             aria-labelledby="modalEditionLabel{{ $etudiant->id_user }}" aria-hidden="true">
            <div class="modal-dialog">
                {{-- ATTENTION ICI : route('etudiant.update') --}}
                <form class="modal-content bg-white" method="POST" action="{{ route('etudiant.update', $etudiant->id_user) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditionLabel{{ $etudiant->id_user }}">
                            Modifier l'étudiant
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nom <span class="text-danger">*</span></label>
                            <input type="text" name="name_user" class="form-control" maxlength="255"
                                   value="{{ $etudiant->name_user }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Prénom</label>
                            <input type="text" name="last_name_user" class="form-control" maxlength="255"
                                   value="{{ $etudiant->last_name_user }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" maxlength="255"
                                   value="{{ $etudiant->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Matricule <span class="text-danger">*</span></label>
                            <input type="text" name="matricule" class="form-control" maxlength="255"
                                   value="{{ $etudiant->matricule }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Téléphone <span class="text-danger">*</span></label>
                            <input type="text" name="phone_number" class="form-control" maxlength="255"
                                   value="{{ $etudiant->phone_number }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date de naissance <span class="text-danger">*</span></label>
                            <input type="date" name="date_of_birth" class="form-control"
                                   value="{{ $etudiant->date_of_birth }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sexe <span class="text-danger">*</span></label>
                            <select name="sexe" class="form-select" required>
                                <option value="M" @selected($etudiant->sexe == 'M')>Masculin</option>
                                <option value="F" @selected($etudiant->sexe == 'F')>Féminin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Département <span class="text-danger">*</span></label>
                            <select name="id_departement" class="form-select" required>
                                @foreach ($departements as $departement)
                                    <option value="{{ $departement->id_departement }}"
                                        @selected($etudiant->id_departement == $departement->id_departement)>
                                        {{ $departement->nom_departement }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nouveau mot de passe (laisser vide pour conserver)</label>
                            <input type="password" name="password" class="form-control" minlength="8">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fa-solid fa-times"></i> Annuler
                        </button>
                        <button type="submit" class="btn btn-warning">
                            <i class="fa-solid fa-floppy-disk"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal de confirmation de suppression --}}
        <div class="modal fade" id="modalSuppression{{ $etudiant->id_user }}" tabindex="-1"
             aria-labelledby="modalSuppressionLabel{{ $etudiant->id_user }}" aria-hidden="true">
            <div class="modal-dialog">
                {{-- ATTENTION ICI : route('etudiant.delete') --}}
                <form class="modal-content bg-white" method="POST" action="{{ route('etudiant.delete', $etudiant->id_user) }}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalSuppressionLabel{{ $etudiant->id_user }}">
                            Confirmer la suppression
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        Voulez-vous vraiment supprimer l'étudiant
                        <strong>{{ $etudiant->name_user }} {{ $etudiant->last_name_user }}</strong> ?
                        Cette action est irréversible.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fa-solid fa-times"></i> Annuler
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i> Supprimer
                        </button>
                    </div>
                </form>
            </div>
        </div>

    @endforeach
@endsection
