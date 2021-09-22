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

Route::group([
    'middleware' => 'auth.jwt',
], function ($router) {

    Route::any('/refresh', "UtilisateurController@refresh");

    //endpoints langues
    Route::get('/langues', "LangueController@index");
    Route::get('/langue/{langue}', "LangueController@show");
    Route::post('/langue', "LangueController@store");
    Route::put('/langue/{langue}', "LangueController@update");
    Route::delete('/langue/{langue}', "LangueController@destroy");

    //endpoints profil
    Route::get('/profils', "ProfilController@index");
    Route::get('/profil/{profil}', "ProfilController@show");
    Route::post('/profil', "ProfilController@store");
    Route::put('/profil/{profil}', "ProfilController@update");
    Route::delete('/profil/{profil}', "ProfilController@destroy");

    //endpoints education
    Route::get('/educations', "EducationController@index");
    Route::get('/education/{education}', "EducationController@show");
    Route::post('/education', "EducationController@store");
    Route::put('/education/{education}', "EducationController@update");
    Route::delete('/education/{education}', "EducationController@destroy");

    /**
     * Competences Endpoints
    */
    Route::get('/competences', "CompetenceController@index");
    Route::post('/competence', "CompetenceController@store");
    Route::get('/competence/{competence}', "CompetenceController@show");
    
    Route::put('/competence/{competence}', "CompetenceController@update");
    Route::delete('/competence/{competence}', "CompetenceController@destroy");

    /**
     * Certification
    */
    Route::get('/certifications', "CertificationController@index");
    Route::post('/certification', "CertificationController@store");
    Route::get('/certification/{certification}', "CertificationController@show");
    
    Route::put('/certification/{certification}', "CertificationController@update");
    Route::delete('/certification/{certification}', "CertificationController@destroy");

    //Experiences professionnelles
    Route::get('/experiences', "ExperienceProfessionnelleController@index");
    Route::post('/experience', "ExperienceProfessionnelleController@store");
    Route::get('/experience/{experience}', "ExperienceProfessionnelleController@show");
    
    Route::put('/experience/{experience}', "ExperienceProfessionnelleController@update");
    Route::delete('/experience/{experience}', "ExperienceProfessionnelleController@destroy");

    
    //endpoint user
    Route::post('/user/picture', 'UtilisateurController@saveUserPicture');

    //Logout endpoint
    Route::any('/user/logout', 'UtilisateurController@logout');

    Route::post('/user/update', 'UtilisateurController@update');
    Route::put('/user/password', 'UtilisateurController@updatePassword');

});


//Inscription d'un utilisateur standart
Route::post('/user/create', 'UtilisateurController@store');
Route::post('/user/login', 'UtilisateurController@login');

//Gestion publique de l'utilisateur
Route::get('/users/{limit?}', 'UtilisateurController@allUsers');

//Get user by id
Route::get('/user/{user}', 'UtilisateurController@getBydId');

Route::get('/langue-supportes', 'LangueController@liste');

//Reset user passwor
Route::post('/user/forgot-password', 'UtilisateurController@forgotPassword');
Route::post('/user/reset-password', 'UtilisateurController@resetPassword');

//Type de contrat
Route::get('/type-contrats', 'TypeContratController@index');

