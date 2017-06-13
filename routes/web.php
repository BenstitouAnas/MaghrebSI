<?php

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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin', function () {
    return view('admin.home');
});

Route::get('admin/admin', function () {
    return view('admin.home');
});

// Routes pour la gestion des roles

Route::get('admin/RolesData','RoleCapaciteController@Roles');

Route::get('admin/RolesCapacites','RoleCapaciteController@showRoles');
Route::post('admin/RoleAdd','RoleCapaciteController@addRole');
Route::post('admin/RoleDelete','RoleCapaciteController@deleteRole');

Route::post('admin/RoleUpdate','RoleCapaciteController@updateRole');
Route::get('admin/RoleByID/{x}','RoleCapaciteController@getRoleByID');

// Routes pour la gestion des capacites

Route::get('admin/CapacitesData','RoleCapaciteController@Capacites');

Route::get('admin/Capacites','RoleCapaciteController@showCapacites');
Route::post('admin/CapaciteAdd','RoleCapaciteController@addCapacite');
Route::post('admin/CapaciteDelete','RoleCapaciteController@deleteCapacite');

Route::post('admin/CapaciteUpdate','RoleCapaciteController@updateCapacite');
Route::get('admin/CapaciteByID/{x}','RoleCapaciteController@getCapaciteByID');

// Routes pour la gestion des prestataires


       
Route::get('admin/PrestatairesData','PrestataireController@Prestataires');

Route::get('admin/Prestataires','PrestataireController@showPrestataires');
Route::post('admin/PrestataireAdd','PrestataireController@addPrestataire');
Route::post('admin/PrestataireDelete','PrestataireController@deletePrestataire');

Route::post('admin/PrestataireUpdate','PrestataireController@updatePrestataire');
Route::get('admin/PrestataireByID/{x}','PrestataireController@getPrestataireByID');

Route::post('admin/PrestataireSendEmail','PrestataireController@PrestataireSendEmail')->middleware('auth');


// Routes pour la gestion des commerciales

Route::get('admin/CommercialesData','CommercialeController@Commerciales');

Route::get('admin/Commerciales','CommercialeController@showCommerciales');
Route::post('admin/CommercialeAdd','CommercialeController@addCommerciale');
Route::post('admin/CommercialeDelete','CommercialeController@deleteCommerciale');

Route::post('admin/CommercialeUpdate','CommercialeController@updateCommerciale');
Route::get('admin/CommercialeByID/{x}','CommercialeController@getCommercialeByID');

Route::post('admin/CommercialeSendEmail','CommercialeController@CommercialeSendEmail');
Route::post('admin/CommercialeConfirme','CommercialeController@CommercialeConfirme');

Route::get('admin/DemandesCommerciales','CommercialeController@showDemandesCommerciales');
Route::get('admin/DemandesData','CommercialeController@Demandes');



//*********************************************************************************************************
//*********************************************************************************************************
//*********************************************************************************************************

Route::get('/Commerciales', function () {
    return view('commerciale.home');
});

Route::get('/Commerciales/DemandesRetrait','SoldeController@DemandesRetrait');

Route::post('/Commerciales/DemanderRetrait','SoldeController@DemanderRetrait');

/*Route::get('/Commerciales/DemanderRetrait', function () {
    return view('commerciale.demanderetrait');
});*/



//*********************************************************************************************************
//*********************************************************************************************************
//*********************************************************************************************************


Route::get('/Prestataires', function () {
    return view('prestataire.home');
});

Route::get('/Prestataires/DemandesRetrait','SoldeController@DemandesRetrait');
Route::post('/Prestataires/DemanderRetrait','SoldeController@DemanderRetrait');
Route::get('/Prestataires/Transactions','SoldeController@showTransactions');


Route::get('/Prestataires/Tickets','TicketController@showTtickets');

// Routes pour la gestion des categories

Route::get('Prestataires/Categories','CategorieController@showCategories');

Route::get('Prestataires/CategoriesData','CategorieController@Categories');

Route::post('Prestataires/CategorieAdd','CategorieController@addCategorie');
Route::post('Prestataires/CategorieDelete','CategorieController@deleteCategorie');

Route::post('Prestataires/CategorieUpdate','CategorieController@updateCategorie');
Route::get('Prestataires/CategorieByID/{x}','CategorieController@getCategorieByID');

// Routes pour la gestion des produits

Route::group(['middleware' => ['auth']], function() {
    // your routes


Route::get('Prestataires/Produits','ProduitController@showProduits');
Route::get('Prestataires/ProduitsData','ProduitController@Produits');

Route::get('Prestataires/AjouterProduit','ProduitController@showFormAjout');

Route::post('Prestataires/AjouterArticle','ProduitController@ajouterArticle');
Route::post('Prestataires/AjouterBooking','ProduitController@ajouterBooking');
Route::post('Prestataires/AjouterDeal','ProduitController@ajouterDeal');
Route::post('Prestataires/AjouterPrestation','ProduitController@ajouterPrestation');

Route::get('Prestataires/ProduitsByID/{x}','ProduitController@getProduitByID');

Route::post('Prestataires/ProduitDealUpdate','ProduitController@updateProduitDeal');

Route::post('Prestataires/DealAdd','ProduitController@dealAdd');

Route::get('Prestataires/DealsData/{x}','ProduitController@showDeals');
Route::post('Prestataires/DealDelete','ProduitController@deleteDeal');
Route::get('Prestataires/DealByID/{x}','ProduitController@getDealByID');
Route::post('Prestataires/DealUpdate','ProduitController@updateDeal');


// Routes pour la gestion des commandes

Route::get('Prestataires/Commandes','CommandeController@showCommandes');

Route::get('Prestataires/CommandesData','CommandeController@Commandes');

//Route::post('Prestataires/CategorieAdd','CategorieController@addCategorie');
//Route::post('Prestataires/CategorieDelete','CategorieController@deleteCategorie');

//Route::post('Prestataires/CategorieUpdate','CategorieController@updateCategorie');
Route::get('Prestataires/CommandeByID/{x}','CommandeController@getCommandeByID');
});