<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\{ExperienceProfessionnelleCreateRequest, ExperienceProfessionnelleUpdateRequest};
use App\Gestions\{GestionCompetence, GestionExperience};

class ExperienceProfessionnelleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, GestionExperience $gestion)
    {
        return $gestion->all($request);
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
    public function store(ExperienceProfessionnelleCreateRequest $request, GestionExperience $gestion)
    {
        return $gestion->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, GestionExperience $gestion, $id)
    {
        return $gestion->find($request, $id);
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
    public function update(ExperienceProfessionnelleUpdateRequest $request, GestionExperience $gestion, $id)
    {
        return $gestion->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, GestionExperience $gestion, $id)
    {
        return $gestion->delete($request, $id);
    }
}
