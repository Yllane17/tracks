@extends('template.template')
@section('content')

    <section class="d-flex justify-content-between align-items-center mb-4">
        <h2> Gestion des Classes </h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreation">
            <i class="fa-solid fa-plus"></i> Ajouter
        </button>
    </section>

    {{-- Tableau des classes --}}
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Code</th>
                    <th>Nombre d'étudiants</th>
                    <th>Niveau</th>
                    <th>Créée le</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($classes as $classe)
                    <tr>
                        <td>{{ $classe->code_classe }}</td>
                        <td>{{ $classe->nb_etudiant }}</td>
                        <td>{{ $classe->niveau->libelle_niveau ?? '—' }}</td>
                        <td>{{ $classe->created_at }}</td>

                        <td class="text-end text-nowrap">
                            <button type="button" class="btn btn-sm btn-warning" title="Modifier"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEdition{{ $loop->iteration }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" title="Supprimer"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalSuppression{{ $loop->iteration }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Aucune classe enregistrée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal de création --}}
    <div class="modal fade" id="modalCreation" tabindex="-1" aria-labelledby="modalCreationLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content bg-white" method="POST" action="{{ route('classe.create') }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreationLabel">Ajouter une classe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="creation_code_classe" class="form-label">
                            Code <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="creation_code_classe" name="code_classe"
                               class="form-control" maxlength="50" value="{{ old('code_classe') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="creation_nb_etudiant" class="form-label">
                            Nombre d'étudiants <span class="text-danger">*</span>
                        </label>
                        <input type="number" id="creation_nb_etudiant" name="nb_etudiant"
                               class="form-control"
                               min="1" max="40" value="{{ old('nb_etudiant', 25) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="creation_id_niveau" class="form-label">
                            Niveau <span class="text-danger">*</span>
                        </label>
                        <select id="creation_id_niveau" name="id_niveau"
                                class="form-select" required>
                            <option value="">Sélectionner un niveau d'étude</option>
                            @foreach ($niveaux as $niveau)
                                <option value="{{ $niveau->id_niveau }}"
                                    @selected(old('id_niveau') == $niveau->id_niveau)>
                                    {{ $niveau->libelle_niveau }}
                                </option>
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

    {{-- Modals d'édition et de suppression : un par classe, donc dans la boucle --}}
    @foreach ($classes as $classe)

        {{-- Modal d'édition --}}
        <div class="modal fade" id="modalEdition{{ $loop->iteration }}" tabindex="-1"
             aria-labelledby="modalEditionLabel{{ $loop->iteration }}" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content bg-white" method="POST"
                      action="{{ route('classe.update', $classe->code_classe) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditionLabel{{ $loop->iteration }}">
                            Modifier la classe
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Code</label>
                            <input type="text" class="form-control" value="{{ $classe->code_classe }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="edition_nb_etudiant{{ $loop->iteration }}" class="form-label">
                                Nombre d'étudiants <span class="text-danger">*</span>
                            </label>
                            <input type="number" id="edition_nb_etudiant{{ $loop->iteration }}" name="nb_etudiant"
                                   class="form-control" min="1" max="40" required
                                   value="{{ $classe->nb_etudiant }}">
                        </div>

                        <div class="mb-3">
                            <label for="edition_id_niveau{{ $loop->iteration }}" class="form-label">
                                Niveau <span class="text-danger">*</span>
                            </label>
                            <select id="edition_id_niveau{{ $loop->iteration }}" name="id_niveau"
                                    class="form-select" required>
                                @foreach ($niveaux as $niveau)
                                    <option value="{{ $niveau->id_niveau }}"
                                        @selected($classe->id_niveau == $niveau->id_niveau)>
                                        {{ $niveau->libelle_niveau }}
                                    </option>
                                @endforeach
                            </select>
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

        {{-- Modal de suppression --}}
        <div class="modal fade" id="modalSuppression{{ $loop->iteration }}" tabindex="-1"
             aria-labelledby="modalSuppressionLabel{{ $loop->iteration }}" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content bg-white" method="POST"
                      action="{{ route('classe.delete', $classe->code_classe) }}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalSuppressionLabel{{ $loop->iteration }}">
                            Confirmer la suppression
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        Voulez-vous vraiment supprimer la classe
                        <strong>{{ $classe->code_classe }}</strong> ?
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
