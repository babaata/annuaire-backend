<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:api'])->group(function (){
    Route::apiResource('adresse', AdresseController::class);
    
    Route::get('/profils', "ProfilController@index");
    Route::get('/profil/{profil}', "ProfilController@show");
    Route::post('/profil', "ProfilController@store");
    Route::put('/profil/{profil}', "ProfilController@update");
    Route::delete('/profil/{profil}', "ProfilController@destroy");

    /** les rout pour le modele Adresse */

    Route::get('/adresse', "AdresseController@index");
    Route::get('/adresse/{adresse}', "AdresseController@show");
    Route::post('/adresse', "AdresseController@store");
    Route::put('/adresse/{adresse}', "AdresseController@update");
    Route::delete('/adresse/{adresse}', "AdresseController@destroy");

    /** les routes pour le modele certification */

    Route::get('/certification', "CertificationController@index");
    Route::get('/certification/{certification}', "CertificationController@show");
    Route::post('/certification', "CertificationController@store");
    Route::put('/certification/{certification}', "CertificationController@update");
    Route::delete('/certification/{certification}', "CertificationController@destroy");

    /** les routes pour le modele competence */

    Route::get('/competence', "CompetenceController@index");
    Route::get('/competence/{competence}', "CompetenceController@show");
    Route::post('/competence', "CompetenceController@store");
    Route::put('/competence/{competence}', "CompetenceController@update");
    Route::delete('/competence/{competence}', "CompetenceController@destroy");

    /** les routes pour le modele droit */

    Route::get('/droit', "DroitController@index");
    Route::get('/droit/{droit}', "DroitController@show");
    Route::post('droit/droit', "DroitController@store");
    Route::put('/droit/{droit}', "DroitController@update");
    Route::delete('/droit/{droit}', "DroitController@destroy");

    /** les routes pour le modele  */

    Route::get('/experience', "ExperienceProfessionnelleController@index");
    Route::get('/experience/{experience}', "ExperienceProfessionnelleController@show");
    Route::post('experience/experience', "ExperienceProfessionnelleController@store");
    Route::put('/experience/{experience}', "ExperienceProfessionnelleController@update");
    Route::delete('/experience/{experience}', "ExperienceProfessionnelleController@destroy");

    /** les routes pour le modele langue */

    Route::get('/langue', "LangueController@index");
    Route::get('/langue/{langue}', "LangueController@show");
    Route::post('langue/langue', "LangueController@store");
    Route::put('/langue/{langue}', "LangueController@update");
    Route::delete('/langue/{langue}', "LangueController@destroy");

    /** les routes pour le modele media */

    Route::get('/media', "MediaController@index");
    Route::get('/media/{media}', "MediaController@show");
    Route::post('media/media', "MediaController@store");
    Route::put('/media/{media}', "MediaController@update");
    Route::delete('/media/{media}', "MediaController@destroy");

    /** les routes pour le modele referent */

    Route::get('/referent', "ReferentController@index");
    Route::get('/referent/{referent}', "ReferentController@show");
    Route::post('referent/referent', "ReferentController@store");
    Route::put('/referent/{referent}', "ReferentController@update");
    Route::delete('/referent/{referent}', "ReferentController@destroy");

    /** les routes pour le modele role */

    Route::get('/role', "RoleController@index");
    Route::get('/role/{role}', "RoleController@show");
    Route::post('role/role', "RoleController@store");
    Route::put('/role/{role}', "RoleController@update");
    Route::delete('/role/{role}', "RoleController@destroy");

    /** les routes pour le modele roledroit */

    Route::get('/roledroit', "RoleDroitController@index");
    Route::get('/roledroit/{roledroit}', "RoleDroitController@show");
    Route::post('roledroit/roledroit', "RoleDroitController@store");
    Route::put('/roledroit/{roledroit}', "RoleDroitController@update");
    Route::delete('/roledroit/{roledroit}', "RoleDroitController@destroy");

    /** les routes pour le modele typecontrat */

    Route::get('/typecontrat', "TypeContratController@index");
    Route::get('/typecontrat/{typecontrat}', "TypeContratController@show");
    Route::post('typecontrat/typecontrat', "TypeContratController@store");
    Route::put('/typecontrat/{typecontrat}', "TypeContratController@update");
    Route::delete('/typecontrat/{typecontrat}', "TypeContratController@destroy");
    
});

//Inscription d'un utilisateur standart
Route::post('/user/create', 'UtilisateurController@store');
Route::post('/user/login', 'UtilisateurController@login');
