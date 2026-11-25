@extends('template.template')
@section('content')

    <section class="d-flex justify-content-between align-items-center mb-4">
        <h2> Gestion des Niveaux </h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreation">
            <i class="fa-solid fa-plus"></i> Ajouter
        </button>
    </section>

    {{-- Tableau des niveaux --}}
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle table-bordered">
            <thead class="table-light">
                <tr>
                    <th>N°</th>
                    <th>Libellé</th>
                    <th>Créé le</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($niveaux as $niveau)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $niveau->libelle_niveau }}</td>
                        <td>{{ $niveau->created_at }}</td>

                        <td class="text-end text-nowrap">
                            <button type="button" class="btn btn-sm btn-warning" title="Modifier"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEdition{{ $niveau->id_niveau }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" title="Supprimer"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalSuppression{{ $niveau->id_niveau }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">Aucun niveau enregistré.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Modal de création : HORS de la boucle, il doit toujours exister --}}
    <div class="modal fade" id="modalCreation" tabindex="-1" aria-labelledby="modalCreationLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content bg-white" method="POST" action="{{ route('niveau.create') }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreationLabel">Ajouter un niveau</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="creation_libelle_niveau" class="form-label">
                            Libellé <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="creation_libelle_niveau" name="libelle_niveau"
                               class="form-control"
                               maxlength="120" value="{{ old('libelle_niveau') }}" required>
                        @error('libelle_niveau', 'ajout')
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

    {{-- Modals d'édition et de suppression : un par niveau, donc dans la boucle --}}
    @foreach ($niveaux as $niveau)

        {{-- Modal d'édition --}}
        <div class="modal fade" id="modalEdition{{ $niveau->id_niveau }}" tabindex="-1"
             aria-labelledby="modalEditionLabel{{ $niveau->id_niveau }}" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content bg-white" method="POST"
                      action="{{ route('niveau.update', $niveau->id_niveau) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditionLabel{{ $niveau->id_niveau }}">
                            Modifier le niveau
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edition_libelle_niveau{{ $niveau->id_niveau }}" class="form-label">
                                Libellé <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="edition_libelle_niveau{{ $niveau->id_niveau }}"
                                   name="libelle_niveau" class="form-control"
                                   maxlength="120" required value="{{ $niveau->libelle_niveau }}">
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
        <div class="modal fade" id="modalSuppression{{ $niveau->id_niveau }}" tabindex="-1"
             aria-labelledby="modalSuppressionLabel{{ $niveau->id_niveau }}" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content bg-white" method="POST"
                      action="{{ route('niveau.delete', $niveau->id_niveau) }}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalSuppressionLabel{{ $niveau->id_niveau }}">
                            Confirmer la suppression
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        Voulez-vous vraiment supprimer le niveau
                        <strong>{{ $niveau->libelle_niveau }}</strong> ?
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
