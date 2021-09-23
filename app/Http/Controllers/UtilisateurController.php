<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\{UtilisateurCreateRequest, LoginRequest, UserPictureRequest, UtilisateurUpdateRequest, UtilisateurUpdatePasswordRequest, UtilisateurForgotPasswordRequest};
use App\Gestions\{GestionUtilisateur};
use App\Models\{Utilisateur, Profil};


class UtilisateurController extends Controller
{
    

    public function resetPassword(Request $request, GestionUtilisateur $gestion)
    {
        $request->validate([
            'code' => 'required',
            'telephone' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        return $gestion->resetPassword($request);
    }

    public function forgotPassword(UtilisateurForgotPasswordRequest $request, GestionUtilisateur $gestion)
    {
        return $gestion->forgotPassword($request);
    }

    public function getBydId(GestionUtilisateur $gestion, $user = null)
    {
        return $gestion->getBydId($user);
    }

    public function allUsers(GestionUtilisateur $gestion, $limit = 10)
    {
        return $gestion->allUsers($limit);
    }

    public function saveUserPicture(UserPictureRequest $request, GestionUtilisateur $gestion)
    {
        return $gestion->saveUserPicture($request);
    }

    public function logout(Request $request, GestionUtilisateur $gestion)
    {
        return $gestion->logout();
    }


    public function refresh(Request $request, GestionUtilisateur $gestion)
    {
        return $gestion->refresh();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UtilisateurCreateRequest $request, GestionUtilisateur $gestion)
    {
        return $gestion->store($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request, GestionUtilisateur $gestion)
    {
        return $gestion->login($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UtilisateurUpdateRequest $request, GestionUtilisateur $gestion)
    {
        return $gestion->update($request);
    }

    public function updatePassword(UtilisateurUpdatePasswordRequest $request, GestionUtilisateur $gestion)
    {
        return $gestion->updatePassword($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
