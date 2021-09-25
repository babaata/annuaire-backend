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
    Route::get('/user/langues', "LangueController@index");
    Route::get('/user/langue/{langue}', "LangueController@show");
    Route::post('/user/langue', "LangueController@store");
    Route::put('/user/langue/{langue}', "LangueController@update");
    Route::delete('/user/langue/{langue}', "LangueController@destroy");

    //endpoints profil
    Route::get('/user/profils', "ProfilController@index");
    Route::get('/user/profil/{profil}', "ProfilController@show");
    Route::post('/user/profil', "ProfilController@store");
    Route::put('/user/profil/{profil}', "ProfilController@update");
    Route::delete('/user/profil/{profil}', "ProfilController@destroy");

    //endpoints education
    Route::get('/user/educations', "EducationController@index");
    Route::get('/user/education/{education}', "EducationController@show");
    Route::post('/user/education', "EducationController@store");
    Route::put('/user/education/{education}', "EducationController@update");
    Route::delete('/user/education/{education}', "EducationController@destroy");

    /**
     * Competences Endpoints
    */
    Route::get('/user/competences', "CompetenceController@index");
    Route::post('/user/competence', "CompetenceController@store");
    Route::get('/user/competence/{competence}', "CompetenceController@show");
    
    Route::put('/user/competence/{competence}', "CompetenceController@update");
    Route::delete('/user/competence/{competence}', "CompetenceController@destroy");

    /**
     * Certification
    */
    Route::get('/user/certifications', "CertificationController@index");
    Route::post('/user/certification', "CertificationController@store");
    Route::get('/user/certification/{certification}', "CertificationController@show");
    
    Route::put('/user/certification/{certification}', "CertificationController@update");
    Route::delete('/user/certification/{certification}', "CertificationController@destroy");

    //Experiences professionnelles
    Route::get('/user/experiences', "ExperienceProfessionnelleController@index");
    Route::post('/user/experience', "ExperienceProfessionnelleController@store");
    Route::get('/user/experience/{experience}', "ExperienceProfessionnelleController@show");
    
    Route::put('/user/experience/{experience}', "ExperienceProfessionnelleController@update");
    Route::delete('/user/experience/{experience}', "ExperienceProfessionnelleController@destroy");

    
    //endpoint user
    Route::post('/user/picture', 'UtilisateurController@saveUserPicture');
    Route::get('/user/me', 'UtilisateurController@getMe');

    //Logout endpoint
    Route::any('/user/logout', 'UtilisateurController@logout');

    Route::post('/user/update', 'UtilisateurController@update');
    Route::put('/user/password', 'UtilisateurController@updatePassword');

});


//Inscription d'un utilisateur standart
Route::post('/user/create', 'UtilisateurController@store');
Route::post('/user/login', 'UtilisateurController@login');

//Gestion publique de l'utilisateur
Route::get('/users', 'UtilisateurController@allUsers');
Route::get('/users/search', 'UtilisateurController@searchUser');
Route::get('/users/pagination', 'UtilisateurController@userPagination');

//Get user by id
Route::get('/user/{user}', 'UtilisateurController@getBydId');

Route::get('/langues', 'LangueController@liste');

//Reset user passwor
Route::post('/user/forgot-password', 'UtilisateurController@forgotPassword');
Route::post('/user/reset-password', 'UtilisateurController@resetPassword');

//Type de contrat
Route::get('/type-contrats', 'TypeContratController@index');

Route::get('/competences', 'CompetenceController@create');
Route::get('/statistiques', 'CompetenceController@statistiques');

Route::get('/pays', 'PaysController@index');

