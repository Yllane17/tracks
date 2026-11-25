<?php

use App\Http\Controllers\ClasseResourceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserResourceController;
use App\Http\Controllers\HomeResourceController;
use App\Http\Controllers\DepartementResourceController;
use App\Http\Controllers\EnseignantResourceController;
use App\Http\Controllers\EtudiantResourceController;
use App\Http\Controllers\FiliereResourceController;
use App\Http\Controllers\NiveauResourceController;
use App\Http\Controllers\ParentResourceController;
use App\Http\Controllers\ResponsableAcademiqueResourceController;
use App\Http\Controllers\RolePermissionResourceController;

//La route de la page d'accueil qui est la page Welcome
Route::get('/', [HomeResourceController::class, 'index']);

Route::get('/users_r', [UserResourceController::class, 'index']);

Route::get('/departement', [DepartementResourceController::class, 'index']);

//Départements routes : liste + ajout + modification + suppression via le modal
Route::prefix("departement")
    //departement ici est le nom de la route, donc pour accéder à la page departement, il faut mettre dans l'url : /departement
    ->name ("departement.")
    //Lorsque tu met directement le nom du controller, tu peux utiliser les méthodes du controller directement dans le group.
    ->controller(DepartementResourceController::class)
    //Ici maintenant tu peux utiliser les méthodes du controller directement dans le group.
    ->group(function(){
        Route::get("/index", "index")->name("index");  //Tu peux aussi nommer les routes en utilisant ->name("nom_de_la_route"), mais ce n'est pas obligatoire. Ici on a mis le nom de la route comme étant le nom de la méthode du controller.
        Route::post("/store", "store")->name("create");
        Route::put("/update/{departement}", "update")->name("update");
        Route::delete("/delete/{departement}", "destroy")->name("delete");
    });

    Route::get('/filiere', [FiliereResourceController::class, 'index']);

//Filières routes : liste + ajout + modification + suppression via le modal
Route::prefix("filiere")
    ->name ("filiere.")
    ->controller(FiliereResourceController::class)
    ->group(function(){
        Route::get("/index", "index")->name("index");
        Route::post("/store", "store")->name("create");
        Route::put("/update/{filiere}", "update")->name("update");
        Route::delete("/delete/{filiere}", "destroy")->name("delete");
    });

//Niveaux routes : liste + ajout + modification + suppression via le modal
Route::prefix("niveau")
    ->name ("niveau.")
    ->controller(NiveauResourceController::class)
    ->group(function(){
        Route::get("/index", "index")->name("index");
        Route::post("/store", "store")->name("create");
        Route::put("/update/{niveau}", "update")->name("update");
        Route::delete("/delete/{niveau}", "destroy")->name("delete");
    });

//Classes routes : liste + ajout + modification + suppression via le modal
Route::prefix("classe")
    ->name ("classe.")
    ->controller(ClasseResourceController::class)
    ->group(function(){
        Route::get("/index", "index")->name("index");
        Route::post("/store", "store")->name("create");
        Route::put("/update/{classe}", "update")->name("update");
        Route::delete("/delete/{classe}", "destroy")->name("delete");
    });

//Etudiants routes : liste + ajout + modification + suppression via le modal
Route::prefix("etudiant")
    ->name ("etudiant.")
    ->controller(EtudiantResourceController::class)
    ->group(function(){
        Route::get("/index", "index")->name("index");
        Route::post("/store", "store")->name("create");
        Route::put("/update/{etudiant}", "update")->name("update");
        Route::delete("/delete/{etudiant}", "destroy")->name("delete");
    });

//Enseignants routes : liste + ajout + modification + suppression via le modal
Route::prefix("enseignant")
    ->name ("enseignant.")
    ->controller(EnseignantResourceController::class)
    ->group(function(){
        Route::get("/index", "index")->name("index");
        Route::post("/store", "store")->name("create");
        Route::put("/update/{enseignant}", "update")->name("update");
        Route::delete("/delete/{enseignant}", "destroy")->name("delete");
    });

//Responsables Académique routes : liste + ajout + modification + suppression via le modal
Route::prefix("responsableAcademique")
    ->name ("responsableAcademique.")
    ->controller(ResponsableAcademiqueResourceController::class)
    ->group(function(){
        Route::get("/index", "index")->name("index");
        Route::post("/store", "store")->name("create");
        Route::put("/update/{responsableAcademique}", "update")->name("update");
        Route::delete("/delete/{responsableAcademique}", "destroy")->name("delete");
    });

//Parents routes : liste + ajout + modification + suppression via le modal
Route::prefix("parent")
    ->name ("parent.")
    ->controller(ParentResourceController::class)
    ->group(function(){
        Route::get("/index", "index")->name("index");
        Route::post("/store", "store")->name("create");
        Route::put("/update/{parent}", "update")->name("update");
        Route::delete("/delete/{parent}", "destroy")->name("delete");
    });

//Rôles et Permissions routes : liste + ajout + modification + suppression via le modal
Route::prefix("rolePermission")
    ->name ("rolePermission.")
    ->controller(RolePermissionResourceController::class)
    ->group(function(){
        Route::get("/index", "index")->name("index");
        Route::post("/store", "store")->name("create");
        Route::put("/update/{rolePermission}", "update")->name("update");
        Route::delete("/delete/{rolePermission}", "destroy")->name("delete");
    });

