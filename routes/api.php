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
    Route::any('/refresh', "UtilisateurController@refresh");

    /**
     * Competences Endpoints
     */

    Route::get('/v1/competences', "CompetenceController@index");
    Route::post('/v1/competence', "CompetenceController@store");
    Route::get('/v1/competence/{competence}', "CompetenceController@show");
    
    Route::put('/v1/competence/{competence}', "CompetenceController@update");
    Route::delete('/v1/competence/{competence}', "CompetenceController@destroy");

    /**
     * Certification
     */

    Route::get('/v1/certifications', "CertificationController@index");
    Route::post('/v1/certification', "CertificationController@store");
    Route::get('/v1/certification/{certification}', "CertificationController@show");
    
    Route::put('/v1/certification/{certification}', "CertificationController@update");
    Route::delete('/v1/certification/{certification}', "CertificationController@destroy");

    


    
});

//Inscription d'un utilisateur standart
Route::post('/user/create', 'UtilisateurController@store');
Route::post('/user/login', 'UtilisateurController@login');
