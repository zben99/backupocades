<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\UserProfilController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\AppController::class, 'welcome'])->name('index');

Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->name('admin.')->middleware(['can:manage-users'])->group(function () {
    Route::resource('users', "UsersController");
});


Route::resource('profil', UserProfilController::class)->only([
    'index', 'edit',
]);

Route::post('photo-profil', [App\Http\Controllers\UserProfilController::class, 'changePhoto'])->name('photo.store');

Route::get('activate/{id}', [UsersController::class, 'activate'])->name('activate');
Route::get('first-connexion/{id}', [UserProfilController::class, 'first'])->name('first.login');

Route::get('/regions', [App\Http\Controllers\RegionController::class, 'index'])->name('regions.index');
Route::post('/regions/create', [App\Http\Controllers\RegionController::class, 'store'])->name('regions.store');
Route::post('/regions/{id}', [App\Http\Controllers\RegionController::class, 'update'])->name('regions.update');
Route::delete('/regions/{id}', [App\Http\Controllers\RegionController::class, 'destroy'])->name('regions.destroy');

Route::get('/provinces', [App\Http\Controllers\ProvinceController::class, 'index'])->name('provinces.index');
Route::post('/provinces/create', [App\Http\Controllers\ProvinceController::class, 'store'])->name('provinces.store');
Route::post('/provinces/{id}', [App\Http\Controllers\ProvinceController::class, 'update'])->name('provinces.update');
Route::delete('/provinces/{id}', [App\Http\Controllers\ProvinceController::class, 'destroy'])->name('provinces.destroy');

Route::get('/communes', [App\Http\Controllers\CommuneController::class, 'index'])->name('communes.index');
Route::post('/communes/create', [App\Http\Controllers\CommuneController::class, 'store'])->name('communes.store');
Route::post('/communes/{id}', [App\Http\Controllers\CommuneController::class, 'update'])->name('communes.update');
Route::delete('/communes/{id}', [App\Http\Controllers\CommuneController::class, 'destroy'])->name('communes.destroy');

Route::get('/objectif-specifiques', [App\Http\Controllers\ObjectifSpecifiqueController::class, 'index'])->name('objectif-specifiques.index');
Route::post('/objectif-specifiques/create', [App\Http\Controllers\ObjectifSpecifiqueController::class, 'store'])->name('objectif-specifiques.store');
Route::post('/objectif-specifiques/{id}', [App\Http\Controllers\ObjectifSpecifiqueController::class, 'update'])->name('objectif-specifiques.update');
Route::delete('/objectif-specifiques/{id}', [App\Http\Controllers\ObjectifSpecifiqueController::class, 'destroy'])->name('objectif-specifiques.destroy');


Route::get('/villages', [App\Http\Controllers\VillageController::class, 'index'])->name('villages.index');
Route::post('/villages/create', [App\Http\Controllers\VillageController::class, 'store'])->name('villages.store');
Route::post('/villages/{id}', [App\Http\Controllers\VillageController::class, 'update'])->name('villages.update');
Route::delete('/villages/{id}', [App\Http\Controllers\VillageController::class, 'destroy'])->name('villages.destroy');

Route::get('/paroisses', [App\Http\Controllers\ParoisseController::class, 'index'])->name('paroisses.index');
Route::post('/paroisses/create', [App\Http\Controllers\ParoisseController::class, 'store'])->name('paroisses.store');
Route::post('/paroisses/{id}', [App\Http\Controllers\ParoisseController::class, 'update'])->name('paroisses.update');
Route::delete('/paroisses/{id}', [App\Http\Controllers\ParoisseController::class, 'destroy'])->name('paroisses.destroy');

Route::get('/partenaires', [App\Http\Controllers\PartenaireController::class, 'index'])->name('partenaires.index');
Route::post('/partenaires/create', [App\Http\Controllers\PartenaireController::class, 'store'])->name('partenaires.store');
Route::post('/partenaires/{id}', [App\Http\Controllers\PartenaireController::class, 'update'])->name('partenaires.update');
Route::delete('/partenaires/{id}', [App\Http\Controllers\PartenaireController::class, 'destroy'])->name('partenaires.destroy');

Route::get('/typepartenaires', [App\Http\Controllers\TypepartenaireController::class, 'index'])->name('typepartenaires.index');
Route::post('/typepartenaires/create', [App\Http\Controllers\TypepartenaireController::class, 'store'])->name('typepartenaires.store');
Route::post('/typepartenaires/{id}', [App\Http\Controllers\TypepartenaireController::class, 'update'])->name('typepartenaires.update');
Route::delete('/typepartenaires/{id}', [App\Http\Controllers\TypepartenaireController::class, 'destroy'])->name('typepartenaires.destroy');

