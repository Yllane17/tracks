@extends('template.template')
@section('content')

    <div class="row">
        {{-- ========================================== --}}
        {{-- SECTION RÔLES --}}
        {{-- ========================================== --}}
        <div class="col-md-6 mb-4">
            <section class="d-flex justify-content-between align-items-center mb-3">
                <h3> Gestion des Rôles </h3>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalRoleCreation">
                    <i class="fa-solid fa-plus"></i> Ajouter un rôle
                </button>
            </section>

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
                        @forelse ($roles as $role)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $role->libelle }}</td>
                                <td>{{ $role->created_at }}</td>
                                <td class="text-end text-nowrap">
                                    <button type="button" class="btn btn-sm btn-warning" title="Modifier"
                                            data-bs-toggle="modal" data-bs-target="#modalRoleEdition{{ $role->id_role }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" title="Supprimer"
                                            data-bs-toggle="modal" data-bs-target="#modalRoleSuppression{{ $role->id_role }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Aucun rôle enregistré.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- SECTION PERMISSIONS --}}
        {{-- ========================================== --}}
        <div class="col-md-6 mb-4">
            <section class="d-flex justify-content-between align-items-center mb-3">
                <h3> Gestion des Permissions </h3>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPermissionCreation">
                    <i class="fa-solid fa-plus"></i> Ajouter une permission
                </button>
            </section>

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
                        @forelse ($permissions as $permission)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $permission->libelle_permission }}</td>
                                <td>{{ $permission->created_at }}</td>
                                <td class="text-end text-nowrap">
                                    <button type="button" class="btn btn-sm btn-warning" title="Modifier"
                                            data-bs-toggle="modal" data-bs-target="#modalPermissionEdition{{ $permission->id_permission }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" title="Supprimer"
                                            data-bs-toggle="modal" data-bs-target="#modalPermissionSuppression{{ $permission->id_permission }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">Aucune permission enregistrée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ======================================================= --}}
    {{-- MODALS POUR LES RÔLES --}}
    {{-- ======================================================= --}}

    {{-- Modal Création Rôle --}}
    <div class="modal fade" id="modalRoleCreation" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{ route('rolePermission.create') }}">
                @csrf
                <input type="hidden" name="type" value="role"> {{-- Indispensable pour le controller --}}
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un rôle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Libellé <span class="text-danger">*</span></label>
                        <input type="text" name="libelle" class="form-control" maxlength="255" value="{{ old('libelle') }}" required>
                        @error('libelle', 'ajout')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>

    @foreach ($roles as $role)
        {{-- Modal Édition Rôle --}}
        <div class="modal fade" id="modalRoleEdition{{ $role->id_role }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="{{ route('rolePermission.update', $role->id_role) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="type" value="role">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier le rôle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Libellé <span class="text-danger">*</span></label>
                            <input type="text" name="libelle" class="form-control" maxlength="255" value="{{ $role->libelle }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-warning">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal Suppression Rôle --}}
        <div class="modal fade" id="modalRoleSuppression{{ $role->id_role }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="{{ route('rolePermission.delete', $role->id_role) }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="type" value="role">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmer la suppression</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Voulez-vous vraiment supprimer le rôle <strong>{{ $role->libelle }}</strong> ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    {{-- ======================================================= --}}
    {{-- MODALS POUR LES PERMISSIONS --}}
    {{-- ======================================================= --}}

    {{-- Modal Création Permission --}}
    <div class="modal fade" id="modalPermissionCreation" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{ route('rolePermission.create') }}">
                @csrf
                <input type="hidden" name="type" value="permission">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Libellé <span class="text-danger">*</span></label>
                        <input type="text" name="libelle_permission" class="form-control" maxlength="255" value="{{ old('libelle_permission') }}" required>
                        @error('libelle_permission', 'ajout')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>

    @foreach ($permissions as $permission)
        {{-- Modal Édition Permission --}}
        <div class="modal fade" id="modalPermissionEdition{{ $permission->id_permission }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="{{ route('rolePermission.update', $permission->id_permission) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="type" value="permission">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier la permission</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Libellé <span class="text-danger">*</span></label>
                            <input type="text" name="libelle_permission" class="form-control" maxlength="255" value="{{ $permission->libelle_permission }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-warning">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal Suppression Permission --}}
        <div class="modal fade" id="modalPermissionSuppression{{ $permission->id_permission }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="{{ route('rolePermission.delete', $permission->id_permission) }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="type" value="permission">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmer la suppression</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Voulez-vous vraiment supprimer la permission <strong>{{ $permission->libelle_permission }}</strong> ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

@endsection
