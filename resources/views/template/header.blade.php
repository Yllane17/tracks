<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">TrackS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li> --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Administration
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route("departement.index")}}">Departement</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{route("filiere.index")}}">Filiere</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{route("niveau.index")}}">Niveau</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{route("classe.index")}}">Classe</a></li>

          </ul>
        </li>

        <!-- section des utilisateurs -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Utilisateurs
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route("etudiant.index")}}">Etudiants</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{route("enseignant.index")}}">Enseignants</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{route("responsableAcademique.index")}}">Responsable academique</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{route("parent.index")}}">Parents</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{route("rolePermission.index")}}">Roles et permissions</a></li>
          </ul>
        </li>

        <!-- section des annees academiques -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Annee
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Annee academique</a></li>
            <li><hr class="dropdown-divider"></li> <!--séparation entre les éléments du menu déroulant-->
            <li><a class="dropdown-item" href="#">Semestre</a></li>
          </ul>
        </li>

        <!-- section des cours -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Cours
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">UE</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">affectation</a></li>
            <li><hr class="dropdown-divider"></li> <!--séparation entre les éléments du menu déroulant-->
            <li><a class="dropdown-item" href="#">EC</a></li>
          </ul>
        </li>

        <!-- section des emplois de temps -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Emploie de temps
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Tranche horaire</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">salle</a></li>
            <li><hr class="dropdown-divider"></li> <!--séparation entre les éléments du menu déroulant-->
            <li><a class="dropdown-item" href="#">Seance</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">EDT</a></li>
          </ul>
        </li>

        <!-- section des evenements -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Evenements
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Evenement</a></li>
            <li><hr class="dropdown-divider"></li> <!--séparation entre les éléments du menu déroulant-->
            <li><a class="dropdown-item" href="#">Notification</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Seance</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">EDT</a></li>
          </ul>
        </li>

      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