Route::get('/secteurs', [App\Http\Controllers\SecteurController::class, 'index'])->name('secteurs.index');
Route::post('/secteurs/create', [App\Http\Controllers\SecteurController::class, 'store'])->name('secteurs.store');
Route::post('/secteurs/{id}', [App\Http\Controllers\SecteurController::class, 'update'])->name('secteurs.update');
Route::delete('/secteurs/{id}', [App\Http\Controllers\SecteurController::class, 'destroy'])->name('secteurs.destroy');

Route::get('/domaines', [App\Http\Controllers\DomaineController::class, 'index'])->name('domaines.index');
Route::post('/domaines/create', [App\Http\Controllers\DomaineController::class, 'store'])->name('domaines.store');
Route::post('/domaines/{id}', [App\Http\Controllers\DomaineController::class, 'update'])->name('domaines.update');
Route::delete('/domaines/{id}', [App\Http\Controllers\DomaineController::class, 'destroy'])->name('domaines.destroy');


Route::post('/rapport/excel', [App\Http\Controllers\ProgramController::class, 'rapportImprimer'])->name('programs.rapportImprimer');

Route::get('/programs', [App\Http\Controllers\ProgramController::class, 'index'])->name('programs.index');
Route::post('/programs/create', [App\Http\Controllers\ProgramController::class, 'store'])->name('programs.store');
Route::post('/programs/{id}', [App\Http\Controllers\ProgramController::class, 'update'])->name('programs.update');
Route::delete('/programs/{id}', [App\Http\Controllers\ProgramController::class, 'destroy'])->name('programs.destroy');
Route::get('/programs/{id}', [App\Http\Controllers\ProgramController::class, 'show'])->name('programs.show');


Route::get('/activites', [App\Http\Controllers\ActiviteController::class, 'index'])->name('activites.index');
Route::post('/activites/create', [App\Http\Controllers\ActiviteController::class, 'store'])->name('activites.store');
Route::post('/activites/{id}', [App\Http\Controllers\ActiviteController::class, 'update'])->name('activites.update');
Route::delete('/activites/{id}', [App\Http\Controllers\ActiviteController::class, 'destroy'])->name('activites.destroy');
Route::delete('/activites/{id}/supprimerdocument', [App\Http\Controllers\ActiviteController::class, 'supprimerdocument'])->name('activites.supprimerdocument');
Route::get('/activites/{id}', [App\Http\Controllers\ActiviteController::class, 'show'])->name('activites.show');

Route::get('/projets-previsionnels', [App\Http\Controllers\ProjetPrevisionnelController::class, 'index'])->name('projets-previsionnels.index');
Route::post('/projets-previsionnels/create', [App\Http\Controllers\ProjetPrevisionnelController::class, 'store'])->name('projets-previsionnels.store');
Route::post('/projets-previsionnels/{id}', [App\Http\Controllers\ProjetPrevisionnelController::class, 'update'])->name('projets-previsionnels.update');
Route::delete('/projets-previsionnels/{id}', [App\Http\Controllers\ProjetPrevisionnelController::class, 'destroy'])->name('projets-previsionnels.destroy');
Route::get('/projets-previsionnels/{id}', [App\Http\Controllers\ProjetPrevisionnelController::class, 'show'])->name('projets-previsionnels.show');

Route::get('/projets', [App\Http\Controllers\ProjetController::class, 'index'])->name('projets.index');
Route::post('/projets/create', [App\Http\Controllers\ProjetController::class, 'store'])->name('projets.store');
Route::post('/projets/{id}', [App\Http\Controllers\ProjetController::class, 'update'])->name('projets.update');
Route::delete('/projets/{id}', [App\Http\Controllers\ProjetController::class, 'destroy'])->name('projets.destroy');
Route::get('/projets/{id}', [App\Http\Controllers\ProjetController::class, 'show'])->name('projets.show');
Route::get('/projets-statistique', [App\Http\Controllers\ProjetController::class, 'statistique'])->name('projets.statistique');
Route::delete('/projets/{id}/supprimerdocument', [App\Http\Controllers\ProjetController::class, 'supprimerdocument'])->name('projets.supprimerdocument');


