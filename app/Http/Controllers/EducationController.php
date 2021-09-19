<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\{EducationCreateRequest, LoginRequest, EducationUpdateRequest};
use App\Gestions\{GestionProfil, GestionEducation};
use App\Models\{Utilisateur, Profil, Education};

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $educations = Education::whereIn('id_profil', function ($query) use ($request){
            $query->from('profil')->whereIdUtilisateur($request->user()->id_utilisateur)
            ->select('id_profil')->get();
        })->get();

        return response()->json([
            'status' => true,
            'educations' => $educations
        ]);
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
    public function store(EducationCreateRequest $request, GestionEducation $gestion)
    {
        return $gestion->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id = null)
    {

        $education = Education::whereIn('id_profil', function ($query) use ($request){
            $query->from('profil')->whereIdUtilisateur($request->user()->id_utilisateur)
            ->select('id_profil')->get();
        })->whereIdEducation($id)->get();

        return response()->json([
            'status' => true,
            'educations' => $education
        ]);
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
    public function update(EducationUpdateRequest $request, GestionEducation $gestion, $id = null)
    {
        return $gestion->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, GestionEducation $gestion, $id = null)
    {
        return $gestion->delete($request, $id);
    }
}