Route::get('/activites-previsionnelles', [App\Http\Controllers\ActivitePrevisionnelleController::class, 'index'])->name('activites-previsionnelles.index');
Route::post('/activites-previsionnelles/create', [App\Http\Controllers\ActivitePrevisionnelleController::class, 'store'])->name('activites-previsionnelles.store');
Route::post('/activites-previsionnelles/{id}', [App\Http\Controllers\ActivitePrevisionnelleController::class, 'update'])->name('activites-previsionnelles.update');
Route::delete('/activites-previsionnelles/{id}', [App\Http\Controllers\ActivitePrevisionnelleController::class, 'destroy'])->name('activites-previsionnelles.destroy');
Route::get('/activites-previsionnelles/{id}', [App\Http\Controllers\ActivitePrevisionnelleController::class, 'show'])->name('activites-previsionnelles.show');
Route::get('/activites-previsionnelles/indicateurs/{id}', [App\Http\Controllers\ActivitePrevisionnelleController::class, 'getIndicators'])->name('activites-previsionnelles.indicateurs');
Route::get('/activites-previsionnelles/partenaires/{id}', [App\Http\Controllers\ActivitePrevisionnelleController::class, 'getPartners'])->name('activites-previsionnelles.partenaires');
Route::get('/activite-details/{id}', [App\Http\Controllers\ActiviteController::class, 'showDetails'])->name('activites.details');



Route::get('/historique-opérations', [App\Http\Controllers\HistoriqueController::class, 'index'])->name('projet-history.index');
Route::get('/historique-vider', [App\Http\Controllers\HistoriqueController::class, 'vider'])->name('projet-history.vider');
Route::delete('/historique/{id}', [App\Http\Controllers\HistoriqueController::class, 'destroy'])->name('projet-history.destroy');

Route::get('/restaurer-projet-previsionnel', [App\Http\Controllers\ProjetPrevisionnelController::class, 'projets_supprimes'])->name('restaurer-projet-previsionnel.index');
Route::get('/restaurer-projet-previsionnel/{id}', [App\Http\Controllers\ProjetPrevisionnelController::class, 'restore'])->name('projet-previsionnel.restore');
Route::delete('/projet-previsionnel-delete/{id}', [App\Http\Controllers\ProjetPrevisionnelController::class, 'delete'])->name('projet-previsionnel.delete');


Route::get('/restaurer-projet', [App\Http\Controllers\ProjetController::class, 'projets_supprimes'])->name('restaurer-projet.index');
Route::get('/restaurer-projet/{id}', [App\Http\Controllers\ProjetController::class, 'restore'])->name('projet.restore');
Route::delete('/projet-delete/{id}', [App\Http\Controllers\ProjetController::class, 'delete'])->name('projet.delete');

Route::get('/recherche-projets', [App\Http\Controllers\SearchController::class, 'index'])->name('recherche.index');
Route::post('/configs/{id}/update', [App\Http\Controllers\ConfigController::class, 'update'])->name('configs.update');
Route::get('/configs', [App\Http\Controllers\ConfigController::class, 'index'])->name('configs.index');

Route::get('/details-projet/{id}', [App\Http\Controllers\HomeController::class, 'getProjectDetails'])->name('projetPrev.details');
Route::get('/details-activite/{id}', [App\Http\Controllers\HomeController::class, 'getActivitePrevDetails'])->name('activitePrev.details');

Route::get('/type-documents', [App\Http\Controllers\TypeDocumentController::class, 'index'])->name('type-documents.index');
Route::post('/type-documents/create', [App\Http\Controllers\TypeDocumentController::class, 'store'])->name('type-documents.store');
Route::post('/type-documents/{id}', [App\Http\Controllers\TypeDocumentController::class, 'update'])->name('type-documents.update');
Route::delete('/type-documents/{id}', [App\Http\Controllers\TypeDocumentController::class, 'destroy'])->name('type-documents.destroy');


Route::post('/fichier-documents', [App\Http\Controllers\VieOrganisationDocumentController::class, 'document_upload'])->name('fichier-documents.add');
Route::get('/ouvrir-fichier/{id}', [App\Http\Controllers\VieOrganisationDocumentController::class, 'open'])->name('fichier-documents.open');
Route::delete('/fichier-documents/{id}', [App\Http\Controllers\VieOrganisationDocumentController::class, 'destroy'])->name('fichier-documents.destroy');

Route::get('/documents', [App\Http\Controllers\VieOrganisationController::class, 'index'])->name('documents.index');
Route::get('/documents/{id}', [App\Http\Controllers\VieOrganisationController::class, 'show'])->name('documents.show');
Route::post('/documents/create', [App\Http\Controllers\VieOrganisationController::class, 'store'])->name('documents.store');
Route::post('/documents/{id}', [App\Http\Controllers\VieOrganisationController::class, 'update'])->name('documents.update');
Route::delete('/documents/{id}', [App\Http\Controllers\VieOrganisationController::class, 'destroy'])->name('documents.destroy');


Route::get('/document-details/{id}', [App\Http\Controllers\AppController::class, 'show'])->name('document-details');

Auth::routes();
